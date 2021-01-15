<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Storefront\Page\Page;

class TicketListingPage extends Page
{
    /**
     * @var EntityCollection
     */
    private $tickets;

    /**
     * @return EntityCollection
     */
    public function getTickets(): EntityCollection
    {
        return $this->tickets;
    }

    /**
     * @param EntityCollection $ticket
     */
    public function  setTickets(EntityCollection $ticket): void
    {
        $this->tickets = $ticket;
    }
}