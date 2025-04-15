<?php
declare(strict_types=1);

namespace Demo\App\Common\Domain;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;

    public function subscribe(string $eventClass, object $listenerClass, string $listenerFunction): void;
    public function subscribeToAllEvents(object $listenerClass, string $listenerFunction): void;

    public function unsubscribe(string $eventClass, string $listenerClass): void;
}
