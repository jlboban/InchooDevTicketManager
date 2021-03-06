<?php declare(strict_types=1);

namespace InchooDev\TicketManager\Storefront\Controller;

use InchooDev\TicketManager\Core\Content\Ticket\TicketEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
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
        EntityRepositoryInterface $ticketRepository,
        EntityRepositoryInterface $ticketReplyRepository
    )
    {
        $this->ticketRepository = $ticketRepository;
        $this->ticketReplyRepository = $ticketReplyRepository;
    }

    /**
     * @Route("/account/ticket/{id}/reply", name="frontend.account.ticket.reply", methods={"POST"})
     * @param RequestDataBag $data
     * @param SalesChannelContext $context
     * @return RedirectResponse
     */
    public function saveReply(RequestDataBag $data, SalesChannelContext $context): RedirectResponse
    {
        $content = trim($data->get('content'));
        $ticketId = $data->get('ticketId');

        $criteria = (new Criteria())->addFilter(new EqualsFilter('id', $ticketId));

        /**
         * @var TicketEntity
         */
        $ticket = $this->ticketRepository->search($criteria, $context->getContext())->getEntities()->first();

        if ($context->getCustomer()->getId() !== $ticket->getCustomerId()){
            $this->addFlash('danger', 'You are only allowed to respond to tickets you created.');
            return $this->redirectToRoute('frontend.account.ticket.page');
        }

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
