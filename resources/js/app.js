/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

// Components
Vue.component('docs', require('./components/Docs').default);
Vue.component('dashboard', require('./components/Dashboard').default);
Vue.component('navigation', require('./components/Navigation').default);
Vue.component('comment-list', require('./components/CommentList').default);
Vue.component('docs-token', require('./components/docs/TokenSection').default);
Vue.component('docs-signup', require('./components/docs/RegisterSection').default);
Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('docs-categories', require('./components/docs/CategoriesSection').default);
Vue.component('docs-comment-get', require('./components/docs/GetCommentSection').default);
Vue.component('docs-comment-post', require('./components/docs/PostCommentSection').default);
Vue.component('docs-approved-comments', require('./components/docs/ApprovedCommentsSection').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});
