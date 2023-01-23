<template>
    <div class="courseSettings"  >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">                    
                    <vs-row style="margin-bottom: 15px;">
                        
                        <vs-col vs-w="8" class="rightP_" vs-sm="12" vs-xs="12">

                            <div class="customaAlert">
                              The following steps walk you though the process needed to set up an email whitelabel. Email whitelabel allows you to send email notifications from your own company domain as opposed to our domain.
                            </div>
                            <h5>Host</h5>
                            <vs-input  v-model="brand.host" required class="inputx"  /> 
                            <h5>Username</h5>                          
                            <vs-input v-model="brand.username" required class="inputx"  /> 
                            <h5>Password</h5>                          
                            <vs-input v-model="brand.pwd" required class="inputx"  /> 
                            <h5>Encryption</h5>  
                            <select class="select--raduis" v-model="brand.security" style="height: 35px;
    width: 200px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    margin-bottom: 10px;">
                                <option>TLS</option>                             
                                <option>SSL</option>                             
                                <option>None</option>
                            </select>                             
                            <h5>Port</h5>                          
                            <vs-input v-model="brand.port" style="width:100px" required class="inputx" placeholder="Port" /> 
                            <span @click="save" style="float:right"  class="actions"  ><i class="el save"></i> Save</span>
                            <span style="float:right"  class="actions" @click="verifySMTP_"  ><i class="el send"></i> Test Settings</span>
                          
                        </vs-col>

                    </vs-row>
                    
                </div>

            </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ['brand'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["createBrand", "verifySMTP"]),
    async verifySMTP_(){
        let res = await this.verifySMTP(this.brand)
        var msg = res.message          
        if(res.status == 1){          
            this.$vs.notify({title:'Success', text:msg ,color:'success'})
        }else{            
            this.$vs.notify({title:'Error', text:msg ,color:'danger'})
        }

    },
    async save(){
      let res = await this.createBrand(this.brand)
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    }
   
  },
   mounted() {     
  },
};
</script>