<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">

          <div class="vx-row no-gutter justify-center items-center">

            <div class="vx-col hidden lg:block lg:w-1/2">
              <img src="/images/pages/login.png" alt="login" class="mx-auto">
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
              <div class="p-8 login-tabs-container">

                <div class="vx-card__title mb-4">
                  <h4 class="mb-4">Login</h4>
                  <p>Welcome back, please login to your account.</p>
                  
                </div>

                <div>
                  <vs-input
                      name="email"
                      icon-no-border
                      icon="icon icon-user"
                      icon-pack="feather"
                      label-placeholder="Email"
                      v-model="email"
                      class="w-full"/>

                  <vs-input
                      type="password"
                      name="password"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      label-placeholder="Password"
                      v-model="password"
                      class="w-full mt-6" />

                  <div class="flex flex-wrap justify-between my-5">
                      <vs-checkbox v-model="checkbox_remember_me" class="mb-3">Remember Me</vs-checkbox>
                      <router-link to="">Forgot Password?</router-link>
                  </div>
                  <vs-button class="float-right" @click="login">Login</vs-button>

                  <div class="social-login-buttons flex flex-wrap items-center mt-4">
                    <vs-alert v-if="error" title="Error" active="true" color="danger">
                      {{error}}
                    </vs-alert>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>


<script>
import axios from 'axios'
//import store from '../../store/state'

export default{
  data() {
    return {
      email: "",
      error:0,
      password: "",
      checkbox_remember_me: false,
    }
    
  },
   created() {
  },
  methods: {
    async login() {  
        this.error = 0   
        let email = this.email 
        let password = this.password

         this.$vs.loading({background:this.backgroundLoading,color:'rgb(255, 255, 255); opacity:0.2'})
        let resp = await this.$store.dispatch('login', { email, password })
        this.$vs.loading.close();
        
        if(resp.data.status == 1){
          console.log("login done")
        }else{          
          console.log("login faild")
          this.error = resp.data.message
        }
       
      } 
}
}
</script>

<style lang="scss" scoped>

</style>
