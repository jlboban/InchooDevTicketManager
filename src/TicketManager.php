<?php declare(strict_types=1);

namespace InchooDev\TicketManager;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class TicketManager extends Plugin
{
    public function activate(ActivateContext $activateContext): void
    {
    }

    public function uninstall(UninstallContext $context): void
    {
        parent::uninstall($context);

        if ($context->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);

        $connection->executeUpdate('DROP TABLE IF EXISTS `inchoo_ticket_reply`');
        $connection->executeUpdate('DROP TABLE IF EXISTS `inchoo_ticket`');
    }
}