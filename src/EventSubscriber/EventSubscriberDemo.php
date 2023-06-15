<?php

namespace Drupal\venkat_exercise\EventSubscriber;

// Used as baseclass for EventSubcriberDemo.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// Defines event for the configuration system.
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Description for class.
 */
class EventSubscriberDemo implements EventSubscriberInterface {
  /**
   * Extending the baseclass.
   *
   * @var Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Function.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   *
   * @return array
   *   DESCRIPTION
   */
  public static function getSubscribedEvents() {
    // This function is mandatory for eventsubcriber.
    // Returns the configuration when it saved.
    $events[ConfigEvents::SAVE][] = ['configSave', -100];
    // Returns the configuration when it is deleted.
    $events[ConfigEvents::DELETE][] = ['configDelete', 100];
    return $events;
  }

  /**
   * Description.
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