<template>
    <div class="col-12 col-sm-6 col-lg-3 mb-2">
      <div class="card h-100 shadow border-0 rounded-4 position-relative text-center">
  
        <!-- Top Left Badge -->
        <span
          v-if="product.sold_out"
          class="position-absolute top-0 start-0 mt-2 ms-2 z-1 badge bg-dark text-white fw-semibold rounded-pill">
          <div class="product-label label-sale bold text-white">Sold Out</div>
        </span>
  
        <!-- Top Right Badge -->
        <span
          v-if="product.is_limited"
          class="position-absolute top-0 end-0 mt-2 me-2 z-1 badge bg-dark text-white fw-semibold rounded-pill">
          <div class="product-label label-sale bold text-white">Limited</div>
        </span>
  
        <!-- Product Image -->
         <a :href="product.link" class="href">
            <img
                :src="product.image_m"
                class="card-img-top p-4"
                style="object-fit:contain; height:200px;"
                :alt="product.product_name"
            />
         </a>
      
  
        <div class="card-body d-flex flex-column">
            <a :href="product.link" class="no-underline">
              <h5 class="card-title fw-bold text-dark mb-1">{{ product.product_name }}</h5>
            </a>
          <p class="card-text small text-muted mb-3">
            <template v-if="product.default_discounted_price">
              <span class="old-price bold">{{ product.currency }}{{ formatNumber(product.converted_price) }}</span>
              <span class="product-price bold">{{ product.currency }}{{ formatNumber(product.default_discounted_price) }}</span>
            </template>
            <template v-else>
              <span class="product-price bold">{{ product.currency }}{{ formatNumber(product.converted_price) }}</span>
            </template>
          </p>
  
          <!-- Quick Add Button -->
          <button
            @click.prevent="addToCart"
            class="btn btn-quick-add mx-auto px-4 py-2 mb-2"
            :disabled="loading"
            >
            <span>{{ cartText }}</span>
            </button>
  
          <!-- View Product -->
          <a :href="product.link" class="small link-underline link-underline-opacity-0 link-danger">View product</a>
  
          <!-- Spacer -->
          <div class="flex-grow-1"></div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions } from "vuex";
  
  export default {
    name: 'ProductCard',
  
    props: {
      product: {
        type: Object,
        required: true
      }
    },
  
    data() {
      return {
        loading: false,
        success: false,
        added: false,
        cartText: "QUICK ADD"

      }
    },
  
    methods: {
      formatNumber(value) {
        return Number(value).toLocaleString();
      },
  
      ...mapActions({
        addProductToCart: "addProductToCart",
      }),
      addToCart() {
            this.loading = true;
            this.cartText = "ADDING..."

            axios.post('/api/cart', {
                product_variation_id: this.product.default_variation_id,
                quantity: 1,
            }).then((response) => {
                this.$store.commit('appendToCart',response.data.data)
                this.$store.commit('setCartMeta',response.data.meta)
                this.loading = false;
                this.added = true;
                this.cartText = "Added!"
                setTimeout(() => {
                    this.cartText = "QUICK ADD"
                }, 1500);

            })

           
        },
    }
  }
  </script>
<style scoped>
.btn-quick-add[disabled] {
  opacity: 0.6;
  cursor: not-allowed;
}

</style>
  