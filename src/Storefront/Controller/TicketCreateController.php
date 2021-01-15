<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Storefront\Controller;

use InchooDev\TicketManager\Page\Ticket\TicketCreatePageLoader;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

/**
 * @RouteScope(scopes={"storefront"})
 */
class TicketCreateController extends StorefrontController
{
    private $pageLoader;

    public function __construct(TicketCreatePageLoader $pageLoader)
    {
        $this->pageLoader = $pageLoader;
    }

    /**
     * @Route("/account/ticket/new", name="frontend.account.ticket.create.page", methods={"GET"})
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     */
    public function new(Request $request, SalesChannelContext $context)
    {
        $page = $this->pageLoader->load($request, $context);
        return $this->renderStorefront('@InchooDev/storefront/page/account/ticket/create.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/account/ticket/save", name="frontend.account.ticket.save", methods={"POST"})
     * @param RequestDataBag $data
     * @param SalesChannelContext $context
     * @return void
     */
    public function saveTicket(RequestDataBag $data, SalesChannelContext $context)
    {
        /** @var RequestDataBag $ticket */
        $ticket = $data->get('ticket');
    }
}
