<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\Ticket;

use GuzzleHttp\Tests\Stream\Str;
use InchooDev\TicketManager\Core\Content\TicketReply\TicketReplyDefinition;
use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class TicketDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'inchoo_ticket';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return TicketEntity::class;
    }

    public function getCollectionClass(): string
    {
        return TicketCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            new BoolField('status', 'status'),
            (new StringField('subject', 'subject'))->addFlags(new Required()),
            (new StringField('content', 'content'))->addFlags(new Required()),
            (new FkField('customer_id', 'customerId', CustomerDefinition::class))
                ->addFlags(new Required()),
            (new OneToManyAssociationField('replies', TicketReplyDefinition::class, 'ticket_id', 'id'))->addFlags(new CascadeDelete()),

            new ManyToOneAssociationField('customer', 'customer_id', CustomerDefinition::class)
        ]);
    }
}
