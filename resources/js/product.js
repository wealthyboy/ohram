
require('./bootstrap');

window.Vue = require('vue');
import store from './store'
import VueRouter from 'vue-router'

require ('../../public/js/plugins/owl.carousel.min.js')
require ('../../public/js/plugins/jquery.cookie.js')

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const ProductShow = require('./components/products/Show.vue').default
const TopCart = require('./components/cart/Top.vue').default
const CartSideBarMenu = require('./components/cart/CartSideBarMenu.vue').default
const NavIcon = require('./components/navigation/Navicon.vue').default
const LoginModal = require('./components/auth/LoginModal.vue').default
const CartSummary = require('./components/cart/Cart.vue').default
const NewsLetter = require('./components/newsletter/Index.vue').default
const SignUp = require('./components/newsletter/SignUp.vue').default

const FavoriteIndex = require('./components/favorites/Index.vue').default
const Messages =  require('./components/message/index.vue').default
const Comments =  require('./components/blog/Comments.vue').default



let token = document.head.querySelector('meta[name="csrf-token"]');
Window.token = token.content


Vue.filter('priceFormat',function(value){
    return new Intl.NumberFormat().format(value);
});

const app = new Vue({
    el: '#product-page',
    store, 
    router,
    components:{
        TopCart,
        CartSideBarMenu,
        ProductShow,
        NavIcon,
        LoginModal ,
        CartSummary,
        NewsLetter,
        FavoriteIndex,
        Messages,
        Comments,
        SignUp,
        
    }   
});
