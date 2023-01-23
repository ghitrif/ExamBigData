<template>
    <div class="courseSettings brandingSetting" >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">
                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Domain</h5>
                            <p class="mb-2" >Choose your own Domain or Subdomain </p>
                            <li>Ensure your domain/subdomain is pointed to the XXXXXXXXX, It will take between 24-48 hours for any new nameserver (DNS) records to become active</li>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div >
                                <h5>Domain name</h5>                                
                                <vs-input required class="inputx" v-model="course.domain"  />
                                <div style="height:43px">
                                    <span @click="configDomainCourse_"  class="actions domainBtn"  ><i class="el tool"></i> Config & Save Domain</span>
                                </div>
                                <div class="text-right">
                                    <small><i class="el alert-circle"></i> Enter your domain/subdomain name without www.</small>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 15px;" >
                              <a href="/Domain" target="blank_" style="color:var(--vprimary)"><i class="el  arrow-right-circle"></i> How do I set up my own custom domain?</a>
                            </div>
                            <div style="margin-bottom: 15px;" v-if="course.statusDomain">
                              <vs-alert title="" active="true" color="success">
                                <p>Congratulations! You have successfully enabled https://{{course.domain}}</p>
                                <p> You should test your configuration at:</p>
                                <a :href="'https://www.ssllabs.com/ssltest/analyze.html?d='+course.domain" target="blank_">https://www.ssllabs.com/ssltest/analyze.html?d={{course.domain}}</a>

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
  props: ['course'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["CreateCourse", "configDomainCourse"]),  
    async configDomainCourse_(){
      this.$vs.loading({type:"sound"}) 
      let res = await this.configDomainCourse(this.course)
      this.$vs.loading.close()
      if(res.status == 1){
        this.course.statusDomain = 1
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

.domainBtn{
    float:right; 
    background:#4caf50;
    padding: 5px 40px;

}
</style>