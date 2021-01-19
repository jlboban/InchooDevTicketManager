import template from './ticket-manager-detail.html.twig';

const { Component, Mixin } = Shopware;

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
            ticket: null,
            isLoading: false,
            processSuccess: false,
            repository: null
        };
    },

    created() {
        this.repository = this.repositoryFactory.create('inchoo_ticket');
        this.getTicket();
    },

    methods: {
        getTicket() {
            this.repository
                .get(this.$route.params.id, Shopware.Context.api)
                .then((entity) => {
                    this.ticket = entity;
                });
        },

        onClickSave() {
            this.isLoading = true;

            this.repository
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

        saveFinish() {
            this.processSuccess = false;
        },
    }
});