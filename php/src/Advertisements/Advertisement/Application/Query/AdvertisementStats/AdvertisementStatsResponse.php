<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\AdvertisementStats;

use Demo\App\Advertisements\Advertisement\Domain\ReadModel\AdvertisementStatsView;

final readonly class AdvertisementStatsResponse
{
    public function __construct(private array $advertisementStats, private int $usersCount)
    {}

    public function data(): array
    {
        return [
            'advertisements' => $this->advertisementStats['total'],
            'users' => $this->usersCount,
            'approved' => $this->advertisementStats['approved'],
            'disabled' => $this->advertisementStats['disabled'],
            'pending' => $this->advertisementStats['pending'],
        ];
    }
}
