<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Infrastructure\ReadModel\Projectors;

use Demo\App\Advertisements\Advertisement\Domain\Events\AdvertisementWasApproved;
use Demo\App\Advertisements\AdvertisementStats\Domain\AdvertisementStatsViewRepository;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Common\Domain\DomainEvent;

class AdvertisementStats
{
    public function __construct(
        private AdvertisementStatsViewRepository $advertisementStatsRepository,
    ) {}

    public function onAdvertisementApproved(AdvertisementWasApproved $event): void
    {
        $this->advertisementStatsRepository->incrementApproval(new CivicCenterId($event->civicCenterId));
        $this->advertisementStatsRepository->decrementPending(new CivicCenterId($event->civicCenterId));
    }

    public function onAdvertisementPublished(DomainEvent $event): void
    {
        $this->advertisementStatsRepository->incrementAdvertisements(new CivicCenterId($event->civicCenterId));
        $this->advertisementStatsRepository->incrementPending(new CivicCenterId($event->civicCenterId));
    }

    public function onMemberUserWasSignedUp(DomainEvent $event): void
    {
        $this->advertisementStatsRepository->incrementUser(new CivicCenterId($event->civicCenterId));
    }
}
