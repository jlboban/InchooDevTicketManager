<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket;

use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use Shopware\Storefront\Page\Page;

class TicketDetailPage extends Page
{
    /**
     * @var TicketEntity
     */
    private $ticket;

    /**
     * @return TicketEntity
     */
    public function getTicket(): ?TicketEntity
    {
        return $this->ticket;
    }

    /**
     * @param TicketEntity|null $ticket
     */
    public function  setTicket(?TicketEntity $ticket): void
    {
        $this->ticket = $ticket;
    }
}
