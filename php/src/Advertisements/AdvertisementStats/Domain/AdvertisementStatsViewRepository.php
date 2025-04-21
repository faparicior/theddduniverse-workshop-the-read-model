<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Domain;

use Demo\App\Advertisements\AdvertisementStats\Domain\ReadModel\AdvertisementStatsView;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;

interface AdvertisementStatsViewRepository
{
    public function incrementApproval(CivicCenterId $civicCenterId): void;
    public function incrementPending(CivicCenterId $civicCenterId): void;
    public function decrementPending(CivicCenterId $civicCenterId): void;
    public function incrementAdvertisements(CivicCenterId $civicCenterId): void;
    public function getStats(CivicCenterId $civicCenterId): AdvertisementStatsView;
}
