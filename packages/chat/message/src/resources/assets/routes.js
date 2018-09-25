import Conversation from './components/Conversation.vue';

const routes = [
    {
        path: '/:id', 
        component: Conversation, 
        name: 'messages'
    },
];

export default routes;