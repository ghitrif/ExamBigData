<template>
  <div class="stripe_">
      <div class="main-stripe">
          <div style="text-align:right">
              <img src="/images/stripe_accepted1.png" style="width: 100%;">
          </div>
      
        <div class="el_ mb-2">
            <div id="card-name" >
                <input v-model="name" placeholder="Full Name" class="form-control">
            </div>
        </div>
        
        <div class="el_ mb-2">
            <div id="card-name" >
                <input v-model="email" placeholder="Email" class="form-control">
            </div>
        </div>
        
        <div class="el_ mb-2">
            <div id="card-adress">
                <input v-model="adress" placeholder="Address (Street address / PO Box / Company name)." class="form-control">
            </div>
        </div>
    
    
        <div class="el_ mb-2">
            <div id="card-zip">            
                <input v-model="zip" placeholder="ZIP or postal code." class="form-control">
            </div>
        </div>

        <div class="el_ mb-2">
            <div id="card-number" class="cardinfo">
            </div>
        </div>  
        
        <div class="el_ mb-2 flo">
            <div class="Expiry" style="padding-right:5px">
                <div id="card-expiry" class="cardinfo "></div>
            </div>
            <div  class="CVC" style="padding-left:5px">
                <div id="card-cvc" class="cardinfo "></div>
            </div>
        
        </div>
      </div>
        <div class="el_ mb-2">
            <div style="font-size:11px">
                We never store your card number or CVC number !
            </div>
            <div id="card-error"></div>
            <button id="custom-button" @click="createToken">Generate Token</button>
        </div>
  </div>
</template>

<script>
import Vue from 'vue';
import { StripePlugin } from '@vue-stripe/vue-stripe';

import { mapGetters, mapActions } from "vuex";
const options = {
  pk: (window.user.st && window.user.st != '')?  window.user.st : "pk_test_51JV1HIDbtrbbRxFN2xumbuEPv6LzkrycZ4Cx4L2NdP0adnNnIvzTCZILPS36fGjiiqvYuKafMv66AvkzWSnCuqqv00cgE5DxAH"
//   stripeAccount: process.env.STRIPE_ACCOUNT,
//   apiVersion: process.env.API_VERSION,
//   locale: process.env.LOCALE,
};

Vue.use(StripePlugin, options);
export default {
  props:["video", "visitor"],
  data () {
    return {
      token: null,
      cardNumber: null,
      cardExpiry: null,
      cardCvc: null,
      email:"",
      name:"",
      adress:"",
      zip:"",
    };
  },
  computed: {
    stripeElements () {
      return this.$stripe.elements();
    },
  },
  mounted () {
    if(!window.user.st || window.user.st == ''){
      this.$vs.notify({
                      time:8000,
                      title:'Info',
                      text:'Please go to Integrations and connect you Stripe account',
                      color:'warning',
                      icon:'query_builder'
                    })
    }
    const style = {
        empty:{
        border: "1px solid #ced4da4a  !important",
        },
      base: {
        color: 'black',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',        
        border: "1px solid #ced4da4a  !important",
        fontSize: '14px',
        '::placeholder': {
          color: '#aab7c4',
        },
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a',
      },
    };
    this.cardNumber = this.stripeElements.create('cardNumber', { style });
    this.cardNumber.mount('#card-number');
    this.cardExpiry = this.stripeElements.create('cardExpiry', { style });
    this.cardExpiry.mount('#card-expiry');
    this.cardCvc = this.stripeElements.create('cardCvc', { style });
    this.cardCvc.mount('#card-cvc');
  },
  beforeDestroy () {
    this.cardNumber.destroy();
    this.cardExpiry.destroy();
    this.cardCvc.destroy();
  },
  methods: {
    ...mapActions(["processPayment"]),
    async createToken () {
      const { token, error } = await this.$stripe.createToken(this.cardNumber);
      if (error) {
        document.getElementById('card-error').innerHTML = error.message;
        return;
      }
      let data = {
        token : token,
        uid:this.video.uid,
        name:this.name,
        email:this.email,
        adress:this.adress,
        zip:this.zip,
        visitor: this.visitor
      }
      this.$vs.loading({type:"sound"})
      let res = await this.processPayment(data)
      this.$vs.loading.close();
      if(res.status == 1){
        this.$emit('playnext')
      }else{
        this.$vs.notify({
                      time:2000,
                      title:'Info',
                      text:res.message,
                      color:'danger',
                      icon:'query_builder'
                    })

      }
      // handle the token
      // send it to your server
    },
  }
};
</script>

<style scoped>
#custom-button {
  height: 30px;
  width: 100%;
  outline: none !important;
  border: 1px solid  #ffdb80;
  background-color: #ffdb80;
  padding: 5px;
  color: black;
  border-radius: 6px;
  font-weight: bold;
}

#card-error {
  color: red;
  
    font-size: 12px;
    font-weight: normal;
    padding: 4px;
}
</style>
<style lang="scss" scoped>
.stripe_{
    .main-stripe{        
        background: #f7f4f41f;
        padding: 10px;
        border-radius: 8px;
        padding-bottom: 50px;
        
    }
    input{
        border: 0px !important;
        border-bottom: 1px solid #ced4da4a  !important;
        background: transparent !important;
        border-radius: 0px !important;
    }
    
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #aab7c4;
        opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: #aab7c4;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
        color: #aab7c4;
        }
    
    label{
        font-size: 11px;
    }
    .cardinfo{
        padding: 7px;
        border-radius: 6px;        
        border-bottom: 1px solid #ced4da4a  !important;;
        border-radius: 0px !important;
       
    }
    .Expiry{
        width: 75px;
        float: left;
    }
    .CVC{
        width: 50px;
        float: left;

    }

}
</style>