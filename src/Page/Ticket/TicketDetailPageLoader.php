<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket;

use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\HttpFoundation\Request;

class TicketDetailPageLoader
{
    /**
     * @var GenericPageLoaderInterface
     */
    private $genericPageLoader;

    /**
     * @var EntityRepositoryInterface
     */
    private $ticketRepository;

    public function __construct
    (
        GenericPageLoaderInterface $genericPageLoader,
        EntityRepositoryInterface $ticketRepository
    )
    {
        $this->genericPageLoader = $genericPageLoader;
        $this->ticketRepository = $ticketRepository;
    }

    public function load(Request $request, SalesChannelContext $context): TicketDetailPage
    {
        $ticketId = $request->get('id') ?? null;

        $page = $this->genericPageLoader->load($request, $context);
        $page = TicketDetailPage::createFrom($page);

        /** @var TicketEntity $ticket */
        $ticket = $this->getTicket($context, $ticketId);;

        $page->setTicket($ticket);

        return $page;
    }

    private function getTicket(SalesChannelContext $context, ?string $ticketId): ?TicketEntity
    {
        if (!$ticketId){
            return null;
        }

        $criteria = (new Criteria())
            ->addFilter(new EqualsFilter('id', $ticketId))
            ->addAssociation('customer')
            ->addAssociation('replies');

        $ticket = $this->ticketRepository->search($criteria, $context->getContext())->getEntities()->first();
        return $ticket;
    }
}
