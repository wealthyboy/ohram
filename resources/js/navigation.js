
require('./bootstrap');

window.Vue = require('vue');
require ('../../public/js/plugins/owl.carousel.min.js')

import store from './store'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const SideBar = require('./components/products/SideBar.vue').default
const TopCart = require('./components/cart/Top.vue').default
const CartSideBarMenu = require('./components/cart/CartSideBarMenu.vue').default
const NavIcon = require('./components/navigation/Navicon.vue').default
const NewsLetter = require('./components/newsletter/Index.vue').default
const SignUp = require('./components/newsletter/SignUp.vue').default
const Messages =  require('./components/message/index.vue').default



let token = document.head.querySelector('meta[name="csrf-token"]');
Window.token = token.content

Vue.filter('priceFormat',function(value){
    return new Intl.NumberFormat().format(value);
});

const app = new Vue({
    el: '#app',
    store, 
    components:{
        TopCart,
        CartSideBarMenu,
        SideBar,
        NavIcon,
        NewsLetter,
        SignUp,
        Messages
    }   
});
