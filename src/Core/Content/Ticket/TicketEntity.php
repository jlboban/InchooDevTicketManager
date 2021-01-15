<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\Ticket;

use InchooDev\TicketManager\Core\Content\TicketReply\TicketReplyCollection;
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
     * @var string
     */
    protected $customerId;

    /**
     * @var TicketReplyCollection|null
     */
    protected $replies;

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return (bool)$this->status;
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
     * @return TicketReplyCollection|null
     */
    public function getReplies(): ?TicketReplyCollection
    {
        return $this->replies;
    }

    /**
     * @param TicketReplyCollection|null $replies
     */
    public function setReplies(?TicketReplyCollection $replies): void
    {
        $this->replies = $replies;
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
}
