import template from './ticket-manager-detail.html.twig';

const { Component, Mixin } = Shopware;
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
            replies: null,
            newReply: null,
            ticketRepository: null,
            replyRepository: null,
            isLoading: false,
            processSuccess: false
        };
    },

    computed: {
        ticketCriteria(){
          const criteria = new Criteria()
              .addFilter(Criteria.equals('id', this.$route.params.id))
              .addAssociation('customer')
              .addAssociation('replies');

          return criteria;
        },
    },

    created() {
        this.ticketRepository = this.repositoryFactory.create('inchoo_ticket');
        this.replyRepository = this.repositoryFactory.create('inchoo_ticket_reply');
        this.getTicket();
        this.createReply();
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

        onClickSave(){

            this.isLoading = true;
            this.ticket.status = false;
            this.ticketRepository
                .save(this.ticket, Shopware.Context.api)
                .then(() => {
                    this.getTicket();
                    this.isLoading = false;
                    this.processSuccess = true;
                }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('ticket-manager.detail.errorTitle'),
                    message: exception
                });
            });
        },

        onCreateReply(){
            this.isLoading = true;
            this.newReply.ticketId = this.ticket.id;
            this.newReply.customerId = this.ticket.customerId;
            this.newReply.adminId = Shopware.State.get('session').currentUser.id;

            this.replyRepository
                .save(this.newReply, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: 'ticket.manager.detail', params: { id: this.ticket.id } });
                    this.saveFinish()
                }).catch((exception) => {
                this.isLoading = false;

                this.createNotificationError({
                    title: this.$tc('ticket-manager.detail.errorTitle'),
                    message: exception
                });
            });
        },

        saveFinish() {
            this.processSuccess = false;
        }
    }
});