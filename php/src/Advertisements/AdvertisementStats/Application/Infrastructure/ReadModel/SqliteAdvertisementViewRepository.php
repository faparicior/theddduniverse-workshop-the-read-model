<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\AdvertisementStats\Application\Infrastructure\ReadModel;

use Demo\App\Advertisements\AdvertisementStats\Domain\AdvertisementViewRepository;
use Demo\App\Advertisements\AdvertisementStats\Domain\ReadModel\AdvertisementView;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Framework\Database\DatabaseConnection;
use Demo\App\Framework\database\SqliteConnection;

class SqliteAdvertisementViewRepository implements AdvertisementViewRepository
{
    private DatabaseConnection $dbConnection;
    public function __construct(SqliteConnection $connection)
    {
        $this->dbConnection = $connection;
    }
    public function activeAdvertisementsByCivicCenter(CivicCenterId $civicCenterId): array
    {
        $query = sprintf(
            "SELECT id, description, email, advertisement_date FROM advertisements WHERE civic_center_id = '%s' AND status = 'enabled'",
            $civicCenterId->value()
        );

        $result = $this->dbConnection->query($query);

        $advertisements = [];
        foreach ($result as $row) {
            $advertisements[] = new AdvertisementView(
                id: $row['id'],
                description: $row['description'],
                userEmail: $row['email'],
                advertisementDate: new \DateTimeImmutable($row['advertisement_date']),
            );
        }

        return $advertisements;
    }
}
