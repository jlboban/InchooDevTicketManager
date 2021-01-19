<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketReply;

use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\User\UserEntity;

class TicketReplyEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $ticketId;

    /**
     * @var string
     */
    protected $adminId;

    /**
     * @var TicketEntity|null
     */
    protected $ticket;

    /**
     * @var UserEntity|null
     */
    protected $admin;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
     * @return TicketEntity|null
     */
    public function getTicket(): ?TicketEntity
    {
        return $this->ticket;
    }

    /**
     * @param TicketEntity|null $ticket
     */
    public function setTicket(?TicketEntity $ticket): void
    {
        $this->ticket = $ticket;
    }

    /**
     * @return UserEntity|null
     */
    public function getAdmin(): ?UserEntity
    {
        return $this->admin;
    }

    /**
     * @param UserEntity|null $admin
     */
    public function setAdmin(?UserEntity $admin): void
    {
        $this->admin = $admin;
    }
}
