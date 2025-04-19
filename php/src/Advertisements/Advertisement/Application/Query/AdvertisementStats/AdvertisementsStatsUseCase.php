<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\AdvertisementStats;

use Demo\App\Advertisements\Advertisement\Domain\AdvertisementStatsViewRepository;
use Demo\App\Advertisements\Advertisement\Domain\Services\AdvertisementSecurityService;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Advertisements\Shared\ValueObjects\UserId;

final class AdvertisementsStatsUseCase
{
    public function __construct(
        private AdvertisementStatsViewRepository $advertisementStatsViewRepository,
        private AdvertisementSecurityService     $securityService,
    ) {
    }

    public function execute(AdvertisementsStatsQuery $query): AdvertisementStatsResponse
    {
        $this->securityService->assertAdminUserCanManageCivicCenter(
            new UserId($query->securityUserId),
            new CivicCenterId($query->civicCenterId),
        );

        $result = $this->advertisementStatsViewRepository->getStats(
            new CivicCenterId($query->civicCenterId)
        );

        return new AdvertisementStatsResponse($result);
    }
}
