<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket\Listing;

use InchooDev\TicketManager\Core\Content\Ticket\TicketCollection;
use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use Shopware\Storefront\Page\Page;

class TicketListingPage extends Page
{
    /**
     * @var TicketCollection
     */
    private $tickets;

    /**
     * @return TicketCollection
     */
    public function getTickets(): TicketCollection
    {
        return $this->tickets;
    }

    /**
     * @param TicketCollection $ticket
     */
    public function  setTickets(TicketCollection $ticket): void
    {
        $this->tickets = $ticket;
    }
}