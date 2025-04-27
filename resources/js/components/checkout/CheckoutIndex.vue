<template>
  <div>
    <div v-if="payment_is_processing" class="c-overlay">
      <div class="mr-2 ml-2 bold text-center" id="text">
        <span
          class="spinner-border spinner-border-lg"
          role="status"
          aria-hidden="true"
        ></span>
      </div>
    </div>
    <div v-if="paymentIsComplete" class="page-contaiter">
      <!--Content-->
      <section class="sec-padding--lg vh--100">
        <div class="container">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="error-page text-center">
                <h1>Thank you for shopping with us</h1>
                <p class="large">Your order has been received .</p>
                <p class="large"></p>
                <a href="/" class="btn btn--primary space-t--2">Continue</a>
                <a href="/orders" class="btn btn--primary space-t--2"
                  >View order history</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--End Content-->
    </div>

    <div v-if="failedStatus" class="page-contaiter">
      <!--Content-->
      <section class="sec-padding--lg vh--100">
        <div class="container">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="error-page text-center">
                <h1>Payment Status</h1>
                <p class="large text-danger bold">
                  {{ failedStatus.ResponseDescription }}.
                </p>
                <p class="large text-danger bold">
                  Transaction Reference: {{ failedStatus.MerchantReference }}.
                </p>
                <p class="large"></p>
                <a href="" class="btn btn--primary space-t--2">Try again</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--End Content-->
    </div>
    <div
      v-if="!pageIsLoading && !failedStatus && !paymentIsComplete"
      class="container mt-1"
    >
      <div class="row d-none justify-content-center">
        <ul class="checkout-progress-bar">
          <li :class="{ active: !addresses.length }">
            <span>Shipping Address</span>
          </li>
          <li :class="{ active: addresses.length }">
            <span>Review &amp; Payments</span>
          </li>
        </ul>
      </div>
      <div class="row align-items-start">
        <div class="col-12 col-md-7">
          <div class="col-md-12 m7 bg--light border border-gray mb-2">
            <div class="head border-bottom pt-3 mb-3">
              <h3>1. SHIPPING ADDRESS</h3>
            </div>
            <ship-address />
          </div>

          <div class="col-md-12 bg--light">
            <div class="pt-3 pb-2">
              <span class="float-right">
                <div class="payment-icons mt-1 d-flex">
                  <div class="payment-image ms mr-3">
                    <img
                      src="/img/business.png"
                      alt="make payment with mastercard"
                    />
                  </div>
                  <div class="payment-image mr-3">
                    <img
                      src="/img/visa-card-ohram.png"
                      alt="make payment with mastercard"
                    />
                  </div>

                  <div class="payment-image">
                    <img
                      src="/img/Verve.png"
                      alt="make payment with mastercard"
                    />
                  </div>
                </div>
              </span>
              <h3>2. PAYMENT</h3>
            </div>
            <div class="" v-if="addresses.length" id="add-new-address-form">
              <div class="form-field-wrapper col-sm-12">
                <div
                  v-for="cart in carts"
                  :key="cart.id"
                  class="row cart-rows mb-2 pt-4 pb-2 border-top border-gray"
                >
                  <div class="col-md-2 col-6">
                    <div class="cart-image">
                      <img :src="cart.product_variation.image_tn" alt="" />
                    </div>
                  </div>
                  <div class="col-md-7 col-6">
                    <div class="mb-1">
                      <a href="#">{{ cart.product_name }}</a>
                    </div>
                    <!--Product Ratting-->
                    <div
                      class="product-item-prices d-flex"
                      v-if="cart.product_variation.discounted_price"
                    >
                      <div class="product--price--amount">
                        <span class="retail--title text-gold">SALE PRICE</span>
                        <span class="product--price text-danger"
                          >{{ meta.currency
                          }}{{ cart.sale_price | priceFormat }}</span
                        >
                        <span class="retail--title"
                          >{{ cart.product_variation.percentage_off }}%
                          off</span
                        >
                      </div>

                      <div class="product--price--amount retail ml-5">
                        <span class="retail--title text-gold">PRICE</span>
                        <span class="product--price retail--price"
                          >{{ meta.currency
                          }}{{ cart.price | priceFormat }}</span
                        >
                        <span class="retail--title"></span>
                      </div>
                    </div>

                    <div class="product-item-prices" v-else>
                      <div class="product--price--amount">
                        <span class="retail--title text-gold">PRICE</span>
                        <span class="product--price"
                          >{{ meta.currency
                          }}{{ cart.price | priceFormat }}</span
                        >
                        <span class="retail--title"></span>
                      </div>
                    </div>
                    <p v-if="cart.variations.length">
                      {{ cart.variations.toString() }}
                    </p>
                  </div>
                </div>
                <p class="border-bottom pb-3">
                  <span style="font-size: 22px" class="bold">Subtotal</span>
                  <span class="float-right"
                    ><span
                      style="font-size: 22px"
                      class="currencySymbol f-20 bold"
                      >{{ meta.currency
                      }}{{ meta.sub_total | priceFormat }}</span
                    >
                  </span>
                </p>
                <div class="border-bottom pb-3">
                  <span class="bold">Shipping</span>

                  <span class="float-right">
                    <span v-if="shipping_price" class="currencySymbol bold"
                      >{{ meta.currency }}{{ shipping_price }}</span
                    >
                    <span class="" v-else>{{ shippingIsFree }}</span>
                  </span>
                </div>

                <div class="">
                  <p class="form-field-wrapper col-sm-12"></p>
                  <form action="#">
                    <div v-if="settings.shipping_is_free == 0" class="shipping">
                      <label for="shipping_country"
                        >SELECT SHIPPING &nbsp;<abbr
                          class="required text-danger"
                          title="required"
                          >*</abbr
                        ></label
                      >
                      <select
                        @change="addShippingPrice"
                        name="shipping_id"
                        id="shipping_price"
                        class="form-control input--lg"
                        autocomplete="shipping"
                        tabindex="-1"
                        aria-hidden="true"
                      >
                        <option value="" selected="selected">
                          Choose a shipping
                        </option>
                        <optgroup
                          v-for="(map, key) in default_shipping"
                          :key="key"
                          :label="key"
                        >
                          <option
                            :data-id="shipping.id"
                            :key="shipping.id"
                            v-for="shipping in map"
                            :value="shipping.converted_price"
                          >
                            {{ shipping.name }} &nbsp;&nbsp;&nbsp;{{
                              meta.currency
                            }}{{ shipping.converted_price }}
                          </option>
                        </optgroup>
                      </select>
                    </div>

                    <span v-if="error" class="" role="">
                      <strong class="text-capitalize text-danger">{{
                        error
                      }}</strong>
                    </span>
                  </form>
                </div>

                <div class="cart-discount col-sm-12 p-0">
                  <h4>Apply Discount Code</h4>
                  <div class="input-group">
                    <input
                      type="text"
                      v-model="coupon"
                      class="form-control"
                      placeholder="Enter discount code"
                      required=""
                    />
                    <div class="input-group-append">
                      <button
                        @click.prevent="applyCoupon"
                        class="btn btn-sm btn-primary"
                        type="submit"
                      >
                        <span
                          v-if="submiting"
                          class="spinner-border spinner-border-sm"
                          role="status"
                          aria-hidden="true"
                        ></span>
                        Apply Coupon
                      </button>
                    </div>
                  </div>
                  <!-- End .input-group -->
                </div>

                <span
                  v-if="coupon_error"
                  class="text-capitalize bold ml-3 text-danger"
                  >{{ coupon_error }}</span
                >

                <p>
                  <span class="bold fa-2x ">Total</span>
                  <template v-if="voucher.length">
                    <span class="price-amount amount bold float-right mr-3">
                      <span class="currencySymbol fa-2x text-danger"
                        ><del
                          >{{ meta.currency
                          }}{{ meta.sub_total | priceFormat }}</del
                        ></span
                      >
                    </span>
                    <span class="price-amount amount bold float-right mr-3">
                      <span style="" class="currencySymbol fa-2x"
                        >{{ meta.currency
                        }}{{ amount || meta.sub_total | priceFormat }}</span
                      >
                      <p class="retail-title fa-1x">{{ voucher[0].percent }}</p>
                    </span>
                  </template>
                  <template v-else>
                    <span class="price-amount amount bold float-right mr-3">
                      <span style="" class="currencySymbol fa-2x"
                        >{{ meta.currency
                        }}{{ amount || meta.sub_total | priceFormat }}
                      </span>
                    </span>
                  </template>
                </p>

               
              </div>

                <div class="">
                  <div class="mb-3 position-relative px-3">
                     <div class="d-flex justify-content-between align-items-center">
                         <h4 class="form-labelm">Card information</h4>
                          <div  class="d-flex">
                            <span id="vt-4d966fe6c1a14bada546b485b7306504-VISA" class="_6f3AR" style="view-transition-name: vt-4d966fe6c1a14bada546b485b7306504-VISA; display: flex;"><img alt="VISA" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/visa.sxIq5Dot.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsy _1fragemst _1fragemt8 _1fragemoq _1tgdqw66"></span>
                            <span id="vt-4d966fe6c1a14bada546b485b7306504-MASTERCARD" class="_6f3AR" style="view-transition-name: vt-4d966fe6c1a14bada546b485b7306504-MASTERCARD; display: flex;"><img alt="MASTERCARD" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/mastercard.1c4_lyMp.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsy _1fragemst _1fragemt8 _1fragemoq _1tgdqw66"></span>
                            <span id="vt-4d966fe6c1a14bada546b485b7306504-AMEX" class="_6f3AR" style="view-transition-name: vt-4d966fe6c1a14bada546b485b7306504-AMEX; display: flex;"><img alt="AMEX" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/amex.Csr7hRoy.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsy _1fragemst _1fragemt8 _1fragemoq _1tgdqw66"></span>
                            <span id="vt-4d966fe6c1a14bada546b485b7306504-DISCOVER" class="_6f3AR" style="view-transition-name: vt-4d966fe6c1a14bada546b485b7306504-DISCOVER; display: flex;"><img alt="DISCOVER" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/discover.C7UbFpNb.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsy _1fragemst _1fragemt8 _1fragemoq _1tgdqw66"></span>
                          </div>
              
                     </div>

                    <div class="position-relative">
                      <div id="card-number-element" class="form-control py-4 pe-5"></div>
                    </div>
                  </div>

                  <!-- Expiry + CVC -->

                 

                  <div class="row px-3">

                    <div  style="margin-top: -25px;" class=" col-md-6 pr-1">
                      <div
                        id="card-expiry-element"
                        class="form-control border-radius py-4 pe-5 "
                      ></div>
                    </div>

                    <div style="margin-top: -25px;" class="col-md-6 pl-1">
                      <div class="position-relative">
                        <div id="card-cvc-element" class="form-control py-4 pe-5 " style="padding-right: 50px;"></div>

                        <div
                              style="
                              position: absolute;
                              right: 15px;
                              top: 50%;
                              transform: translateY(-50%);
                              pointer-events: none;
                              z-index: 10;"
                          >
                          <svg 
                            class="Icon Icon--md" 
                            viewBox="0 0 32 21" 
                            aria-label="CVC" 
                            width="24" 
                            height="16" 
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <title>CVC</title>
                            <g fill="currentColor" fill-rule="evenodd">
                              <g class="Icon-fill">
                                <g transform="translate(0 2)">
                                  <path 
                                    d="M21.68 0H2c-.92 0-2 1.06-2 2v15c0 .94 1.08 2 2 2h25c.92 0 2-1.06 2-2V9.47a5.98 5.98 0 0 1-3 1.45V11c0 .66-.36 1-1 1H3c-.64 0-1-.34-1-1v-1c0-.66.36-1 1-1h17.53a5.98 5.98 0 0 1 1.15-9z" 
                                    opacity="0.2"
                                  ></path>
                                  <path 
                                    d="M19.34 3H0v3h19.08a6.04 6.04 0 0 1 .26-3z" 
                                    opacity="0.3"
                                  ></path>
                                </g>
                                <g transform="translate(18)">
                                  <path 
                                    d="M7 14A7 7 0 1 1 7 0a7 7 0 0 1 0 14zM4.22 4.1h-.79l-1.93.98v1l1.53-.8V9.9h1.2V4.1zm2.3.8c.57 0 .97.32.97.78 0 .5-.47.85-1.15.85h-.3v.85h.36c.72 0 1.21.36 1.21.88 0 .5-.48.84-1.16.84-.5 0-1-.16-1.52-.47v1c.56.24 1.12.37 1.67.37 1.31 0 2.21-.67 2.21-1.64 0-.68-.42-1.23-1.12-1.45.6-.2.99-.73.99-1.33C8.68 4.64 7.85 4 6.65 4a4 4 0 0 0-1.57.34v.98c.48-.27.97-.42 1.44-.42zm4.32 2.18c.73 0 1.24.43 1.24.99 0 .59-.51 1-1.24 1-.44 0-.9-.14-1.37-.43v1.03c.49.22.99.33 1.48.33.26 0 .5-.04.73-.1.52-.85.82-1.83.82-2.88l-.02-.42a2.3 2.3 0 0 0-1.23-.32c-.18 0-.37.01-.57.04v-1.3h1.44a5.62 5.62 0 0 0-.46-.92H9.64v3.15c.4-.1.8-.17 1.2-.17z"
                                  ></path>
                                </g>
                              </g>
                            </g>
                          </svg>
                          </div>
                      </div>
                    </div>
                   
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                      <div id="payment-request-button"></div> 
                    </div>
                </div>

                <div class="px-3">
                <template v-if="settings.shipping_is_free == 0 && amount > 1">
                  <button
                    @click="makePayemnt"
                    :class="{ disabled: payment_is_processing }"
                    type="button"
                    class="btn btn-round btn-lg btn-block btn--primary bold l-f1 btn--full"
                    name="checkout_place_order"
                    id="place_order"
                    value="Place order"
                    data-value="Place Order"
                  >
                    <span
                      v-if="checkingout"
                      class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    {{ order_text }}
                  </button>
                </template>
                <template v-else>
                  <button
                    @click="makePayemnt"
                    type="button"
                    :class="{ disabled: payment_is_processing }"
                    class="btn bold btn--primary btn-round btn-lg btn-block"
                    name="checkout_place_order"
                    id="p lace_order"
                    value="Place order"
                    data-value="Place Order"
                  >
                    <span
                      v-if="checkingout"
                      class="spinner-border spinner-border-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    {{ order_text }}
                  </button>
                </template>
                <small>
                  🔒 Your payment information is safe. We use Stripe to securely manage your payment information and we never store your complete card number ourselves.

                </small>
               </div>
            </div>
          </div>
        </div>
        <div class="col-5">
          <div class="col-md-12 d-none d-lg-block mb-3">
            <div
              class="cart-collateralse bg--light border pb-3 pt-3 pl-3 pt-3 pr-3"
            >
              <div class="cart_totalse">
                <div class="head border-bottom">
                  <h3>SUMMARY</h3>
                </div>

                <div
                  v-for="cart in carts"
                  :key="cart.id"
                  class="row cart-rows mb-2 pt-4 pb-2 border-top border-gray"
                >
                  <div class="col-md-2 col-6">
                    <div class="cart-image">
                      <img :src="cart.product_variation.image_tn" alt="" />
                    </div>
                  </div>
                  <div class="col-md-7 col-6">
                    <div>
                      <a href="#">{{ cart.product_name }}</a>
                    </div>
                    <!--Product Ratting-->
                    <div
                      class="product-item-prices d-flex"
                      v-if="cart.product_variation.discounted_price"
                    >
                      <div class="product--price--amount mr-5">
                        <span class="retail--title text-gold">SALE PRICE</span>
                        <span class="product--price text-danger"
                          >{{ meta.currency
                          }}{{ cart.sale_price | priceFormat }}</span
                        >
                        <span class="retail--title"
                          >{{ cart.product_variation.percentage_off }}%
                          off</span
                        >
                      </div>

                      <div class="product--price--amount retail ml-5">
                        <span class="retail--title text-gold">PRICE</span>
                        <span class="product--price retail--price"
                          >{{ meta.currency
                          }}{{ cart.price | priceFormat }}</span
                        >
                        <span class="retail--title"></span>
                      </div>
                    </div>

                    <div class="product-item-prices" v-else>
                      <div class="product--price--amount">
                        <span class="retail--title text-gold">PRICE</span>
                        <span class="product--price"
                          >{{ meta.currency
                          }}{{ cart.price | priceFormat }}</span
                        >
                        <span class="retail--title"></span>
                      </div>
                    </div>
                    <p v-if="cart.variations.length">
                      {{ cart.variations.toString() }}
                    </p>
                  </div>
                </div>

                <p class="pt-3 pb-1">
                  <span style="font-size: 22px" class="bold">Subtotal</span>
                  <span class="bold float-right"
                    ><span class="currencySymbol"
                      >{{ meta.currency
                      }}{{ meta.sub_total | priceFormat }}</span
                    ></span
                  >
                </p>
                <p class="border-top border-bottom pb-3 pt-3">
                  <span class="bold">Shipping</span>
                  <span class="bold float-right">
                    <span v-if="shipping_price" class="currencySymbol"
                      >{{ meta.currency }}{{ shipping_price }}</span
                    >
                    <small v-else> {{ shippingIsFree }}</small>
                  </span>
                </p>

                <p>
                  <span style="font-size: 28px" class="bold">Total</span>
                  <span class="price-amount amount bold float-right"
                    ><span style="font-size: 28px" class="currencySymbol"
                      >{{ meta.currency
                      }}{{ amount || meta.sub_total | priceFormat }}</span
                    ></span
                  >
                </p>
                <div class="proceed-to-checkout"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ShipAddress from "./ShipAddress";
import message from "../message/index";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
import ErrorMessage from "../messages/components/Error";

export default {
  components: {
    ShipAddress,
    message,
    ErrorMessage,
  },
  props: {
    csrf: Object,
    payment: Array,
    settings: Object,
  },
  data() {
    return {
      coupon: "",
      locations: [],
      shipping_id: null,
      shipping_price: "",
      email: "jacob.atam@gmail.com",
      amount: 0,
      order_text: "Place Order",
      payment_is_processing: false,
      voucher: [],
      error: null,
      showForm: false,
      scriptLoaded: null,
      submiting: false,
      checkingout: false,
      coupon_error: null,
      token: Window.csrf,
      payment_method: null,
      loading: false,
      pageIsLoading: true,
      paymentIsProcess: false,
      failedStatus: null,
      txref: null,
      paymentIsComplete: false,
      allowPayment: false,
      stripe: null,
      elements: null,
      cardNumber: null,
      cardExpiry: null,
      cardCvc: null,
      processing: false,
      error: "",
      success: false,
    };
  },

  computed: {
    ...mapGetters({
      carts: "carts",
      meta: "meta",
      addresses: "addresses",
      default_shipping: "default_shipping",
    }),
    shippingIsFree() {
      return this.settings?.shipping_is_free == 0
        ? "Shipping is based on your location"
        : this.meta.currency + "0.00";
    },
    finalPrice() {
      let p = this.amount || this.meta.sub_total;
      return p * 100;
    },
  },
  mounted() {
  
    setTimeout(() => {
      this.stripe = Stripe(Window.MIX_STRIPE_KEY);
      this.elements = this.stripe.elements();
      this.cardNumber = this.elements.create('cardNumber', {
       
        placeholder: 'Card Number',
        showIcon: true
      })
      this.cardNumber.mount("#card-number-element");
      this.cardExpiry = this.elements.create("cardExpiry");
      this.cardExpiry.mount("#card-expiry-element");
      this.cardCvc = this.elements.create("cardCvc");

      this.cardCvc.mount("#card-cvc-element");
      const paymentRequest =  this.stripe.paymentRequest({
        country: 'US',
        currency: 'usd',
        total: {
          label: 'Total',
          amount: 1099, // $10.99
        },
        requestPayerName: true,
        requestPayerEmail: true,
    });

      // Create a Payment Request Button
      const prButton = this.elements.create('paymentRequestButton', {
        paymentRequest: paymentRequest,
      });

      paymentRequest.canMakePayment().then(function(result) {
        if (result) {
          prButton.mount('#payment-request-button'); // Your div for the button
        } else {
          document.getElementById('payment-request-button').style.display = 'none';
        }
      });
    }, 5000);
  },
  created() {
    this.scriptLoaded = new Promise((resolve) => {
      this.loadScript(() => {
        resolve();
      });
    });
    this.getCart();
    this.getAddresses({ context: this }).then(() => {
      document.getElementById("full-bg").style.display = "none";
      this.pageIsLoading = false;
    });
  },
  methods: {
    ...mapActions({
      getCart: "getCart",
    }),
    getRandomInt: function (min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    },
    async makePayemnt() {
      this.processing = true;
      this.error = "";
      this.success = false;

      try {
        const response = await fetch("/create-payment-intent", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
        });

        const { client_secret } = await response.json();

        const result = await this.stripe.confirmCardPayment(client_secret, {
          payment_method: {
            card: this.cardNumber,
          },
        });

        if (result.error) {
          this.error = result.error.message;
        } else if (result.paymentIntent.status === "succeeded") {
          this.success = true;
        }
      } catch (err) {
        this.error = "Something went wrong. Please try again.";
      } finally {
        this.processing = false;
      }
    },

    async logTransaction(txref, shipping_id, coupon, currencyCode) {
      await axios
        .post("/log/transaction", {
          txref: txref,
          productId: 22125466,
          amount: this.amount,
          shipping_id: shipping_id,
          shipping_price: this.shipping_price,
          coupon: coupon,
          currencyCode: currencyCode,
        })
        .then((response) => {
          this.allowPayment = true;
        })
        .catch((error) => {});
    },
    loadScript(callback) {
      const script = document.createElement("script");
      script.src =
        "https://sandbox.interswitchng.com/collections/public/webpay.js";
      document.getElementsByTagName("head")[0].appendChild(script);
      if (script.readyState) {
        // IE
        script.onreadystatechange = () => {
          if (
            script.readyState === "loaded" ||
            script.readyState === "complete"
          ) {
            script.onreadystatechange = null;
            callback();
          }
        };
      } else {
        // Others
        script.onload = () => {
          callback();
        };
      }
    },
    async makePayemnt() {
      if (this.meta.currency == "₦") {
        this.payWithPaystack();
        return;
      }

      let context = this;
      var cartIds = [];
      document.getElementById("full-bg").style.display = "none";
      document.querySelector(".loading").style.display = "none";

      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (this.settings.shipping_is_free == 0 && !this.shipping_price) {
        this.error = "Please select your shipping method";
        return false;
      } else {
        //this.amount =  this.meta.sub_total
      }

      $(".checkout-overlay").removeClass("d-none");
      let form = document.getElementById("checkout-form-2");
      this.order_text = "Payment is processing. Please wait....";
      this.payment_is_processing = true;
      this.payment_method = "card";
      var reqRef = this.transReference();
      var product_id = 22125466;
      var pay_item_id = 8352215;
      var amount = this.amount * 100;

      var mac =
        "AGYclEQngemQDoUCSJBGzeYro8Keu8rVLVjR1aCsR0Mk0TaAjgiI3UnU1aV9a0fQ96KcGLPDOrHOy3oSDjnUMZEo2NJFFXu1hpnYnwcTrJg1RJdc7fo4bvlzHp8a97DX";
      var site_redirect_url = "https://ohram.org/checkout/confirm";

      var reqRef = this.transReference();
      var shipping_id = this.shipping_id;
      var signatureCipher =
        reqRef + product_id + pay_item_id + amount + site_redirect_url + mac;
      var res = await this.logTransaction(
        reqRef,
        shipping_id,
        this.coupon,
        this.meta.currency
      );
      if (!this.allowPayment) {
        alert("Payment gateway error. Please try again");
        return false;
      }

      var iswPay = new IswPay({
        postUrl: "https://webpay.interswitchng.com/collections/w/pay",
        amount: amount,
        productId: product_id,
        transRef: reqRef,
        siteName: "OHRAM COMPANY INTERNATIONAL",
        itemId: pay_item_id,
        customerId: context.meta.user.id,
        siteRedirectUrl: site_redirect_url,
        currency: context.currencyCode(),
        hash: Sha512.hash(signatureCipher),
        onComplete: function (paymentResponse) {
          if (paymentResponse.resp == "00") {
            context.paymentIsComplete = true;
            $(".checkout-overlay").addClass("d-none");
          } else {
            context.order_text = "Place Order";
            axios
              .post("/transaction/status", {
                productId: product_id,
                reqRef: reqRef,
                amount: amount,
                hash: Sha512.hash(signatureCipher),
              })
              .then((response) => {
                context.failedStatus = response.data.status;
                context.payment_is_processing = false;
                $(".checkout-overlay").addClass("d-none");
              })
              .catch((error) => {
                console.log(error);
              });
          }
        },
      });
    },
    transReference: function () {
      var a = this.getRandomInt(12345678, 10000000000);
      var b = "JB-";
      var c = "-NWEB";
      return b + a + c;
    },
    currencyCode: function () {
      if (this.meta.currency == "₦") {
        return "NGN";
      }
      if (this.meta.currency == "$") {
        return "USD";
      }
      if (this.meta.currency == "£") {
        return "GBP";
      }

      if (this.meta.currency == "€") {
        return "EUR";
      }
    },
    payWithPaystack: function () {
      if (this.meta.sub_total < 1) {
        return;
      }
      let context = this;
      var cartIds = [];
      this.carts.forEach(function (cart, key) {
        cartIds.push(cart.id);
      });

      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (this.settings.shipping_is_free == 0 && !this.shipping_price) {
        this.error = "Please select your shipping method";
        return false;
      }

      let form = document.getElementById("checkout-form-2");
      this.order_text = "Please wait. We are almost done......";
      this.payment_is_processing = true;
      this.payment_method = "card";
      var handler = PaystackPop.setup({
        key: "pk_live_8260bf35964c9d1f60fe6b2adfb96994117c1b16", //'pk_live_8260bf35964c9d1f60fe6b2adfb96994117c1b16',//'pk_test_9da85e18cb810c930df5ec111edf9a2b0c4ac949',
        email: context.meta.user.email,
        amount: context.amount * 100,
        currency: "NGN",
        first_name: context.meta.user.name,
        metadata: {
          custom_fields: [
            {
              display_name: context.meta.user.name,
              customer_id: context.meta.user.id,
              shipping_id: context.shipping_id,
              shipping_price: context.shipping_price,
              cart: cartIds,
              total: context.amount,
              coupon: context.coupon_code || 0,
            },
          ],
        },
        callback: function (response) {
          if (response.status == "success") {
            context.payment_is_processing = false;
            context.paymentIsComplete = true;
            context.order_text = "Place Order";
          } else {
            this.error = "We could not complete your payment";
            context.order_text = "Place Order";
          }
        },
        onClose: function () {
          context.order_text = "Place Order";
          context.checkingout = false;
          context.payment_is_processing = false;
        },
      });
      handler.openIframe();
    },

    payAsAdmin: function () {
      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (this.settings.shipping_is_free == 0 && !this.shipping_price) {
        this.error = "Please select your shipping method";
        return false;
      }

      this.payment_method = "admin";
      this.order_text = "Please wait. We are almost done......";
      let form = document.getElementById("checkout-form-2");
      form.submit();
    },
    addShippingPrice: function (evt) {
      if (evt.target.value == "") {
        return;
      }
      this.error = "";
      this.shipping_id = evt.target.selectedOptions[0].dataset.id;
      this.shipping_price = evt.target.value;
      //check if a voucher was applied
      if (this.voucher.length) {
        this.amount =
          parseInt(evt.target.value) + parseInt(this.voucher[0].sub_total);
      } else {
        this.amount =
          parseInt(evt.target.value) + parseInt(this.meta.sub_total);
      }
      let obj = {
        sub_total: this.meta.sub_total,
        currency: this.meta.currency,
        user: this.meta.user,
        shipping_id: this.shipping_id,
        isAdmin: this.meta.isAdmin,
      };
      Window.CartMeta = obj;
      this.updateCartTotal(obj);
    },
    ...mapActions({
      getCart: "getCart",
      applyVoucher: "applyVoucher",
      updateCartMeta: "updateCartMeta",
      getAddresses: "getAddresses",
    }),
    applyCoupon: function () {
      if (!this.coupon) {
        this.coupon_error = "Enter a coupon code";
        setTimeout(() => {
          this.error = null;
        }, 2000);
        return;
      }
      this.coupon_error = null;
      this.submiting = true;
      axios
        .post("/checkout/coupon", {
          coupon: this.coupon,
        })
        .then((response) => {
          this.submiting = false;
          this.coupon = "";
          this.voucher.push(response.data);
          if (this.shipping_price) {
            this.amount =
              parseInt(this.shipping_price) + parseInt(response.data.sub_total);
          } else {
            this.amount = parseInt(response.data.sub_total);
          }
        })
        .catch((error) => {
          this.submiting = false;
          this.coupon_error = error.response.data.error;
          if (error.response.status) {
            this.submiting = false;
          }
        });
    },
    checkout: function () {
      this.order_text = "Please wait. We are almost done......";
      this.checkingout = true;
      this.coupon_error = null;
      axios
        .post("/checkout/confirm", {
          shipping_id: Window.CartMeta.shipping_id,
          payment_type: this.meta.isAdmin ? "admin" : "card",
          admin: this.meta.isAdmin ? "admin" : "online",
          pending: false,
        })
        .then((response) => {
          if (response.data == 1) {
            location.href = "/thankyou";
          }
        })
        .catch((error) => {
          this.order_text = "Place Order";
          this.payment_is_processing = false;
          this.checkingout = false;
          this.error =
            "We could not complete your order .Please send a mail to info@ohram.org";
        });
    },
    updateCartTotal: function (obj) {
      this.updateCartMeta(obj);
    },
  },
};
</script>
<style>

.card-icons img {
  height: 20px;
  object-fit: contain;
}

.fa-20 {
  font-size: 20px;
}

.fa-28 {
  font-size: 28px;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: #36c2ad !important ; /* Black w/opacity/see-through */
  color: white;
  font-weight: 700;
  font-size: 12px;
  border: 2px solid #f1f1f1;
  position: fixed; /* Stay fixed */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: auto;
  padding: 20px;
  text-align: center;
}

.cvc-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none; /* Optional: makes sure user clicks pass through */
}

.Icon-fill path {
  fill: #000; /* or any color you want */
}

</style>
