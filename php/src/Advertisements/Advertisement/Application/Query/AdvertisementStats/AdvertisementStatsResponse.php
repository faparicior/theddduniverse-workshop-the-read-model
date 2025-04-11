<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\AdvertisementStats;

use Demo\App\Advertisements\Advertisement\Application\ReadModel\AdvertisementStats;

final readonly class AdvertisementStatsResponse
{
    public function __construct(public AdvertisementStats $advertisementStats)
    {}

    public function data(): array
    {
        return [
            'advertisements' => $this->advertisementStats->advertisements,
            'users' => $this->advertisementStats->users,
            'approved' => $this->advertisementStats->approved,
            'disabled' => $this->advertisementStats->disabled,
            'pending' => $this->advertisementStats->pending,
        ];
    }
}
