<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Domain\Events;

use Demo\App\Advertisements\Advertisement\Domain\Advertisement;
use Demo\App\Common\Domain\DomainEvent;

final readonly class AdvertisementWasPublished extends DomainEvent
{
    private const string EVENT_TYPE = 'advertisement-published';
    private const string AGGREGATE_TYPE = 'advertisement';
    private const string VERSION = '1.0';

    private function __construct(
        public string $eventType,
        public string $version,
        public string $advertisementId,
        public string $description,
        public string $email,
        public string $password,
        public string $date,
        public string $civicCenterId,
        public string $memberId,
    ) {
        parent::__construct($this->advertisementId, self::AGGREGATE_TYPE);
    }

    public static function create(Advertisement $advertisement): AdvertisementWasPublished
    {
        return new self(
            self::EVENT_TYPE,
            self::VERSION,
            $advertisement->id()->value(),
            $advertisement->description()->value(),
            $advertisement->email()->value(),
            $advertisement->password()->value(),
            $advertisement->date()->valueAsString(),
            $advertisement->civicCenterId()->value(),
            $advertisement->memberId()->value(),
        );
    }
}
