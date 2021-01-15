<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1610705295TicketReply extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1610705295;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `inchoo_ticket_reply` (
              `id` BINARY(16) NOT NULL,
              `content` VARCHAR(255) NOT NULL,
              `ticket_id` BINARY(16) NOT NULL,
              `admin_id` BINARY(16),
              `created_at` DATETIME(3) NOT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk.ticket_reply.ticket_id` FOREIGN KEY (`ticket_id`)
                REFERENCES `inchoo_ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ticket_reply.admin_id` FOREIGN KEY (`admin_id`)
                REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
