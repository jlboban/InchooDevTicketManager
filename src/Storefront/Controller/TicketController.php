<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Storefront\Controller;

use InchooDev\TicketManager\Page\Ticket\TicketListingPageLoader;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Framework\Routing\Annotation\LoginRequired;

/**
 * @RouteScope(scopes={"storefront"})
 */
class TicketController extends StorefrontController
{
    private $pageLoader;

    public function __construct(TicketListingPageLoader $pageLoader)
    {
        $this->pageLoader = $pageLoader;
    }

    /**
     * @Route("/account/ticket", name="frontend.account.tickets.page", methods={"GET"})
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     * @LoginRequired()
     */
    public function index(Request $request, SalesChannelContext $context)
    {
        $page = $this->pageLoader->load($request, $context);

        return $this->renderStorefront('@InchooDev/storefront/page/account/ticket-history/index.html.twig', ['page' => $page]);
    }
}
