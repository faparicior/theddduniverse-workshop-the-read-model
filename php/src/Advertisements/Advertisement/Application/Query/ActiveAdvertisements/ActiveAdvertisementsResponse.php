<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Application\Query\ActiveAdvertisements;

use Demo\App\Advertisements\Advertisement\Domain\Advertisement;
use Demo\App\Advertisements\Advertisement\Domain\ReadModel\AdvertisementView;

final readonly class ActiveAdvertisementsResponse
{
    public function __construct(private array $activeAdvertisements)
    {}

    public function data(): array
    {
        return [
            'advertisements' => array_map(
                static fn(Advertisement $advertisement) => [
                    'id' => $advertisement->id()->value(),
                    'description' => $advertisement->description()->value(),
                    'userEmail' => $advertisement->email()->value(),
                    'advertisementDate' => $advertisement->date()->value()->format('Y-m-d H:i:s'),
                ],
                $this->activeAdvertisements
            ),
        ];
    }
}
