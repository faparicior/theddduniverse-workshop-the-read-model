<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\ActiveAdvertisements;

use Demo\App\Advertisements\Advertisement\Application\ReadModel\AdvertisementViewRepository;
use Demo\App\Advertisements\Advertisement\Domain\Services\AdvertisementSecurityService;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Advertisements\Shared\ValueObjects\UserId;

final class ActiveAdvertisementsUseCase
{
    public function __construct(
        private AdvertisementViewRepository  $advertisementViewRepository,
        private AdvertisementSecurityService $securityService,
    ) {
    }

    public function execute(ActiveAdvertisementsQuery $query): ActiveAdvertisementsResponse
    {
        $this->securityService->assertAdminUserCanManageCivicCenter(
            new UserId($query->securityUserId),
            new CivicCenterId($query->civicCenterId),
        );

        $result = $this->advertisementViewRepository->activeAdvertisementsByCivicCenter(
            new CivicCenterId($query->civicCenterId)
        );

        return new ActiveAdvertisementsResponse($result);
    }
}
