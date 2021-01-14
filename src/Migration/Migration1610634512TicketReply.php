<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1610634512TicketReply extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1610634512;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket_message`
            RENAME TO `inchoo_ticket_reply`');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
