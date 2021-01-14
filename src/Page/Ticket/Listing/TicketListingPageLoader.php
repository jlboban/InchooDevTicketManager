<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket\Listing;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Sorting\FieldSorting;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\HttpFoundation\Request;

class TicketListingPageLoader
{
    /**
     * @var GenericPageLoaderInterface
     */
    private $genericPageLoader;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var EntityRepositoryInterface
     */
    private $ticketRepository;

    public function __construct(GenericPageLoaderInterface $genericPageLoader, EntityRepositoryInterface $ticketRepository)
    {
        $this->genericPageLoader = $genericPageLoader;
        $this->ticketRepository = $ticketRepository;
    }

    public function load(Request $request, SalesChannelContext $salesChannelContext): TicketListingPage
    {
        $this->request = $request;
        $page = $this->genericPageLoader->load($request, $salesChannelContext);

        $page = TicketListingPage::createFrom($page);

        $page->setTickets($this->getTickets($salesChannelContext));
        return $page;
    }

    private function getTickets(SalesChannelContext $salesChannelContext): EntityCollection
    {
        $sorting = new FieldSorting('status');
        $criteria = (new Criteria())->addSorting($sorting);

        return $this->ticketRepository->search($criteria, $salesChannelContext->getContext())->getEntities();
    }
}