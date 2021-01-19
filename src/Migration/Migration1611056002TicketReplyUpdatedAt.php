<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1611056002TicketReplyUpdatedAt extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1611056002;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket_reply`
            ADD COLUMN `updated_at` DATETIME(3)
            AFTER `created_at`
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
