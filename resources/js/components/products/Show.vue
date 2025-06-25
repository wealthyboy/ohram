<template>
  <div class="">
    <div class="product-single-container product-single-default">
      <div class="row">
     
        <!-- End .product-single-details -->
      </div>
      <!-- End .row -->
    </div>
    <!-- End .product-single-container -->
    <div class="product-single-tabs">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item pl-2">
          <a
            class="nav-link active"
            id="product-tab-desc"
            data-toggle="tab"
            href="#product-desc-content"
            role="tab"
            aria-controls="product-desc-content"
            aria-selected="true"
            ><h4>Description</h4></a
          >
        </li>

        <li class="nav-item">
          <a
            class="nav-link"
            id="Warranty_Return"
            data-toggle="tab"
            href="#Warranty-Return"
            role="tab"
            aria-controls="Warranty-Return"
            aria-selected="false"
            ><h4>REVIEWS</h4></a
          >
        </li>
      </ul>
      <div class="tab-content bg--gray">
        <div
          class="tab-pane fade show active pl-2"
          id="product-desc-content"
          role="tabpanel"
          aria-labelledby="product-tab-desc"
        >
          <div
            v-html="product.description"
            class="product-desc-content pl-2 pb-2"
          ></div>
          <!-- End .product-desc-content -->
        </div>
        <!-- End .tab-pane -->
        <div
          class="tab-pane fade fade"
          id="Warranty-Return"
          role="tabpanel"
          aria-labelledby="Warranty-Return"
        >
          <div class="product-reviews-content">
            <div class="row">
              <div class="col-xl-5 pb-5">
                <div v-if="$root.loggedIn" class="add-product-review">
                  <form action="#" class="comment-form m-0">
                    <h3 class="review-title">Add a Review</h3>

                    <div class="rating-form">
                      <label for="rating">Your rating</label>
                      <span class="rating-stars">
                        <a
                          class="star-1"
                          @click="getStarRating($event, 20)"
                          href="#"
                          >1</a
                        >
                        <a
                          class="star-2"
                          @click="getStarRating($event, 40)"
                          href="#"
                          >2</a
                        >
                        <a
                          class="star-3"
                          @click="getStarRating($event, 60)"
                          href="#"
                          >3</a
                        >
                        <a
                          class="star-4"
                          @click="getStarRating($event, 80)"
                          href="#"
                          >4</a
                        >
                        <a
                          class="star-5"
                          @click="getStarRating($event, 100)"
                          href="#"
                          >5</a
                        >
                      </span>

                      <select
                        name="rating"
                        id="rating"
                        required=""
                        style="display: none"
                      >
                        <option value="">Rate…</option>
                        <option value="5">Perfect</option>
                        <option value="4">Good</option>
                        <option value="3">Average</option>
                        <option value="2">Not that bad</option>
                        <option value="1">Very poor</option>
                      </select>
                    </div>

                    <div class="row">
                      <div class="col-md-6 float-left col-xl-12">
                        <label>Upload Your Photo </label>
                        <p>
                          <small class="text-danger bold"
                            >Images only, And must not be greater than
                            8mb</small
                          >
                        </p>

                        <div
                          id="m_image"
                          class="uploadloaded_image text-center pull-left mb-3"
                        >
                          <div
                            @click.prevent="activateFile"
                            v-if="!profile_photo"
                            class="upload-text"
                          >
                            <a class="activate-file first" href="#">
                              <img src="/backend/img/upload_icon.png" />
                              <b>Add Image </b>
                            </a>
                          </div>
                          <div
                            id="remove_image"
                            :class="[profile_photo ? '' : 'd-none']"
                            class="remove_image"
                          >
                            <a
                              class="activate-file"
                              @click.prevent="undoImage"
                              href="#"
                              >Remove</a
                            >
                          </div>

                          <img
                            v-if="profile_photo"
                            id="stored_image"
                            class="img-thumnail"
                            :src="profile_photo"
                            alt=""
                          />

                          <input
                            accept="image/*"
                            class="upload_input"
                            data-msg="Upload  your image"
                            @change="readURL($event)"
                            type="file"
                            id="file_upload_input"
                            name="img"
                          />
                          <input
                            type="hidden"
                            id=""
                            data-msg="Uplaod  your art work"
                            class="file_upload_input stored_image"
                            name="image"
                          />
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-6 col-xl-12">
                        <div class="form-group">
                          <textarea
                            id="comment"
                            v-model="form.description"
                            name="description"
                            class="rating_required form-control form-control-sm"
                            cols="45"
                            rows="10"
                            @input="removeError($event)"
                            @blur="vInput($event)"
                            aria-required="true"
                          >
                          </textarea>
                          <span
                            class="help-block error text-danger text-sm-left"
                            v-if="errors.description"
                          >
                            <strong class="text-danger">{{
                              formatError(errors.description)
                            }}</strong>
                          </span>
                        </div>
                        <!-- End .form-group -->
                      </div>
                    </div>

                    <input
                      type="submit"
                      class="btn btn-dark ls-n-15"
                      value="Submit"
                    />
                  </form>
                </div>
                <!-- End .add-product-review -->
                <div
                  v-if="!$root.loggedIn"
                  class="review-form-wrapper ml-3 mt-2"
                >
                  <button
                    data-toggle="modal"
                    data-target="#login-modal"
                    type="button"
                    class="bold btn btn--primary btn-round btn-block btn--primary"
                  >
                    Add Review
                  </button>
                </div>
              </div>
              <div class="col-xl-7">
                <h2
                  v-if="!loading && reviews.length"
                  class="review-title text-uppercase"
                >
                  {{ meta.total }} Review(s) for <span>This Product</span>
                </h2>

                <ol class="comment-list">
                  <li
                    v-for="review in reviews"
                    :key="review.id"
                    class="comment-container"
                  >
                    <div class="comment-avatar">
                      <img
                        class="avtar"
                        v-if="review.image"
                        width="65"
                        height="65"
                        :src="review.image"
                        alt="avtar"
                      />
                      <img
                        class="avtar"
                        v-else
                        src="/img/avtar.jpg"
                        width="65"
                        height="65"
                        alt="avtar"
                      />
                    </div>
                    <!-- End .comment-avatar-->

                    <div class="comment-box">
                      <div class="ratings-container">
                        <div class="product-ratings">
                          <span
                            class="ratings"
                            :style="{ width: review.rating + '%' }"
                          ></span
                          ><!-- End .ratings -->
                        </div>
                        <!-- End .product-ratings -->
                      </div>
                      <!-- End .ratings-container -->

                      <div class="comment-info mb-1">
                        <h4 class="avatar-name">{{ review.full_name }}</h4>
                        - <span class="comment-date">{{ review.date }}</span>
                      </div>
                      <!-- End .comment-info -->

                      <div class="comment-text">
                        <p>{{ review.description }}</p>
                      </div>
                      <!-- End .comment-text -->
                    </div>
                    <!-- End .comment-box -->
                  </li>
                  <!-- comment-container -->
                </ol>
                <!-- End .comment-list -->
                <div
                  v-if="!loading && meta && meta.total > meta.per_page"
                  class="pagination-wraper"
                >
                  <div class="pagination">
                    <ul class="pagination-numbers">
                      <pagination :useUrl="useUrl" :meta="meta" />
                    </ul>
                  </div>
                </div>

                <div
                  class="text-center bold"
                  v-if="!loading && !reviews.length"
                >
                  No Reviews
                </div>
              </div>
            </div>
          </div>
          <!-- End .product-reviews-content -->
        </div>
        <!-- End .tab-pane -->
      </div>
      <!-- End .tab-content -->
    </div>
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
  data() {
    return {
      attributesData: [],
      color: "",
      isActive: false,
      canNotAddToCart: false,
      image: "",
      cText: "Add To Cart",
      images: [],
      variant_images: [],
      noRating: false,
      user: Window.auth,
      file: null,
      quantity: "",
      useUrl: false,
      price: null,
      discounted_price: null,
      percentage_off: "",
      product_variation_id: "",
      product_variation: [],
      prodAttributes: null,
      category: "",
      cartSideBarOpen: false,
      loading: false,
      is_loggeIn: false,
      is_wishlist: null,
      image_m: "",
      image_tn: null,
      profile_photo: null,
      errorsBag: [],
      fadeIn: false,
      product_slug: this.product.slug,
      wishlistText: false,
      color_code: null,
      color_name: null,
      active_color: null,
      allowedFileTypes: ["image/jpeg", "image/png", "image/gif"],
      form: {
        description: null,
        rating: null,
        product_id: this.product.id,
        image: null,
      },
      submiting: false,
    };
  },
  computed: {
    ...mapGetters({
      cart: "cart",
      loggedIn: "loggedIn",
      wishlist: "wishlist",
      reviews: "reviews",
      meta: "reviewsMeta",
      errors: "errors",
    }),
    activeObject: function() {
      return {
        "active-attributes": this.isActive,
      };
    },
    cartText: function() {
      return this.cText;
    },
    canAddToCart: function() {
      return [this.product.qty < 1 ? "disabled" : ""];
    },
    loggedIn: function() {
      return [this.user ? true : false];
    },
  },
  mounted() {
    this.productReviews();
    this.image = this.product.image_to_show;
    this.image_tn = this.product.image_to_show_tn;
    this.images = this.product.add_images;
    this.product_variation_id = this.product.default_variation_id;
    this.percentage_off = this.product.default_percentage_off;
    this.quantity = this.product.qty;
    this.cText = this.product.qty < 1 ? "Out of Stock" : " Add To Cart";
    this.price = this.product.converted_price;
    this.discounted_price = this.product.default_discounted_price;
    this.is_wishlist = this.product.is_wishlist;
    this.variant_images = this.product.variants;
    if (this.product.colours.length != 0) {
        this.active_color = this.product.colours.shift();
        this.color_code =  this.active_color.color_code
        this.color_name =  this.active_color.name
    }
  },
  methods: {
    getStarRating(e, rating) {
      this.form.rating = rating;
      this.noRating = false;
      let ratings = document.querySelectorAll(".rating");
      ratings.forEach((elm) => {
        elm.classList.remove("active");
      });
      e.target.classList.add("active");
    },
    activateFile(evt) {
      let fileInput = document.getElementById("file_upload_input");
      fileInput.click();
    },
    readURL(input) {
      this.file = document.getElementById("file_upload_input").files[0];
      if (!this.allowedFileTypes.includes(this.file.type)) {
        this.error = "Your selected  is not alllowed";
        return;
      }
      //there I CHECK if the FILE SIZE is bigger than 8 MB (numbers below are in bytes)
      if (this.file.size > 8388608) {
        this.error = "Allowed file size exceeded. (Max. 8 MB)";
        return;
      }
      var reader = new FileReader();
      let context = this;

      reader.onload = function(e) {
        context.profile_photo = e.target.result;
      };
      reader.readAsDataURL(this.file);
    },
    undoImage() {
      this.profile_photo = null;
    },

    productReviews() {
      return axios
        .get("/reviews/" + this.product_slug)
        .then((response) => {
          this.loading = false;
          this.$store.commit("setReviews", response.data.data);
          this.$store.commit("setReviewsMeta", response.data.meta);
        })
        .catch((error) => {
          this.loading = false;
        });
    },
    getProduct() {
      axios.get("/api" + this.$route.path).then((response) => {
        let obj = response.data.data;
        this.product_variation = this.product.product_variation;
        window.Stock = JSON.parse(obj.stock);
        window.Inventory = JSON.parse(obj.inventory);
      });
    },
    currentSlide: function(image) {
      this.fadeIn = !this.fadeIn;
      this.image = image;
      setTimeout(() => {
        this.fadeIn = !this.fadeIn;
      }, 1000); // Will alert once, after a second.
    },

    getAttribute: function(evt, key) {
      this.cartError = null;
      let active_attribute = null,
        variation,
        first_attribute,
        active_other_attribute,
        other_attribute,
        oAv,
        ooA,
        iam,
        f = false,
        af = false,
        cA;
      let inventory = JSON.parse(this.product.inventory);
      let stock = JSON.parse(this.product.stock);
      first_attribute = document.querySelectorAll(".first-attribute");
      other_attribute = document.querySelectorAll(".other-attribute");
      /**
       * Toggle active statte
       */

      if (evt.target.classList.contains("first-attribute")) {
        first_attribute.forEach(function(elm, key) {
          elm.classList.remove("active-attribute");
        });
        evt.target.classList.add("active-attribute");
      }

      /**
       * Toggle active statte for other attributes
       */
      if (evt.target.classList.contains("other-attribute")) {
        other_attribute.forEach(function(elm, key) {
          elm.classList.remove("active-other-attribute");
        });
        evt.target.classList.add("active-other-attribute");
      }

      try {
        if (typeof inventory[0].length === "undefined") {
          let v = inventory[0][evt.target.dataset.value];
          for (let i in v) {
            if (i !== evt.target.dataset.name) {
              this.attributesData = Object.keys(v[i]);
            }
          }
        }
        active_attribute = document.querySelector(".active-attribute");
        active_other_attribute = document.querySelector(
          ".active-other-attribute"
        );
        if (active_attribute && this.attributesData.length != 0) {
          variation =
            active_attribute.dataset.value + "_" + this.attributesData[0];
        }
        if (active_attribute && this.attributesData.length == 0) {
          variation = active_attribute.dataset.value;
        }

        if (!active_attribute && active_other_attribute !== null) {
          variation = active_other_attribute.dataset.value;
        }

        if (
          active_attribute &&
          other_attribute.length !== 0 &&
          key != "Colors"
        ) {
          variation =
            active_attribute.dataset.value + "_" + evt.target.dataset.value;
        }

        console.log(variation, this.attributesData, evt.target.dataset.value);


        let vTs = stock[0][variation];
        if (key == "Colors") {
          this.image = vTs.image;
          this.image_m = vTs.image_m;
          this.images = vTs.images;
        }
        this.quantity = vTs.quantity;
        this.price = vTs.converted_price;
        this.percentage_off = vTs.percentage_off;
        this.discounted_price =
          vTs.discounted_price || vTs.default_discounted_price;
        this.product_variation_id = vTs.id;
        this.canNotAddToCart = false;
        this.cText = this.quantity >= 1 ? "Add To Cart" : "Item is sold out";
      } catch (error) {
        console.log(error);
        this.canNotAddToCart = true;
        this.cText = "Sold Out";
        this.quantity = 0;
      }
    },
    owlCarousels: function() {},
    selectProductAttributes: function() {
      let values = [];
      let attributes = document.querySelectorAll("select.vs");
      attributes.forEach(function(elm, key) {
        values.push(elm.value);
      });
      return values;
    },
    formatError(error) {
      return Array.isArray(error) ? error[0] : error;
    },
    removeError(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.clearErrors({ context: this, input: input });
      }
    },
    vInput(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.checkInput({ context: this, input: e });
      }
    },
    showColor(color) {
      this.color = color;
    },
    removeColor(color) {
      this.color = "";
    },
    ...mapActions({
      addProductToCart: "addProductToCart",
      addProductToWishList: "addProductToWishList",
      createReviews: "createReviews",
      validateForm: "validateForm",
      clearErrors: "clearErrors",
      checkInput: "checkInput",
      getReviews: "getReviews",
    }),
    addToCart: function() {
      let qty = document.getElementById("add-to-cart-quantity").value;
      if (qty === "") {
        return;
      }
      this.cText = "Adding....";
      this.loading = true;
      this.addProductToCart({
        product_variation_id: this.product_variation_id,
        quantity: qty,
      })
        .then(() => {
          this.cText = "Add To Cart";
          this.loading = false;
        })
        .catch((error) => {
          this.cText = "Add To Cart";
          this.loading = false;
        });
    },
    addToWishList: function() {
      this.wishlistText = true;
      this.addProductToWishList({
        product_variation_id: this.product_variation_id,
      }).then((response) => {
        this.wishlistText = false;
        if (
          this.wishlist.some(
            (wishlist) =>
              wishlist.product_variation.id === this.product_variation_id
          )
        ) {
          this.is_wishlist = true;
          return;
        }
        this.is_wishlist = false;
      });
    },
    submit() {
      let input = document.querySelectorAll(".rating_required");
      this.validateForm({ context: this, input: input });
      if (Object.keys(this.errors).length !== 0) {
        if (!this.form.rating) {
          this.noRating = true;
        }
        return false;
      }
      this.submiting = true;
      let form = new FormData();
      form.append("image", this.file);
      form.append("description", this.form.description);
      form.append("rating", this.form.rating);
      form.append("product_id", this.form.product_id);
      this.createReviews({ context: this, form });
    },
  },
};
</script>
