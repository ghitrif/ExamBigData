<template>
    <div class="courseSettings" >
        <!-- <div style="height:45px"> 
            <span style="margin: 0px;
    margin-right: 10px;
    height: 38px;" class="actions addFolder" @click="save" ><i class="el save"></i> Save</span>     
        </div> -->
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">
                    <vs-row style="margin-bottom: 15px;">
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Course Pirce</h5>
                            <p class="mb-2" >Enter the Price for your Video Course</p>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div>Price</div>
                            <vs-input style="width:100px" required class="inputx"  v-model="course.price" />
                            
                            <div>Currency</div>
                            <select style="height: 35px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 4px;" v-model="course.currency" >
                                <option v-for="currency,i in vars.currencies" :key="i" :value="currency.cc" >{{currency.cc}}: {{currency.name}}</option>
                            </select>

                        </vs-col>
                    </vs-row>

                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Payment methods</h5>
                            <p class="mb-2" >Select the payments methods you wold like to accept for your video course</p>
                           
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div class="ConnectPayment">
                                <span class="paymentImage" >
                                    <img  src="/images/paypal.png">
                                </span>
                                <span class="paymentToken" v-if="course.PaymentAccounts"><b>{{course.PaymentAccounts.client_id}}</b></span>                          
                                <div class="connectNow" >
                                    <span v-if="!course.PaymentAccounts" class="actions" @click="paymentAccount_popup=true">Connect Now</span>
                                    <span v-else class="actions" style="background:rgb( var(--vs-danger) ) " @click="paymentAccount_disconnect">Disconnect</span>
                                </div>  
                            </div>                        
                        </vs-col>
                    </vs-row>

                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Days for refund</h5>
                            <p class="mb-2" >Enter the period in days during which a customer can ask for refund. </p>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            
                            <vs-input required class="inputx" placeholder="Period in days" v-model="course.days_refund" />
                        </vs-col>
                    </vs-row>
                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Vendor informations</h5>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div >
                                <h5>Website URL:</h5>                                
                                <vs-input required class="inputx" placeholder="Website URL" v-model="course.website_url" />
                                
                                <h5>Support URL:</h5>                                
                                <vs-input required class="inputx" placeholder="Support URL" v-model="course.support_url" />

                                <h5>Support Email:</h5>                                
                                <vs-input required class="inputx" placeholder="Support Email" v-model="course.support_email" />                                
                                
                                <h5>Adress:</h5>                                
                                <vs-input required class="inputx" placeholder="Adress" v-model="course.vendor_adress" />
                                <span   class="actions" @click="save"  ><i class="el save"></i> Save</span>

                            </div>
                        </vs-col>
                    </vs-row>
                    
                </div>
                <vs-popup class="holamundo"  :title="'Connect new account'" :active.sync="paymentAccount_popup">
                    <form style="padding:0px 40px"  v-on:submit.prevent="onSubmitPaymentAccount">
                        <label>Client ID</label>
                        <vs-input required class="inputx"  v-model="paymentAccount.client_id"/>
                        <label>Secret</label>
                        <vs-input required class="inputx"  v-model="paymentAccount.secret"/>
                        <vs-checkbox v-model="paymentAccount.sandbox">Sandbox</vs-checkbox>

                        <button style="float:right" type="submit" class="vs-component vs-button vs-button-primary vs-button-filled">Save</button>   
                    </form>
                    
                </vs-popup>

            </div>
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import vars from './video/vars.js'
export default {
  props: ['course'],
  data() {
    return {
        vars:vars,
        paymentAccount_popup:false,
        paymentAccount:{
            client_id:"",
            secret:"",
            sandbox:0,
            course_id:0
        }
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["CreateCourse", "addPaymentAccount", "deletePaymentAccount"]),
    async onSubmitPaymentAccount(){
        this.paymentAccount.course_id = this.course.id
        this.$vs.loading({type:"sound"})
        let res = await this.addPaymentAccount(this.paymentAccount)
        this.course.PaymentAccounts = res.data
        this.$vs.loading.close()
        this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
        this.paymentAccount_popup = false
    },
    async paymentAccount_disconnect(){
        let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
        if (!result.isConfirmed)
            return false

        this.$vs.loading({type:"sound"})
        let res = await this.deletePaymentAccount(this.course.PaymentAccounts)
        this.course.PaymentAccounts = null
        this.$vs.loading.close()
        this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    },
    async save(){
      this.$vs.loading({type:"sound"})
      let res = await this.CreateCourse(this.course)
      this.$vs.loading.close()
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    }
   
  },
   mounted() {     
       
  },
};
</script>
<style lang="scss" scoped>
.ConnectPayment{
    border: 1px solid rgba(0, 0, 0, 0.2);
    height: 60px;
    padding: 10px;
    border-radius: 4px;
    .paymentImage{
        height: 40px;
        width: 100px; 
        display:inline-block;  
        float:left;
        img{
            height: 40px;
            width: 80px;
        }

    }
    .paymentToken{
        width: 300px;
        display:inline-block;
        float:left;
        line-height: 40px;
        overflow: hidden;
        opacity: .5;
    }
    .connectNow{
        width: 150px;
        display:inline-block;
        float:right;
        line-height: 40px;
        .actions{
            padding: 0px 15px;
            height: 30px;
            line-height: 30px;
        }
    }
}
</style>