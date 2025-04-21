<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Application\Query\AdvertisementStats;

final readonly class AdvertisementsStatsQuery
{
    public function __construct(
        public string $securityUserId,
        public string $securityUserRole,
        public string $civicCenterId,
    ) {
    }
}
