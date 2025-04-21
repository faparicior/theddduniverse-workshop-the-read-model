<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\AdvertisementStats;

use Demo\App\Advertisements\Advertisement\Domain\AdvertisementRepository;
use Demo\App\Advertisements\Advertisement\Domain\Services\AdvertisementSecurityService;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Advertisements\Shared\ValueObjects\UserId;
use Demo\App\Advertisements\User\Domain\UserRepository;

final class AdvertisementsStatsUseCase
{
    public function __construct(
        private AdvertisementRepository      $advertisementRepository,
        private UserRepository               $userRepository,
        private AdvertisementSecurityService $securityService,
    ) {
    }

    public function execute(AdvertisementsStatsQuery $query): AdvertisementStatsResponse
    {
        $this->securityService->assertAdminUserCanManageCivicCenter(
            new UserId($query->securityUserId),
            new CivicCenterId($query->civicCenterId),
        );

        $usersCount = $this->userRepository->usersCountByCivicCenter(
            new CivicCenterId($query->civicCenterId)
        );

        $stats = $this->advertisementRepository->getStats(
            new CivicCenterId($query->civicCenterId)
        );

        return new AdvertisementStatsResponse($stats, $usersCount);
    }
}
