<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\UI\Http;

use Demo\App\Advertisements\AdvertisementStats\Application\Query\AdvertisementStats\AdvertisementsStatsQuery;
use Demo\App\Advertisements\AdvertisementStats\Application\Query\AdvertisementStats\AdvertisementsStatsUseCase;
use Demo\App\Common\Exceptions\BoundedContextException;
use Demo\App\Common\UI\CommonController;
use Demo\App\Framework\FrameworkRequest;
use Demo\App\Framework\FrameworkResponse;
use Demo\App\Framework\SecurityUser\FrameworkSecurityService;
use Demo\App\Framework\ThreadContext;

final class GetStatsAdvertisementController extends CommonController
{
    public function __construct(
        private AdvertisementsStatsUseCase $useCase,
        private FrameworkSecurityService $securityService,
    ) {}

    public function request(FrameworkRequest $request, array $pathValues = []): FrameworkResponse
    {
        try {
            $user = $this->securityService->getSecurityUserFromRequest($request);

            ThreadContext::getInstance()->setValue('tenantId', $request->headers()['tenant-id']);

            if (null == $user || !$user->role() == 'admin') {
                return $this->processUnauthorizedResponse();
            }

            $query = new AdvertisementsStatsQuery(
                $user->id(),
                $user->role(),
                $pathValues['civicCenterId'],
            );

            $result = $this->useCase->execute($query);

            return $this->processSuccessfulQuery($result->data());
        } catch (BoundedContextException $exception) {
            return $this->processDomainOrApplicationExceptionResponse($exception);
        } catch (\Throwable $exception) {
            return $this->processGenericException($exception);
        }
    }
}
