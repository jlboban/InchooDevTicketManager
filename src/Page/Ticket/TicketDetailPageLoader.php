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

    public function __construct(GenericPageLoaderInterface $genericPageLoader, EntityRepositoryInterface $ticketRepository)
    {
        $this->genericPageLoader = $genericPageLoader;
        $this->ticketRepository = $ticketRepository;
    }

    public function load(Request $request, SalesChannelContext $salesChannelContext): TicketDetailPage
    {
        $page = $this->genericPageLoader->load($request, $salesChannelContext);
        $page = TicketDetailPage::createFrom($page);
        $page->setTicket($this->getTicket($request, $salesChannelContext));

        return $page;
    }

    private function getTicket(Request $request, SalesChannelContext $salesChannelContext): ?TicketEntity
    {
        $ticketId = $request->get('id');

        $criteria = (new Criteria())
            ->addFilter(new EqualsFilter('id', $ticketId));

        $ticket = $this->ticketRepository->search($criteria, $salesChannelContext->getContext())->getEntities()->first();
        return $ticket;
    }
}