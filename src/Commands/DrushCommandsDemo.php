<?php

namespace Drupal\venkat_exercise\Commands;

// To format the output usingRowsOfFields.
use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
// Used as base class.
use Drush\Commands\DrushCommands;
// To use the service.
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Undocumented class.
 */
class DrushCommandsDemo extends DrushCommands {
  // Extending the base class.

  /**
   * Entity manager service.
   *
   * @var Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityManager = $entityTypeManager;
    parent::__construct();
  }

  /**
   * Command that returns a list of all blocked users.
   *
   * @field-labels
   *  id: Node Id
   *  title: Title
   * @default-fields id,title
   *
   * @usage drush-helpers: get-title
   *   Returns all get-title
   *
   * @command drush-helpers:get-title
   * @aliases get-title
   *
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   *   This is about loading.
   */
  public function drushDemo() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'article']);
    $rows = [];
    foreach ($nodes as $node) {
      $rows[] = [
        'id' => $node->id(),
        'title' => $node->getTitle(),
      ];
    }
    return new RowsOfFields($rows);
  }

}
