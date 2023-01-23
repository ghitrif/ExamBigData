<template>
    <Vpopup class="sharePopup"  title="" :active.sync="sharePopup" @close="close">
          <div class="row" style="padding:0px; margin:0 auto; width:400px ;font-weight: bold;">
             
              <div class="col-12 form-group" style="position:relative; margin-top: 15px;">
                  <div class="mb-3 text-center">Share Your Email's Video</div>
                  <div style="position: relative;">
                    <span class="ShareLink" @click="copyText('share_url')">{{share_url}}</span>
                    <!-- <span class="hidecopy ic-lock_outline"></span> -->
                    <span class="actions" @click="copyText('share_url')" style=""><i class="el link" style="position: relative;font-weight: normal;font-size:15px"></i> Copy Link</span>
                </div>
              </div>
              

              <vs-divider>
                Or
              </vs-divider>              
              <div class="col-12 shre mb-5">
                   <facebook :url="share_url" scale="3"></facebook>
                    <twitter :url="share_url" title="Check me on Github" scale="3"></twitter>
                    <linkedin :url="share_url" scale="3"></linkedin>
                    <telegram :url="share_url" scale="3"></telegram>
                    <whats-app :url="share_url" title="Hello" scale="3"></whats-app>
                    <pinterest :url="share_url" scale="3"></pinterest>
                    <reddit :url="share_url" scale="3" title="My Github"></reddit>
              </div>
          </div>      
       </Vpopup>
</template>



<script>
import {
  Facebook,
  Twitter,
  Linkedin,
  Pinterest,
  Reddit,
  Telegram,
  WhatsApp,
  Email,
  Google
} from "vue-socialmedia-share";

import Vpopup from "./vpopup/vpopup.vue"
export default {
  props: ['active', 'campaign', 'f', "sharePopup"],
  data() {
    return {
    }
  },components: {
      Vpopup,
    Facebook,
    Twitter,
    Linkedin,
    Pinterest,
    Reddit,
    Telegram,
    WhatsApp,
    Email,
    Google,
  },
  computed:{
      active_(){
          return this.active
      },
      
    share_url(){
      return location.protocol +"//" +window.location.hostname +'/Funnel/Embed/'+ this.campaign.uid
    }
  },
  methods: {
    copyText(id) {
            var copyText = document.getElementById(id)
            copyText.select()
            copyText.setSelectionRange(0, 99999); 
            document.execCommand("copy")            
            this.$vs.notify({title:'Success',text:'Successfully copied to clipboard',color:'success'})
        },
      close(){
          console.log("🚀 ~ file: FunnelShare.vue ~ line 82 ~ close ~ close", close)
          this.$emit("close")
      }
   
  },

    mounted() {
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>
<style lang="scss" scoped>
.sharePopup{
  color: black;
  .vs-input--input{
    border-radius: 0px !important;
  }
  .actions{
    width: 200px;
    text-align: center;
    border-radius: 0px;
    float: none;
    display: block;
    margin: 0 auto;
    margin-bottom: 40px;
    font-weight: normal;
  }
  .ShareLink{
    color: var(--vprimary);
    display: block;
    text-align: center;
    margin: 20px 0px;
  }
  
}

</style>