<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\Advertisement\Infrastructure\ReadModel;

use Demo\App\Advertisements\Advertisement\Application\ReadModel\AdvertisementStatsView;
use Demo\App\Advertisements\Advertisement\Application\ReadModel\AdvertisementStatsViewRepository;
use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Framework\Database\DatabaseConnection;
use Demo\App\Framework\database\SqliteConnection;

class SqliteAdvertisementStatsViewRepository implements AdvertisementStatsViewRepository
{
    private DatabaseConnection $dbConnection;
    public function __construct(SqliteConnection $connection)
    {
        $this->dbConnection = $connection;
    }

    public function incrementApproval(CivicCenterId $civicCenterId): void
    {
        $this->dbConnection->execute(sprintf('
            INSERT INTO advertisements_stats (civic_center_id, approved_count) 
            VALUES (\'%1$s\', 1) 
            ON CONFLICT(civic_center_id) 
            DO UPDATE SET approved_count = approved_count + 1',
                $civicCenterId->value()
            )
        );
    }

    public function incrementPending(CivicCenterId $civicCenterId): void
    {
        $this->dbConnection->execute(sprintf('
            INSERT INTO advertisements_stats (civic_center_id, pending_count) 
            VALUES (\'%1$s\', 1) 
            ON CONFLICT(civic_center_id) 
            DO UPDATE SET pending_count = COALESCE(pending_count, 0) + 1',
                $civicCenterId->value()
            )
        );
    }

    public function decrementPending(CivicCenterId $civicCenterId): void
    {
        $this->dbConnection->execute(sprintf('
            INSERT INTO advertisements_stats (civic_center_id, pending_count) 
            VALUES (\'%1$s\', -1) 
            ON CONFLICT(civic_center_id) 
            DO UPDATE SET pending_count = COALESCE(pending_count, 0) - 1',
                $civicCenterId->value()
            )
        );
    }
    public function incrementAdvertisements(CivicCenterId $civicCenterId): void
    {
        $this->dbConnection->execute(sprintf('
            INSERT INTO advertisements_stats (civic_center_id, advertisement_count) 
            VALUES (\'%1$s\', 1) 
            ON CONFLICT(civic_center_id) 
            DO UPDATE SET advertisement_count = COALESCE(advertisement_count, 0) + 1',
                $civicCenterId->value()
            )
        );
    }

    public function getStats(CivicCenterId $civicCenterId): AdvertisementStatsView
    {
        $result = $this->dbConnection->query(sprintf('SELECT * FROM advertisements_stats WHERE civic_center_id = \'%s\'', $civicCenterId->value()));
        if ($result) {
            $result = $result[0];
            return new AdvertisementStatsView(
                $result['civic_center_id'],
                (int)$result['advertisement_count'],
                (int)$result['user_count'],
                (int)$result['approved_count'],
                (int)$result['disabled_count'],
                (int)$result['pending_count'],
            );
        }

        return new AdvertisementStatsView(
            $civicCenterId->value(),
            0,
            0,
            0,
            0,
            0,
        );
    }
}
