<?php

namespace Drupal\venkat_exercise\Controller;

// Namespace of this file.
// Use of controllerbase.
use Drupal\Core\Controller\ControllerBase;
use Drupal\venkat_exercise\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Use of our custom service.
 */
class CustomController extends ControllerBase {

  /**
   * CustomService.
   *
   * @var \Drupal\venkat_exercise\CustomService
   */
  protected $customService;

  /**
   * Create function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('custom_service')
    );
  }

  /**
   * Construct function.
   */
  public function __construct(CustomService $customService) {
    $this->customService = $customService;
  }

  /**
   * Function hello.
   */
  public function hello() {
    // Defining function.
    // Calling our service.
    $data = $this->customService->getName();
    return [
    // Setting theme for this file.
      '#theme' => 'new_template',
    // The rendered name from config form.
      '#markup' => $data,
    // For color.
      '#hexcode' => '#FF0000',
    ];
  }

}