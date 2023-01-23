<template>
    <div class="courseSettings brandingSetting" >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails"> 
                  <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Keywords</h5>
                            <li>These are terms related to your entire website. Separate keywords with a comma. </li>
                            <li>Search engines no longer use keywords to impact website rankings. All keyword usage should be considered optional. </li>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div >
                                <h5>Keywords</h5>                                
                                <vs-input required class="inputx"  v-model="course.keywords" />
                            </div>
                        </vs-col>
                    </vs-row>
                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Analytics</h5>
                            <li>Enter your Facebook Pixel ID and Google Tracking ID .</li>
                            <li> Visitor data will be tracked and sent to that property.</li>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div >
                                <h5>Facebook Pixel ID</h5>                                
                                <vs-input required class="inputx" placeholder="Facebook Pixel ID" v-model="course.facebook" />
                                <h5>Google Tracking ID</h5>                                
                                <vs-input required class="inputx" placeholder="Google Tracking ID" v-model="course.google" />
                                <span   class="actions" @click="save"  ><i class="el save"></i> Save</span>
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
    ...mapActions(["CreateCourse"]),  
 
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

</style>