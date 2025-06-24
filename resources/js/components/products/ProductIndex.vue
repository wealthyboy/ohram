<template>
    <div class="row">
        <ProductCard  v-for="product in products" :key="product.id"  :product="product" />
    </div>
  </template>
  
  <script>
  import ProductCard from './ProductCard.vue'
  
  export default {
    props:{
        products: {
            type: Array,
            required: true
        }
    },
    components: {
      ProductCard,
    },

    data() {
      return {
        loading: true,
      };
    },
    mounted() {
      
    }
  }
  </script>
  