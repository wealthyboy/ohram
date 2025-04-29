<template>
  <div class="container mt-5">
    <h3>Checkout</h3>
    <div id="payment-request-button" class="mb-3"></div>
    <form @submit.prevent="handleSubmit">
      <div id="card-element" class="form-control py-2"></div>
      <div class="text-danger mt-2">{{ error }}</div>
      <button class="btn btn-primary mt-3" :disabled="processing">
        {{ processing ? 'Processing...' : 'Pay Now' }}
      </button>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      stripe: null,
      elements: null,
      card: null,
      clientSecret: '',
      error: '',
      processing: false,
    };
  },
  async mounted() {
    this.stripe = Stripe(Window.MIX_STRIPE_KEY);
    this.elements = this.stripe.elements();

    const response = await fetch('/create-payment-intent', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({}) // or any data you want to send
    });

    const { clientSecret } = await response.json();
    this.clientSecret = clientSecret;

    const card = this.elements.create('card');
    card.mount('#card-element');
    this.card = card;

    // Payment Request Button (Google Pay, Apple Pay)
    const pr = this.stripe.paymentRequest({
      country: 'US',
      currency: 'usd',
      total: {
        label: 'Total',
        amount: 1000,
      },
      requestPayerName: true,
      requestPayerEmail: true,
    });

    const prElement = this.elements.create('paymentRequestButton', {
      paymentRequest: pr,
    });

    pr.canMakePayment().then(result => {
      if (result) {
        prElement.mount('#payment-request-button');
      }
    });

    pr.on('paymentmethod', async (ev) => {
      const { error, paymentIntent } = await this.stripe.confirmCardPayment(this.clientSecret, {
        payment_method: ev.paymentMethod.id,
      }, { handleActions: false });

      if (error) {
        ev.complete('fail');
        this.error = error.message;
      } else {
        ev.complete('success');
        this.stripe.confirmCardPayment(this.clientSecret);
      }
    });
  },
  methods: {
    async handleSubmit() {
      this.processing = true;
      const { error, paymentIntent } = await this.stripe.confirmCardPayment(this.clientSecret, {
        payment_method: {
          card: this.card,
        },
      });

      if (error) {
        this.error = error.message;
        this.processing = false;
      } else {
        alert('Payment successful!');
        this.processing = false;
      }
    }
  }
};
</script>

<style>
#card-element {
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}
</style>
