<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Domain\ReadModel;

readonly final class AdvertisementStatsView
{
    public function __construct(
        public string $civicCenterId,
        public int $advertisements,
        public int $users,
        public int $approved,
        public int $disabled,
        public int $pending,
    ){ }
}
