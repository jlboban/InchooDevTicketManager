<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Storefront\Controller;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\Routing\Annotation\LoginRequired;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 * @LoginRequired()
 */
class TicketReplyController extends StorefrontController
{
    private $ticketReplyRepository;

    public function __construct(EntityRepositoryInterface $ticketReplyRepository)
    {
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    /**
     * @Route("/account/ticket/{id}/reply", name="frontend.account.ticket.reply", methods={"POST"})
     * @param RequestDataBag $data
     * @param SalesChannelContext $context
     * @return RedirectResponse
     */
    public function new(RequestDataBag $data, SalesChannelContext $context)
    {
        $content = trim($data->get('content'));
        $ticketId = $data->get('ticketId');
        $adminId = $data->get('adminId') ?? null;

        $this->ticketReplyRepository->create(
            [
                [
                    'content' => $content,
                    'ticket' => ['ticket_id' => $ticketId],
                ]
            ],
            $context->getContext()
        );

        $this->addFlash('success', 'Successfully replied.');

        return $this->redirectToRoute('frontend.account.ticket.detail.page', [$ticketId]);
    }
}
