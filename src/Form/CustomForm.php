<?php

namespace Drupal\venkat_exercise\Form;

// Namespace of this form.
// Base classes.
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Class creation.
 */
class CustomForm extends FormBase {
  // Extending base class.

  /**
   * Generated form id.
   */
  public function getFormId() {
    return 'custom_form_get_user_details';
  }

  /**
   * Build form generates form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = "venkat_exercise/venkat_exercise_styles";
    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#required' => TRUE,
      '#placeholder' => 'First Name',
    ];
    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => 'Last Name',
      '#required' => FALSE,
    ];
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => 'Email',
      '#default_value' => 'test@gmail.com',
    ];
    $form['gender'] = [
      '#type' => 'select',
      '#title' => 'Gender',
      '#options' => [
        'male' => 'Male',
        'female' => 'Female',
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
      ],
    ];

    return $form;
  }

  public function ajaxSubmit() {
    $response = new AjaxResponse();
    $response->addCommand(new InvokeCommand("html", 'testing'));
    return $response;
  }

   /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    if (empty($email)) {
      $form_state->setErrorByName('email', $this->t('Email is required.'));
    }
    elseif (!preg_match('/^[\w\-\.]+@[\w\-\.]+\.\w+$/', $email)) {
      $form_state->setErrorByName('email', $this->t('enter valid email'));
    }
  }

  /**
   * Construct function.
   */
  public function __construct(MessengerInterface $messenger, Connection $database) {
    $this->messenger = $messenger;
    $this->database = $database;
  }

  /**
   * Create function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger'),
      $container->get('database')
    );
  }

  /**
   * Submit form function.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Message to be printed after submission.
    $this->messenger->addMessage("User Details Submitted Successfully");

    // The values are inserted into our custom database.
    $this->database->insert("user_information")->fields([
      // To get entered values.
      'firstname' => $form_state->getValue("firstname"),
      'lastname' => $form_state->getValue("lastname"),
      'email' => $form_state->getValue("email"),
      'gender' => $form_state->getValue("gender"),
    ])->execute();
  }

}
