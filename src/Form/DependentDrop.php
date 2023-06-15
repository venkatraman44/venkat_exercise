<?php

namespace Drupal\venkat_exercise\Form;

// Namespace.
// Using formbase.
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class creation.
 */
class DependentDrop extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    // Form id.
    return 'dependent_dropdown_Form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Buildform.
    // Opyions.
    $opt = $this->location();
    // Category.
    $cat = $form_state->getValue('country') ?: 'none';
    // Available items.
    $avai = $form_state->getValue('state') ?: 'none';
    // Defining form category.
    $form['country'] = [
    // Type.
      '#type' => 'select',
    // Title.
      '#title' => 'country',
    // Options.
      '#options' => $opt,
    // Category.
      'default_value' => $cat,
    // Enabling ajax.
      '#ajax' => [
    // Callback to next form.
        'callback' => '::DropdownCallback',
    // Container to store.
        'wrapper' => 'field-container',
        'event' => 'change',
      ],
    ];
    // Creating available items form.
    $form['state'] = [
      '#type' => 'select',
      '#title' => 'state',
    // It shows options based on $cat.
      '#options' => static::state($cat),
      '#default_value' => !empty($form_state->getValue('state')) ? $form_state->getValue('state') : 'none',
    // Prefix.
      '#prefix' => '<div id="field-container"',
      '#suffix' => '</div>',
    // Ajax enabling to next form.
      '#ajax' => [
        'callback' => '::DropdownCallback',
        'wrapper' => 'dist-container',
        'event' => 'change',
      ],
    ];
    // Creating district form.
    $form['district'] = [
      '#type' => 'select',
      '#title' => 'district',
    // Will show options based on $avai.
      '#options' => static::district($avai),
      '#default_value' => !empty($form_state->getValue('district')) ? $form_state->getValue('district') : '',
    // Container.
      '#prefix' => '<div id="dist-container"',
      '#suffix' => '</div>',
    ];
    // Submit option.
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];
    // Return form.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submit form.
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger != 'submit') {
      $form_state->setRebuild();
    }
  }

  /**
   * Function for dropdown callback.
   */
  public function dropdownCallback(array &$form, FormStateInterface $form_state) {
    // For dropdown callback.
    $triggering_element = $form_state->getTriggeringElement();
    $triggering_element_name = $triggering_element['#name'];

    // Callback for available items.
    if ($triggering_element_name === 'country') {
      return $form['state'];
    }
    // Callback for district.
    elseif ($triggering_element_name === 'state') {
      return $form['district'];
    }

  }

  /**
   * Function for location.
   */
  public function location() {
    // Defining location function with options.
    return [
      'none' => '-none-',
      'india' => 'india',
    ];
  }

  /**
   * Function for available items.
   */
  public function state($cat) {
    // Defining available options based on cat.
    switch ($cat) {
      case 'india':
        $opt = [
          'karnataka' => 'karnataka',
          'kerala' => 'kerala',
        ];
        break;

      default:
        $opt = ['none' => '-none-'];
        break;
    }
    return $opt;
  }

  /**
   * Function for district.
   */
  public function district($avai) {
    // Defining districts based on state.
    switch ($avai) {
      case 'karnataka':
        $opt = [
          'mysore' => 'mysore',
          'bangalore' => 'bangalore',
          'mangalore' => 'mangalore',
        ];
        break;

      case 'kerala':
        $opt = [
          'palakad' => 'palakad',
          'trivandrum' => 'trivandrum',
        ];
        break;
    }
    return $opt;
  }

}