<template>
    <div> 
        <div class="dropdownmenu-wrapper">
            <div class="dropdown-cart-header">
                <span>2 Items</span>
                <a href="" class="float-right">View Cart</a>
            </div><!-- End .dropdown-cart-header -->
            <div class="dropdown-cart-products">
                <div class="product">
                    <div class="product-details">
                        <h4 class="product-title">
                            <a href="product.html">Woman Necklace</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">1</span>
                            x $35.00
                        </span>
                    </div><!-- End .product-details -->

                    <figure class="product-image-container">
                        <a href="product.html" class="product-image">
                            <img src="/images/products/cart/product-2.jpg" alt="product" width="80" height="80">
                        </a>
                        <a href="index.html#" class="btn-remove icon-cancel" title="Remove Product"></a>
                    </figure>
                </div><!-- End .product -->
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>Total</span>

                <span class="cart-total-price float-right">$134.00</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="/checkout" class="btn btn-dark btn-block">Checkout</a>
            </div><!-- End .dropdown-cart-total -->
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