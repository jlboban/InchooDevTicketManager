<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Page\Ticket;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Shopware\Storefront\Page\Page;
use Symfony\Component\HttpFoundation\Request;

class TicketCreatePageLoader
{
    /**
     * @var GenericPageLoaderInterface
     */
    private $genericPageLoader;

    public function __construct(GenericPageLoaderInterface $genericPageLoader)
    {
        $this->genericPageLoader = $genericPageLoader;
    }

    public function load(Request $request, SalesChannelContext $salesChannelContext): Page
    {
        return $this->genericPageLoader->load($request, $salesChannelContext);
    }
}