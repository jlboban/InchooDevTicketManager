<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1610449248TicketMessage extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1610449248;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `inchoo_ticket_message` (
              `id` BINARY(16) NOT NULL,
              `content` VARCHAR(255) NOT NULL,
              `ticket_id` BINARY(16) NOT NULL,
              `customer_id` BINARY(16) NOT NULL,
              `admin_id` BINARY(16),
              `created_at` DATETIME(3) NOT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk.ticket_message.ticket_id` FOREIGN KEY (`ticket_id`)
                REFERENCES `inchoo_ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ticket_message.customer_id` FOREIGN KEY (`customer_id`)
                REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.ticket_message.admin_id` FOREIGN KEY (`admin_id`)
                REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
