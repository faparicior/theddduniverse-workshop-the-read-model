<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Domain;

use Demo\App\Advertisements\Advertisement\Domain\ReadModel\AdvertisementView;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;

interface AdvertisementViewRepository
{
    /**
     * @return AdvertisementView[]
     */
    public function activeAdvertisementsByCivicCenter(CivicCenterId $civicCenterId): array;
}
