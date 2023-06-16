<?php

namespace Drupal\venkat_exercise\EventSubscriber;

// baseclass.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// Defines event for the configuration system.
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * some comment.
 */
class EventSubscriberDemo implements EventSubscriberInterface {
  /**
   * Extending the baseclass.
   *
   * @var Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Function for construct.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   *
   * @return array
   *   some description.
   */
  public static function getSubscribedEvents() {
    // to get sudscribed events.
    // configs are returns when a new config is saved.
    $events[ConfigEvents::SAVE][] = ['configSave', -100];
    // Returns the configuration when it is deleted.
    $events[ConfigEvents::DELETE][] = ['configDelete', 100];
    return $events;
  }

  /**
   *  some comment.
   */
  public function configSave(ConfigCrudEvent $event) {
    // Funtion for configSave.
    // Return the Config Object.
    $config = $event->getConfig();
    // Messenger service is called.
    $this->messenger->addMessage('Saved config: ' . $config->getName());
  }

  /**
   * Function name.
   */
  public function configDelete(ConfigCrudEvent $event) {
    // Function for configDelete.
    // Return the Config Object.
    $config = $event->getConfig();
    // Messenger service is called.
    $this->messenger->addMessage('Deleted config: ' . $config->getName());
  }

}
