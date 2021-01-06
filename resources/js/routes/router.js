import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Post from '../components/posts/Post.vue'
import PostDetails from '../components/posts/PostDetail';

const routes = [
    { path: '/', component: Post, name: 'Post' },
    { path: '/post/:slug', component: PostDetails, name: 'PostDetails' },
];

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router;