<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\ReadModel;

readonly final class AdvertisementStats
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
