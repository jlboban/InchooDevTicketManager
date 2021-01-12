<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketMessage;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                     add(TicketMessageEntity $entity)
 * @method void                     set(string $key, TicketMessageEntity $entity)
 * @method TicketMessageEntity[]    getIterator()
 * @method TicketMessageEntity[]    getElements()
 * @method TicketMessageEntity|null get(string $key)
 * @method TicketMessageEntity|null first()
 * @method TicketMessageEntity|null last()
 */
class TicketMessageCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return TicketMessageEntity::class;
    }
}
