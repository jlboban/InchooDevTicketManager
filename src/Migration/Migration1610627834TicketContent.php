<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1610627834TicketContent extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1610627834;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket`
            ADD COLUMN  `content` TEXT
            AFTER `subject`');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
