<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Storefront\Controller;

use InchooDev\TicketManager\Page\Ticket\TicketCreatePageLoader;
use InchooDev\TicketManager\Page\Ticket\TicketDetailPageLoader;
use InchooDev\TicketManager\Page\Ticket\TicketListingPageLoader;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Framework\Routing\Annotation\LoginRequired;

/**
 * @RouteScope(scopes={"storefront"})
 * @LoginRequired()
 */
class TicketController extends StorefrontController
{
    private $ticketListingPageLoader;
    private $ticketDetailPageLoader;
    private $ticketCreatePageLoader;
    private $ticketRepository;

    public function __construct
    (
        TicketListingPageLoader $ticketListingPageLoader,
        TicketDetailPageLoader $ticketDetailPageLoader,
        TicketCreatePageLoader $ticketCreatePageLoader,
        EntityRepositoryInterface $ticketRepository
    )
    {
        $this->ticketListingPageLoader = $ticketListingPageLoader;
        $this->ticketDetailPageLoader = $ticketDetailPageLoader;
        $this->ticketCreatePageLoader = $ticketCreatePageLoader;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * @Route("/account/ticket", name="frontend.account.ticket.page", methods={"GET"})
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     */
    public function index(Request $request, SalesChannelContext $context)
    {
        $page = $this->ticketListingPageLoader->load($request, $context);

        return $this->renderStorefront('@InchooDev/storefront/page/account/ticket-history/index.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/account/ticket/detail/{id}", name="frontend.account.ticket.detail.page", methods={"GET"})
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     */
    public function detail(Request $request, SalesChannelContext $context)
    {
        $page = $this->ticketDetailPageLoader->load($request, $context);

        return $this->renderStorefront('@InchooDev/storefront/page/account/ticket/detail.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/account/ticket/new", name="frontend.account.ticket.create.page", methods={"GET"})
     * @param Request $request
     * @param SalesChannelContext $context
     * @return Response
     */
    public function new(Request $request, SalesChannelContext $context)
    {
        $page = $this->ticketCreatePageLoader->load($request, $context);
        return $this->renderStorefront('@InchooDev/storefront/page/account/ticket/create.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/account/ticket/save", name="frontend.account.ticket.save", methods={"POST"})
     * @param RequestDataBag $data
     * @param SalesChannelContext $context
     * @return Response
     */
    public function saveTicket(RequestDataBag $data, SalesChannelContext $context)
    {
        $subject = $data->get('subject');
        $content = trim($data->get('content'));
        $customerId = $context->getCustomer()->getId();

        $this->ticketRepository->upsert(
            [
                [
                    'subject' => $subject,
                    'content' => $content,
                    'customerId' => $customerId,
                ]
            ],
            $context->getContext()
        );

        $this->addFlash('success', 'Successfully created a new ticket.');

        return $this->redirectToRoute('frontend.account.ticket.page');
    }
}
