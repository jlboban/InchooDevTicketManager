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
    public function saveReply(RequestDataBag $data, SalesChannelContext $context)
    {
        $content = trim($data->get('content'));
        $ticketId = $data->get('ticketId');

        try {
            $this->ticketReplyRepository->create(
                [
                    [
                        'content' => $content,
                        'ticketId' => $ticketId
                    ]
                ],
                $context->getContext()
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Content field must not be empty.');
            return $this->redirectToRoute('frontend.account.ticket.detail.page', ['id' => $ticketId]);
        }

        $this->addFlash('success', 'Successfully replied to ticket.');
        return $this->redirectToRoute('frontend.account.ticket.detail.page', ['id' => $ticketId]);
    }
}
