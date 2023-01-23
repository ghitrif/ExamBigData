<template>
    <div class="courseSettings" >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">                   

                    <vs-row style="margin-bottom: 15px;" >
                        
                        <vs-col vs-w="8" class="rightP_" vs-sm="12" vs-xs="12">
                          
                            <div style="margin-bottom: 15px;" >
                              <a href="/Domain" target="blank_" style="color:var(--vprimary)"><i class="el  arrow-right-circle"></i> How do I set up my own custom domain?</a>
                            </div>
                            <div >
                                <vs-input required class="inputx" placeholder="Domain name" v-model="brand.domain" />
                                <span style="float:none"  class="actions" @click="configBrandCourse_"  ><i class="el save"></i> Save</span>
                                <div class="text-right">
                                    <small><i class="el alert-circle"></i> Enter your domain/subdomain name without www.</small>
                                </div>
                            </div>
                            <div style="margin-bottom: 15px;" v-if="brand.status">
                              <vs-alert title="" active="true" color="success">
                                <p>Congratulations! You have successfully enabled https://{{brand.domain}}</p>
                                <p> You should test your configuration at:</p>
                                <a :href="'https://www.ssllabs.com/ssltest/analyze.html?d='+brand.domain" target="blank_">https://www.ssllabs.com/ssltest/analyze.html?d={{brand.domain}}</a>

                              </vs-alert>
                              
                            </div>
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
    ...mapActions(["configBrandCourse"]),
    async configBrandCourse_(){
      
      this.$vs.loading({type:"sound"}) 
      let res = await this.configBrandCourse({domain:this.brand.domain})      
      this.$vs.loading.close()
      if(res.status == 1){
        this.brand.status = 1
        this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
      }
      else {
        let message = {title:'Error',text: res.message,color:'danger'}
        this.$vs.notify(message)
      }       
    },
   
  },
   mounted() {     
  },
};
</script>
<style lang="scss" scoped>

</style>