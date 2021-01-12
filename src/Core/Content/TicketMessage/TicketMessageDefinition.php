<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketMessage;

use InchooDev\TicketManager\Core\Content\Ticket\TicketDefinition;
use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\User\UserDefinition;

class TicketMessageDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'inchoo_ticket_message';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return TicketMessageEntity::class;
    }

    public function getCollectionClass(): string
    {
        return TicketMessageCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new StringField('message', 'message'))->addFlags(new Required()),
            (new FkField('ticket_id', 'ticketId', TicketDefinition::class))
                ->addFlags(new Required()),
            (new FkField('customer_id', 'customerId', CustomerDefinition::class))
                ->addFlags(new Required()),
            (new FkField('admin_id', 'adminId', UserDefinition::class)),

            new ManyToOneAssociationField('ticketId', 'ticket_id', TicketDefinition::class),
            new ManyToOneAssociationField('customerId', 'customer_id', CustomerDefinition::class),
            new ManyToOneAssociationField('adminId', 'admin_id', UserDefinition::class)
        ]);
    }
}
