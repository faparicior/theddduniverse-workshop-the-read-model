<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Infrastructure\Stream\Producer\Events;

use Demo\App\Advertisements\Advertisement\Domain\Events\AdvertisementWasApproved;
use Demo\App\Advertisements\Advertisement\Domain\Events\AdvertisementWasPublished;
use Demo\App\Common\Infrastructure\Stream\Producer\SerializableEvent;

final readonly class AdvertisementPublishedEvent extends SerializableEvent
{
    private const string SOURCE = 'advertisement';
    //TODO: CHANGE VERSION SCHEMA TO ADAPT TO THE EVENT
    private const string SCHEMA = 'https://demo.com/schemas/advertisement-published_1_0.json';

    public static function create(
        AdvertisementWasPublished $advertisementWasPublished,
        string                    $source,
        string                    $tenantId,
        string                    $correlationId,
        ?string                   $causationId
    ): AdvertisementPublishedEvent
    {
        $payload = [
            'advertisementId' => $advertisementWasPublished->advertisementId,
            'description'     => $advertisementWasPublished->description,
            'email'           => $advertisementWasPublished->email,
            'password'        => $advertisementWasPublished->password,
            'date'            => $advertisementWasPublished->date,
            'civicCenterId'   => $advertisementWasPublished->civicCenterId,
            'memberId'        => $advertisementWasPublished->memberId,
        ];

        return new self(
            $advertisementWasPublished->eventId,
            self::SCHEMA,
            $advertisementWasPublished->eventType,
            $advertisementWasPublished->version,
            $advertisementWasPublished->occurredOn,
            $correlationId,
            $causationId,
            $source,
            $advertisementWasPublished->advertisementId,
            $advertisementWasPublished->aggregateType,
            $tenantId,
            $payload,
        );
    }
}
