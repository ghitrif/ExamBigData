<template>
     <!-- <form v-on:submit.prevent="btn_Connect">
      <div class="mb-3">
          <label for="SendBox">SendBox account : </label> <br>
         <input class="form-control" name="SendBox" v-model="SendBox" required>  
     </div>
     <div class="mb-3">
          <label for="Secret">Secret : </label> <br>
         <input class="form-control" name="Secret" v-model="Secret" required>  
     </div>      
    </form> -->
   <div id="app">
 <PayPal
  amount="10.00"
  currency="USD"
  locale="en_US"
  :client="credentials">
</PayPal>
</div>
</template>
<script>

import PayPal from 'vue-paypal-checkout'

export default {
   head: {
    script: [
      {
        type: "text/javascript",
        src: "https://unpkg.com/vue-paypal-checkout@2.0.0/dist/vue-paypal-checkout.min.js",
      },
       {
        type: "text/javascript",
        src: "https://unpkg.com/vue",
      }
    ],
  },
  data() {
    return {
       credentials: {
        sandbox: '<sandbox client id>',
        production: '<production client id>'
      },
      paypal: {
        sandbox: '<sandbox client id>',
        production: '<production client id>'
      }
    }
  },
  components: {
    PayPal
  },
 mounted() {
    // const script = document.createElement("script");
    // script.src =
    //   "https://www.paypal.com/sdk/js?client-id=AU4X06becjzd0ZjQBetiQ0h2KPYqb0PPsywsM8k-dPjeDCi_hlD7qEZfoB79p83KSgKAj4vY9xNeNvZn";
    // script.addEventListener("load", this.setLoaded);
    // document.body.appendChild(script);
  },
  methods: {
    setLoaded: function() {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: this.product.description,
                  amount: {
                    currency_code: "USD",
                    value: this.product.price
                  }
                }
              ]
            });
          },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();
            this.paidFor = true;
            console.log(order);
          },
          onError: err => {
            console.log(err);
          }
        })
        .render(this.$refs.paypal);
    }
  }
};




