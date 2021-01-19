<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket;

use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use InchooDev\TicketManager\Core\Content\TicketReply\TicketReplyCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
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

    /**
     * @var EntityRepositoryInterface
     */
    private $ticketReplyRepository;

    public function __construct
    (
        GenericPageLoaderInterface $genericPageLoader,
        EntityRepositoryInterface $ticketRepository,
        EntityRepositoryInterface $ticketReplyRepository
    )
    {
        $this->genericPageLoader = $genericPageLoader;
        $this->ticketRepository = $ticketRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    public function load(Request $request, SalesChannelContext $context): TicketDetailPage
    {
        $ticketId = $request->get('id');

        $page = $this->genericPageLoader->load($request, $context);
        $page = TicketDetailPage::createFrom($page);

        /** @var TicketEntity $ticket */
        $ticket = $this->getTicket($context, $ticketId);
        $ticket->setReplies($this->getTicketReplies($context, $ticketId));

        $page->setTicket($ticket);

        return $page;
    }

    private function getTicket(SalesChannelContext $context, string $ticketId): ?TicketEntity
    {
        $criteria = (new Criteria())
            ->addFilter(new EqualsFilter('id', $ticketId))
            ->addAssociation('customer')
            ->addSorting(new FieldSorting('createdAt', 'ASC'))
            ->addSorting(new FieldSorting('status', 'DESC'));


        $ticket = $this->ticketRepository->search($criteria, $context->getContext())->getEntities()->first();
        return $ticket;
    }

    private function getTicketReplies(SalesChannelContext $context, string $ticketId): ?TicketReplyCollection
    {
        $criteria = (new Criteria())
            ->getAssociation('inchoo_ticket')
            ->addSorting(new FieldSorting('createdAt', 'ASC'))
            ->addFilter(new EqualsFilter('ticketId', $ticketId));

        $replies = $this->ticketReplyRepository->search($criteria, $context->getContext())->getEntities();
        return $replies;
    }
}
