<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\TicketReply;

use InchooDev\TicketManager\Core\Content\Ticket\TicketDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\User\UserDefinition;

class TicketReplyDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'inchoo_ticket_reply';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return TicketReplyEntity::class;
    }

    public function getCollectionClass(): string
    {
        return TicketReplyCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new LongTextField('content', 'content'))->addFlags(new Required()),
            (new FkField('ticket_id', 'ticketId', TicketDefinition::class))
                ->addFlags(new Required()),
            (new FkField('admin_id', 'adminId', UserDefinition::class)),

            new ManyToOneAssociationField('ticket', 'ticket_id', TicketDefinition::class, 'id', false),
            new ManyToOneAssociationField('admin', 'admin_id', UserDefinition::class, 'id', false)
        ]);
    }
}
