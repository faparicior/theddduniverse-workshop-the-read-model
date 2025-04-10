<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\ReadModel;

use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;

interface AdvertisementStatsViewRepository
{
    public function incrementApproval(CivicCenterId $civicCenterId): void;
    public function incrementPending(CivicCenterId $civicCenterId): void;
    public function decrementPending(CivicCenterId $civicCenterId): void;
    public function incrementAdvertisements(CivicCenterId $civicCenterId): void;
}
