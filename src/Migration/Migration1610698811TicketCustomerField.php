<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1610698811TicketCustomerField extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1610698811;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket`
            ADD CONSTRAINT `fk.inchoo_ticket.customer_id` FOREIGN KEY (`customer_id`)
            REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ');

        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket_reply`
            DROP COLUMN  `customer_id`
        ');

        $connection->executeUpdate('
            ALTER TABLE `inchoo_ticket_reply`
            DROP CONSTRAINT `fk.ticket_message.customer_id`
        ');
    }

    public function updateDestructive(Connection $connection): void
    {

    }
}
