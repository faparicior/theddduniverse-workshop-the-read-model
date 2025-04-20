<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\AdvertisementStats;

final readonly class AdvertisementsStatsQuery
{
    public function __construct(
        public string $securityUserId,
        public string $securityUserRole,
        public string $civicCenterId,
    ) {
    }
}
