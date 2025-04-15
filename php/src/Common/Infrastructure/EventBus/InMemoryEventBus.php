<?php
declare(strict_types=1);

namespace Demo\App\Common\Infrastructure\EventBus;

use Demo\App\Common\Domain\DomainEvent;
use Demo\App\Common\Domain\EventBus;

class InMemoryEventBus implements EventBus
{
    private array $subscribers = [];
    private array $genericSubscribers = [];

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->notifySubscribers($event);
            $this->notifyGenericSubscribers($event);
        }
    }

    public function subscribe(string $eventClass, object $listenerClass, string $listenerFunction): void
    {
        if (!isset($this->subscribers[$eventClass])) {
            $this->subscribers[$eventClass] = [];
        }
        $this->subscribers[$eventClass][] = [$listenerClass, $listenerFunction];
    }

    public function subscribeToAllEvents(object $listenerClass, string $listenerFunction): void
    {
        $this->genericSubscribers[] = [$listenerClass, $listenerFunction];
    }

    public function unsubscribe(string $eventClass, string $listenerClass): void
    {
        if (isset($this->subscribers[$eventClass])) {
            $key = array_search($listenerClass, $this->subscribers[$eventClass], true);
            if ($key !== false) {
                unset($this->subscribers[$eventClass][$key]);
            }
        }
    }

    private function notifySubscribers(DomainEvent $event): void
    {
        $eventClass = get_class($event);
        if (isset($this->subscribers[$eventClass])) {
            foreach ($this->subscribers[$eventClass] as $handler) {
                [$listenerClass, $listenerFunction] = $handler;
                if (method_exists($listenerClass, $listenerFunction)) {
                    $listener = $listenerClass;
                    $listener->$listenerFunction($event);
                }
            }
        }
    }

    private function notifyGenericSubscribers(DomainEvent $event): void
    {
        foreach ($this->genericSubscribers as $handler) {
            [$listenerClass, $listenerFunction] = $handler;
            if (method_exists($listenerClass, $listenerFunction)) {
                $listener = $listenerClass;
                $listener->$listenerFunction($event);
            }
        }
    }
}
