<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketReply;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                     add(TicketReplyEntity $entity)
 * @method void                     set(string $key, TicketReplyEntity $entity)
 * @method TicketReplyEntity[]    getIterator()
 * @method TicketReplyEntity[]    getElements()
 * @method TicketReplyEntity|null get(string $key)
 * @method TicketReplyEntity|null first()
 * @method TicketReplyEntity|null last()
 */
class TicketReplyCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return TicketReplyEntity::class;
    }
}
