<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\Ticket;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(TicketEntity $entity)
 * @method void              set(string $key, TicketEntity $entity)
 * @method TicketEntity[]    getIterator()
 * @method TicketEntity[]    getElements()
 * @method TicketEntity|null get(string $key)
 * @method TicketEntity|null first()
 * @method TicketEntity|null last()
 */
class TicketCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return TicketEntity::class;
    }
}
