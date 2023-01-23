<template>
    <div class="courseSettings brandingSetting" >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">
                    <vs-row style="margin-bottom: 15px;">
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Logo</h5>
                            <p class="mb-2" >Upload your own Logo</p>
                            <li>The only image format accepted is png or jpeg</li>
                            <li>Recommanded size of the logo are of 125x125 pixels</li>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div style="height: 33px;" class="brandingLogo">
                                <MediaFile type="image" v-model="course.brandingLogo" />
                            </div>
                        </vs-col>
                    </vs-row>

                    <vs-row style="margin-bottom: 15px;" >
                        <vs-col vs-w="4" class="leftP">
                            <h5 class="mb-4">Favicon</h5>
                            <p class="mb-2" >The icon that appears next to the page title in the browser tab and on Google's mobile search results.</p>
                            <li>The only image format accepted is png, jpeg or gif</li>
                            <li>Recommanded size of the logo are of 16x16 pixels</li>
                        </vs-col>
                        <vs-col vs-w="8" class="rightP">
                            <div style="height: 33px;" class="brandingfavicon">                                
                                <MediaFile  type="image" v-model="course.favicon" />
                            </div>
                        </vs-col>
                        <vs-col vs-w="12">
                            <span   class="actions" @click="save"  ><i class="el save"></i> Save</span>
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
      let res = await this.CreateCourse(this.course)
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
.brandingLogo{
    .MediaFile {
        img{
            width: 100px !important;
        }
    }
}
.brandingfavicon{
    .MediaFile {
        img{
            width: 40px !important;
        }
    }
}
</style>