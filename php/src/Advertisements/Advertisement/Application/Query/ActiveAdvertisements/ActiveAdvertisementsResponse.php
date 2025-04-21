<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\ActiveAdvertisements;

use Demo\App\Advertisements\AdvertisementStats\Domain\ReadModel\AdvertisementView;

final readonly class ActiveAdvertisementsResponse
{
    public function __construct(public array $activeAdvertisements)
    {}

    public function data(): array
    {
        return [
            'advertisements' => array_map(
                static fn(AdvertisementView $advertisement) => [
                    'id' => $advertisement->id,
                    'description' => $advertisement->description,
                    'userEmail' => $advertisement->userEmail,
                    'advertisementDate' => $advertisement->advertisementDate->format('Y-m-d H:i:s'),
                ],
                $this->activeAdvertisements
            ),
        ];
    }
}
