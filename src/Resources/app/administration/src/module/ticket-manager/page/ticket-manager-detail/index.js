import template from './ticket-manager-detail.html.twig';

const { Mixin } = Shopware;
const Criteria = Shopware.Data.Criteria;

Shopware.Component.register('ticket-manager-detail', {
    template,

    inject: [
        'repositoryFactory'
    ],

    mixins: [
        Mixin.getByName('notification')
    ],

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data() {
        return {
            user: null,
            ticket: null,
            newReply: null,
            ticketRepository: null,
            replyRepository: null,
            isLoading: false,
            closeTicketProcessSuccess: false,
            createReplyProcessSuccess: false
        };
    },

    created() {
        this.ticketRepository = this.repositoryFactory.create('inchoo_ticket');
        this.replyRepository = this.repositoryFactory.create('inchoo_ticket_reply');
        this.getTicket();
        this.createReply();
    },

    computed: {
        ticketCriteria() {
            return new Criteria()
                .addFilter(Criteria.equals('id', this.$route.params.id))
                .addAssociation('customer')
                .addAssociation('replies');
        }
    },

    methods: {
        getTicket() {
            this.ticketRepository
                .search(this.ticketCriteria, Shopware.Context.api)
                .then((entity) => {
                    this.ticket = entity.first();
                });
        },

        createReply() {
            this.newReply = this.replyRepository.create(Shopware.Context.api);
        },

        closeTicket(){
            this.isLoading = true;
            this.ticket.status = false;

            this.ticketRepository
                .save(this.ticket, Shopware.Context.api)
                .then(() => {
                    this.getTicket();
                    this.isLoading = false;
                    this.processCloseTicketSuccess = true;
                }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('ticket-manager.detail.errorTitle'),
                    message: exception
                });
            });
        },

        saveReply(){
            this.isLoading = true;

            this.newReply.ticketId = this.ticket.id;
            this.newReply.adminId = Shopware.State.get('session').currentUser.id;

            this.replyRepository
                .save(this.newReply, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.processCreateReplySuccess = true;
                    this.$router.push({ name: 'ticket.manager.detail', params: { id: this.ticket.id } });
                    this.getTicket();
                    this.createReply();
                }).catch((exception) => {
                this.isLoading = false;

                this.createNotificationError({
                    title: this.$tc('ticket-manager.detail.errorTitle'),
                    message: exception
                });
            });
        },

        closeTicketFinish() {
            this.processCloseTicketSuccess = false;
        },

        createReplyFinish() {
            this.processCreateReplySuccess = false;
        }
    }
});
