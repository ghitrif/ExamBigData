<template>
    <div class="courseSettings" >
                <div class="CourseSettingsDescription"></div>
                <div class="CourseSettingsDetails">

                    <vs-row style="" >
                        
                        <vs-col vs-w="8" vs-sm="12" vs-xs="12" class="">
                            <div class="rightP_">
                                <h1 style="margin-bottom:15px">Your organization details:</h1>  
                                <span>The organization name</span>
                                <vs-input v-model="brand.name" required class="inputx" />
                                
                                 <div class="color">
                                    <h1>Theme Customization</h1>
                                    <input type="color" id="head" v-model="brand.colors" value="#910fc5" name="head">
                                </div>
                            <div style="height: 70px;  display: flex;" class="brandingLogo mb-3">
                              <div class="CSKD">
                                    <FilePond
                                    :allow-multiple="false"
                                    labelTapToUndo=""          
                                    :labelIdle="'Browse Your Logo'"
                                    name="logo"
                                    :server="server_logo"/>
                                </div>
                                <div class="ml-4" style="width: 100%;">
                                    <img :src="brand.logo" style="width: 67px;
    height: 67px;
    border: 2px solid gold;">
                                </div>
                            </div>
                            
                            <div style="height: 70px;; display: flex;" class="brandingfavicon mb-3">
                                <div class="CSKD">
                                <FilePond
                            
                                :allow-multiple="false"
                                labelTapToUndo=""          
                                :labelIdle="'Browse Your Favicon 16x16px'"
                                name="icon"
                                :server="server_icon"/>
                                </div>
                                <div class="ml-4" style="width: 100%;">                                    
                                    <img :src="brand.icon" style="width: 67px;
    height: 67px;
    border: 2px solid gold;">
                                </div>
                            </div>
                            <span   class="actions" @click="save"  ><i class="el save"></i> Save</span>

                            </div>
                            
                        </vs-col>
                    </vs-row>                    
                </div>

            </div>
</template>

<script>

import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

const token = document.head.querySelector('meta[name="csrf-token"]').content;
import { mapGetters, mapActions } from "vuex";
export default {
  props: ['brand'],
  data() {
    return {
        server_logo: {
          url: '/brand/uploadLogoAndIcon',
          fetch: null,
          revert: null,
          process: {
            headers: {              
                'X-CSRF-TOKEN': token,
                'X-XSRF-TOKEN': token,
                'Authorization': token
              },
            ondata: (fd) => {
                fd.append('action', this.upload_scene_action);
                return fd;
             },
            onload: (res) => {
                let data = JSON.parse(res)
                this.brand.logo = data.data.logo
            }
          }
      },
      server_icon: {
          url: '/brand/uploadLogoAndIcon',
          fetch: null,
          revert: null,
          process: {
            headers: {              
                'X-CSRF-TOKEN': token,
                'X-XSRF-TOKEN': token,
                'Authorization': token
              },
            ondata: (fd) => {
                return fd;
             },
            onload: (res) => {
                let data = JSON.parse(res)
                this.brand.icon = data.data.icon
            }
          }
      },
    };
  },
  components: {
    FilePond: vueFilePond(   FilePondPluginFileMetadata, FilePondPluginFileValidateType),
  },
  computed: {},
  methods: {
    ...mapActions(["createBrand"]),
    async save(){
      let res = await this.createBrand(this.brand)
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    }
   
  },
   mounted() {     
  },
};
</script>
<style lang="scss" scoped>
.CSKD{
    width: 300px;
}
.color{
  display: block;
  width: 208px;
  height: 60px;
  background: #f1f0ef;
  margin-bottom: 5px;
  h1{
    
    text-align: center;
    font-weight: normal;
  padding-top:3px;
  }
  input{
    margin-top:5px;
    margin-left:80px;
  }

}

</style>