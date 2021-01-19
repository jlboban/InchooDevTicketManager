import template from './ticket-manager-list.html.twig';

const { Component } = Shopware;
const { Criteria } = Shopware.Data;


Component.register('ticket-manager-list', {
    template,

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            repository: null,
            tickets: null
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    computed: {
        columns() {
            return [{
                property: 'name',
                dataIndex: 'name',
                label: this.$tc('ticket-manager.list.columnName'),
                routerLink: 'ticket-manager.ticket.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }];
        }
    },

    created() {
        this.repository = this.repositoryFactory.create('inchoo_ticket');

        this.repository
            .search(new Criteria(), Shopware.Context.api)
            .then((result) => {
                this.tickets = result;
            });
    }
});