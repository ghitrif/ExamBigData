<template>
    <div class="courseSettings" >
        <div class="ml-4 mr-4 sep">
            <h5 class="mb-2">Sales page</h5>
            <vs-input id="sales" required class="inputx" :value="sales" />
            <a target="blank_" :href="'/Edit/sales/'+ course.uid" class="btnPages"><i class="el edit-2"></i> Edit</a>
            <span class="btnPages" @click="copyText('sales')"><i class="el copy"></i> Copy Link</span>
            <a :href="sales" target="blank_" class="btnPages"><i class="el eye"></i> Preview</a>
        </div>
        
        <div class="ml-4 mr-4 sep">
            <h5 class="mb-2">Order page</h5>
            <vs-input id="checkout" required class="inputx" :value="checkout" />
            <a target="blank_" :href="'/Edit/checkout/'+ course.uid" class="btnPages"><i class="el edit-2"></i> Edit</a>
            <span class="btnPages" @click="copyText('checkout')"><i class="el copy"></i> Copy Link</span>
            <a :href="checkout" target="blank_" class="btnPages"><i class="el eye"></i> Preview</a>
        </div>
        
        
        <div class="ml-4 mr-4 sep">
            <h5 class="mb-2">Thank you page</h5>
            <vs-input id="thankyou" required class="inputx" :value="thankyou" />
            <a target="blank_" :href="'/Edit/thankyou/'+ course.uid" class="btnPages"><i class="el edit-2"></i> Edit</a>
            <span class="btnPages" @click="copyText('checkout')"><i class="el copy"></i> Copy Link</span>
            <a :href="thankyou" target="blank_"  class="btnPages"><i class="el eye"></i> Preview</a>
        </div>
        <div class="ml-4 mr-4 sep">
            <h5 class="mb-2">About us page</h5>
            <vs-input id="about" required class="inputx" :value="terms" />
            <a target="blank_" :href="'/Edit/about/'+ course.uid" class="btnPages"><i class="el edit-2"></i> Edit</a>
            <span class="btnPages" @click="copyText('about')"><i class="el copy"></i> Copy Link</span>
            <a :href="terms" target="blank_" class="btnPages"><i class="el eye"></i> Preview</a>
        </div>
        
        <div class="ml-4 mr-4 sep">
            <h5 class="mb-2">Terms and conditions page</h5>
            <vs-input id="terms" required class="inputx" :value="terms" />
            <a target="blank_" :href="'/Edit/terms/'+ course.uid" class="btnPages"><i class="el edit-2"></i> Edit</a>
            <span class="btnPages" @click="copyText('terms')"><i class="el copy"></i> Copy Link</span>
            <a :href="terms" target="blank_" class="btnPages"><i class="el eye"></i> Preview</a>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ['course'],
  data() {
    return {
        
    };
  },
  components: {
  },
  computed: {
      checkout(){          
          return "https://"+ this.course.domain + "/checkout/"+ this.course.uid
      },
      sales(){
          return "https://"+ this.course.domain + "/course/"+ this.course.uid
      },
      thankyou(){
          return "https://"+ this.course.domain + "/thankyou/"+ this.course.uid
      },
      terms(){
          return "https://"+ this.course.domain + "/terms/"+ this.course.uid
      },
      about(){
          return "https://"+ this.course.domain + "/about/"+ this.course.uid
      }
  },
  methods: {
    ...mapActions([]), 
    copyText(id) {
            var copyText = document.getElementById(id)
            copyText.select()
            copyText.setSelectionRange(0, 99999); 
            document.execCommand("copy")            
            this.$vs.notify({title:'Success',text:'Successfully copied to clipboard',color:'success'})
        }, 
   
   
  },
   mounted() {     
  },
};
</script>

<style lang="scss" scoped>
.sep{
    padding-bottom: 47px;
    border: 1px solid #00000014;
    margin-top: 20px;
    background: #7367f01f;
    padding: 54px;
    border-radius: 10px;
}
.btnPages{
    display: inline-block;
    padding: 5px 20px;
    float: right;
    margin-left: 10px;
    border-radius: 2px;
    cursor: pointer;
    border: 1px solid var(--vprimary);
    cursor: pointer;
    background: var(--vprimary);
    color: #fff;
    &:hover{        
        background: var(--vprimary);
        color: #fff;
        opacity: 0.8;
    }
    &:visited{
        color: #fff;
    }

}
</style>