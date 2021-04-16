<template>
    <div> 
        <div class="dropdownmenu-wrapper color--primary">
            <div class="dropdown-cart-header text-center">
                <h3>SHOPPING CART</h3>
            </div><!-- End .dropdown-cart-header -->
            <div class="cart-section"   v-if="meta.sub_total">
                <div class="dropdown-cart-products color--primary">
                    <div v-for="cart in carts" :key="cart.id" class="product">
                        <div  class="product-details">
                            <div class="product-title color--primary">
                                <a class=" color--primary" href="#">{{ cart.product_name }}</a>
                            </div>
                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ cart.quantity }} </span>
                                x <span class="cart-product-amount">{{ cart.currency }}</span>{{ cart.sale_price || cart.price | priceFormat }}
                            </span>
                            <p v-if="cart.variations.length"> {{ cart.variations.toString() }} </p>
                        </div><!-- End .product-details -->

                        <figure class="product-image-container">
                            <a href="#" class="product-image">
                                <img :src="cart.image" :alt="cart.product_name" width="80" height="80">
                            </a>
                            <a href="#" @click.prevent="removeFromCart(cart.id)" class="btn-remove icon-cancel" title="Remove Product"></a>
                        </figure>
                    </div><!-- End .product -->
                </div><!-- End .cart-product -->

                <div class="dropdown-cart-total bold">
                    <span>Total</span>
                    <span class="cart-total-price float-right">{{ meta.currency }}{{ meta.sub_total | priceFormat }}</span>
                </div><!-- End .dropdown-cart-total -->
                <div class="dropdown-cart-action">
                    <a href="/cart" class="btn btn-outline-secondary color--primary btn-block">View Cart</a>
                </div><!-- End .dropdown-cart-total -->
                <div class="dropdown-cart-action">
                    <a href="/checkout" class="btn btn--primary btn-block">Checkout</a>
                </div><!-- End .dropdown-cart-total -->
            </div>
            <div class="cart-sidebar-content d-flex justify-content-center"  v-if="!carts.length">
                <div class="text-center pb-3">
                    <img  width="100" height="100" src="/images/utilities/empty_product.svg" /> 
                    <p class="bold">Your cart is empty</p>
                </div>
            </div>
        </div><!-- End .dropdownmenu-wrapper -->
    </div>
</template>

<script>
import  { mapGetters,mapActions } from 'vuex'

export default {
    
    computed: {
        ...mapGetters({
            carts: 'carts',
            meta: 'meta'
        })
    },  
    mounted(){
       this.getCart()
    },
    methods: {
        ...mapActions({
            getCart:'getCart',
            deleteCart: 'deleteCart'
        }),
        removeFromCart(cart_id){
            this.deleteCart({
                cart_id:cart_id
            })
        }

    }
    
}
</script>