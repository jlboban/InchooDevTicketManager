import template from './ticket-manager-detail.html.twig';

const Criteria = Shopware.Data.Criteria;

Shopware.Component.register('ticket-manager-detail', {
    template,

    inject: [
        'repositoryFactory'
    ],

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data() {
        return {
            ticket: null,
            replies: null,
            repository: null
        };
    },

    computed: {
      ticketCriteria(){
          const criteria = new Criteria()
              .addFilter(Criteria.equals('id', this.$route.params.id))
              .addAssociation('replies');

          return criteria;
        },
    },

    created() {
        this.repository = this.repositoryFactory.create('inchoo_ticket');
        this.getTicket();
    },

    methods: {
        getTicket() {
            this.repository
                .search(this.ticketCriteria, Shopware.Context.api)
                .then((entity) => {
                    this.ticket = entity.first();
                });
        },

        onTicketClose(){
            this.repository.update()
        },

        onCreateReply(){

        }
    }
});