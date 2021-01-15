<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Core\Content\Ticket;

use Shopware\Core\Checkout\Customer\CustomerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
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
            (new LongTextField('content', 'content'))->addFlags(new Required()),
            (new FkField('customer_id', 'customerId', CustomerDefinition::class))
                ->addFlags(new Required()),

            new ManyToOneAssociationField('customerId', 'customer_id', CustomerDefinition::class)
        ]);
    }
}
