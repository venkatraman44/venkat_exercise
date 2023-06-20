<?php

namespace Drupal\venkat_exercise\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Extending base class.
 */
class JqueryForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'jquery_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'venkat_exercise/venkat_exercise_styles';

    $form['permanent_address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Permanent Address'),
      '#required' => TRUE,
    ];

    $form['same_address'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Same as Permanent Address'),
      '#default_value' => TRUE,
      '#attributes' => ['class' => ['same-address-checkbox']],
      '#attached' => [
        'library' => ['venkat_exercise/jquery-form'],
      ],
    ];

    $form['local_address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Local Address'),
      '#required' => FALSE,
      '#attributes' => [
        'class' => ['temporary-address'],
        'style' => 'display:none',
      ],
      '#prefix' => '<div id="local-address-wrapper">',
      '#suffix' => '</div>',
      '#attached' => [
        'library' => ['venkat_exercise/jquery-form'],
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    // Hide the title of the local_address field if the checkbox is checked.
    $form['#attached']['drupalSettings']['venkat_exercise']['hideLocalAddressTitle'] = TRUE;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Handle form submission.
  }

}
