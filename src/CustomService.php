<?php

namespace Drupal\venkat_exercise;

// Name space of custom service file.
use Drupal\Core\Config\ConfigFactory;

// Base class.
/**
 * Class CustomService is called.
 *
 * @package Drupal\venkat_exercise\Services
 */
class CustomService {
  // Creating class.

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    // Assigning variable $configfactory.
    $this->configFactory = $configFactory;
  }

  /**
   * Gets my setting.
   */
  public function getName() {
    // To collect NAME of the config form.
    $config = $this->configFactory->get('venkat_exercise.settings');
    // Return the name.
    return $config->get('NAME');
  }

}