<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketMessage;

use InchooDev\TicketManager\Core\Content\Ticket\TicketCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class TicketMessageEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $ticketId;

    /**
     * @var string
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $adminId;

    /**
     * @var TicketCollection|null
     */
    protected $ticket;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getTicketId(): string
    {
        return $this->ticketId;
    }

    /**
     * @param string $ticketId
     */
    public function setTicketId(string $ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getAdminId(): string
    {
        return $this->adminId;
    }

    /**
     * @param string $adminId
     */
    public function setAdminId(string $adminId): void
    {
        $this->adminId = $adminId;
    }

    /**
     * @return TicketCollection|null
     */
    public function getTicket(): ?TicketCollection
    {
        return $this->ticket;
    }

    /**
     * @param TicketCollection|null $ticket
     */
    public function setTicket(?TicketCollection $ticket): void
    {
        $this->ticket = $ticket;
    }
}
