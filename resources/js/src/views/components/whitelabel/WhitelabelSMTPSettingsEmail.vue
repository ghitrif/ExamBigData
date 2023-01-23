<template>
    <div class="courseSettings"   >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">                    
                    <vs-row style="margin-bottom: 15px;">
                        <vs-col vs-w="12" class="rightP_" vs-sm="12" vs-xs="12">
                            <h5>Host</h5>
                            <vs-input  v-model="smtp.host" required class="inputx"  /> 
                            <h5>Username</h5>                          
                            <vs-input v-model="smtp.user" required class="inputx"  /> 
                            <h5>Password</h5>                          
                            <vs-input v-model="smtp.password" required class="inputx"  />   
                                                        <h5>Encryption</h5>  
                            <select class="select--raduis" v-model="smtp.security" style="height: 35px;
                                width: 200px;
                                border-radius: 4px;
                                border: 1px solid rgba(0, 0, 0, 0.2);
                                margin-bottom: 10px;">
                                <option>TLS</option>                             
                                <option>SSL</option>                             
                                <option>None</option>
                            </select>                          
                            <h5>Port</h5>                          
                            <vs-input v-model="smtp.port" style="width:100px" required class="inputx" placeholder="Port" /> 
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
      smtp:{
        Host:"",
        user:"",
        password:"",
        port:"",
        security:"None"
      }
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["createSmtpEmail", "verifySMTP","LoadSmtpEmail"]),
    async verifySMTP_(){
      let data = {
        pwd:this.smtp.password,
        username:this.smtp.user,
        port:this.smtp.port,
        host:this.smtp.Host,
        security:'None'
      }
        let res = await this.verifySMTP(data)
        var msg = res.message          
        if(res.status == 1){          
            this.$vs.notify({title:'Success', text:msg ,color:'success'})
        }else{            
            this.$vs.notify({title:'Error', text:msg ,color:'danger'})
        }

    },
    async load(){
          
      let res = await this.LoadSmtpEmail()
      this.smtp=res.data;
    },
    async save(){
      let res = await this.createSmtpEmail(this.smtp)
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    }
   
  },
   mounted() {   
     this.load();  
  },
};
</script>
<style scoped>

</style>