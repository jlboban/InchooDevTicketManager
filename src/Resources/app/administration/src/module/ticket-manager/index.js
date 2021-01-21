import './page/ticket-manager-list';
import './page/ticket-manager-detail';
import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

Shopware.Module.register('ticket-manager', {
    type: 'plugin',
    name: 'Tickets',
    title: 'ticket-manager.general.mainMenuItemGeneral',
    description: 'ticket-manager.general.mainMenuItemGeneral',
    color: '#00d5ff',
    icon: 'default-device-headset',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        list: {
            component: 'ticket-manager-list',
            path: 'list'
        },
        detail: {
            component: 'ticket-manager-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'ticket.manager.list'
            }
        }
    },

    navigation: [{
        label: 'ticket-manager.general.mainMenuItemGeneral',
        color: '#00d5ff',
        path: 'ticket.manager.list',
        icon: 'default-device-headset',
        position: 70
    }]
});