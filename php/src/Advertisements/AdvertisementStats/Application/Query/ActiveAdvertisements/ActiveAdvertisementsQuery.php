<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Application\Query\ActiveAdvertisements;

final readonly class ActiveAdvertisementsQuery
{
    public function __construct(
        public string $securityUserId,
        public string $securityUserRole,
        public string $civicCenterId,
    ) {
    }
}
