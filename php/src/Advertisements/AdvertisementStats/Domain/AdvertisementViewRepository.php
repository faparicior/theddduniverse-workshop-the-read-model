<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Domain;

use Demo\App\Advertisements\AdvertisementStats\Domain\ReadModel\AdvertisementView;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;

interface AdvertisementViewRepository
{
    /**
     * @return AdvertisementView[]
     */
    public function activeAdvertisementsByCivicCenter(CivicCenterId $civicCenterId): array;
}
