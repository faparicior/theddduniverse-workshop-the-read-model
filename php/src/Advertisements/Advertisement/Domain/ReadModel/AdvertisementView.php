<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Domain\ReadModel;

final readonly class AdvertisementView
{
    public function __construct(
        public string $id,
        public string $description,
        public string $userEmail,
        public \DateTimeImmutable $advertisementDate,
    ){ }
}