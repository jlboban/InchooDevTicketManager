<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\Ticket;

use InchooDev\TicketManager\Core\Content\TicketMessage\TicketMessageCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class TicketEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var TicketMessageCollection|null
     */
    protected $messages;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return TicketMessageCollection|null
     */
    public function getMessages(): ?TicketMessageCollection
    {
        return $this->messages;
    }

    /**
     * @param TicketMessageCollection|null $messages
     */
    public function setMessages(?TicketMessageCollection $messages): void
    {
        $this->messages = $messages;
    }
}
