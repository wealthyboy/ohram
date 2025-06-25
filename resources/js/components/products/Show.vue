<template>
  <div class="">
    <div class="product-single-container product-single-default">
      <div class="row">
     
        <!-- End .product-single-details -->
      </div>
      <!-- End .row -->
    </div>
    <!-- End .product-single-container -->
  
    <!-- End .product-single-tabs -->
    <login-modal />
    <register-modal />
  </div>
</template>
<script>
import Images from "./Images.vue";
import LoginModal from "../auth/LoginModal.vue";
import RegisterModal from "../auth/RegisterModal.vue";
import { mapGetters, mapActions } from "vuex";
import Pagination from "../pagination/Pagination.vue";

export default {
  name: "Show",
  props: {
    product: Object,
    attributes: Object,
  },
  components: {
    Images,
    LoginModal,
    Pagination,
    RegisterModal,
  },
 
};
</script>
