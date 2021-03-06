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
                property: 'status',
                dataIndex: 'status',
                label: this.$tc('ticket-manager.list.columnStatus'),
                inlineEdit: 'boolean',
                primary: true,
                naturalSorting: true
            }, {
                property: 'customer.fullName',
                dataIndex: 'customer.firstName, customer.lastName',
                label: this.$tc('ticket-manager.list.columnCustomer'),
                routerLink: 'ticket.manager.detail',
                allowResize: true,
                primary: true
            }, {
                property: 'subject',
                dataIndex: 'subject',
                label: this.$tc('ticket-manager.list.columnSubject'),
                routerLink: 'ticket.manager.detail',
                allowResize: true,
                primary: true
            }, {
                property: 'createdAt',
                dataIndex: 'createdAt',
                label: this.$tc('ticket-manager.list.columnCreatedAt'),
                allowResize: true
            }];
        }
    },

    created() {
        this.repository = this.repositoryFactory.create('inchoo_ticket');
        this.getTickets();
    },

    methods: {
        getTickets() {
            this.repository
                .search(new Criteria().addAssociation('customer'), Shopware.Context.api)
                .then((result) => {
                    this.tickets = result;
                    this.tickets.forEach((ticket) => {
                        ticket.customer.fullName = ticket.customer.firstName + " " + ticket.customer.lastName;
                    });
                });
        },
    }
});