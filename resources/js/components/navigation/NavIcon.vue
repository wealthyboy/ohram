
<template>
    <div class="header-right w-lg-max ml-0 ml-lg-auto">
        <div class="header-contact d-none d-lg-flex align-items-center ml-auto pr-xl-4 mr-4">
        </div><!-- End .header-contact -->
        
        <a  v-if="!$root.loggedIn" href="/login" class="header-icon  pl-1"><i class="icon-user-2"></i> Sign in</a>

        <div v-if="$root.loggedIn" class="header-dropdown ml-4">
            <a href="/account" class="header-icon  pl-1"><i class="icon-user-2"></i></a>

            <div class="header-menu ">
                <ul>  
                    <li><a class="color--primary" href="/account"><i class="fas fa-user left mr-2"></i>Account</a></li>
                    <li><a class="color--primary" href="/orders"><i class="fas fa-sign-out-alt left mr-1"></i> Orders</a></li>
                    <li>
                        <a class="color--primary" href="/logout"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt left mr-1"></i>
                                            
                                            Logout
                                        </a>
                                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" :value="$root.token">
                                        </form>
                    </li>
                </ul>
            </div><!-- End .header-menu  -->
        </div>


        <div class="dropdown cart-dropdown">
            <a href="#" class="dropdown-toggle dropdown-arrow d-none d-lg-block" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <i class="icon-shopping-cart"></i>
                <span class="cart-count badge-circle">{{ cartItemCount }}</span>
            </a>

            <a href="#" class="dropdown-toggle dropdown-arrow  d-none d-block  d-xl-none  d-lg-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <i class="icon-shopping-cart"></i> Cart
                <span class="cart-count badge-circle color--primary">{{ cartItemCount }}</span>
            </a>
            <div class="dropdown-menu">
                <drop-down />
            </div><!-- End .dropdown-menu -->
        </div><!-- End .dropdown -->
    </div>

</template>
<script>

import { mapGetters,mapActions } from 'vuex'
import DropDown from '../cart/DropDown'

export default {
    data(){
        return {
          user:Window.auth,
          token:null
        } 
    },
    components:{
        DropDown,
    },
    computed:{
        ...mapGetters({
            cartItemCount:'cartItemCount',
            wishlistCount:'wishlistCount'
        })
    } ,
    created(){
       this.getWislist()
       let token = document.head.querySelector('meta[name="csrf-token"]');
       this.token = token.content
    },
    methods:{
        ...mapActions({
             getWislist:'getWislist',
        })
    }
}
</script>