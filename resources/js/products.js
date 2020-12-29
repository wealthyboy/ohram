
require('./bootstrap');
require ('../../public/js/plugins/owl.carousel.min.js')
require ('../../public/js/plugins/jquery.cookie.js')

window.Vue = require('vue');
import VueRouter from 'vue-router'
import store from './store'



Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
})

const ProductsIndex = require('./components/products/Index.vue').default
const Messages =  require('./components/message/index.vue').default
const SideBar = require('./components/products/SideBar.vue').default
const TopCart = require('./components/cart/Top.vue').default
const CartSideBarMenu = require('./components/cart/CartSideBarMenu.vue').default
const NavIcon = require('./components/navigation/Navicon.vue').default
const NewsLetter = require('./components/newsletter/Index.vue').default
const SignUp = require('./components/newsletter/SignUp.vue').default

let token = document.head.querySelector('meta[name="csrf-token"]');
Window.token = token.content

Vue.filter('priceFormat',function(value){
    return new Intl.NumberFormat().format(value);
});

const app = new Vue({
    el: '#products-page',
    store, 
    router,
    components:{
        ProductsIndex,
        Messages, 
        TopCart,
        CartSideBarMenu,
        SideBar,
        NavIcon,
        NewsLetter,
        SignUp      
    }   
});
