<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\UI\Http;

use Demo\App\Advertisements\Advertisement\Application\Query\ActiveAdvertisements\ActiveAdvertisementsQuery;
use Demo\App\Advertisements\Advertisement\Application\Query\ActiveAdvertisements\ActiveAdvertisementsUseCase;
use Demo\App\Common\Exceptions\BoundedContextException;
use Demo\App\Common\UI\CommonController;
use Demo\App\Framework\FrameworkRequest;
use Demo\App\Framework\FrameworkResponse;
use Demo\App\Framework\SecurityUser\FrameworkSecurityService;
use Demo\App\Framework\ThreadContext;

final class GetActiveAdvertisementsController extends CommonController
{
    public function __construct(
        private ActiveAdvertisementsUseCase $useCase,
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

            $query = new ActiveAdvertisementsQuery(
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
