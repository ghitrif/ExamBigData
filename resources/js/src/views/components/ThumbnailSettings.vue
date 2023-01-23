<template>
    <div class="tab_settings BrandingSettings">
        <span class="title">Thumbnail</span>
        <li>
            <vs-radio v-model="video.thumbnailChoice" vs-value="1">From video</vs-radio>
            <template v-if="video.thumbnailChoice == '1'"> 
            <video controls ref="videoThumbnail" style="width:100%;position: relative; border-radius: 5px; margin-top: 10px;">
              <source :src="video.path" type="video/mp4">
              Your browser does not support the video tag.
            </video> 
            <div>              
              <vs-slider :max="video.duration" @change="durationSliderChanged" v-model="video.thumbnailTime"/>
            </div>
            <span class="actions" @click="generate"><i class="el image"></i> Generate</span>
            </template>
        </li>
         <li>
             <div class="mb-8">
                <vs-radio v-model="video.thumbnailChoice" vs-value="2">Upload custom image</vs-radio>
             </div>
            <MediaFile v-if="video.thumbnailChoice == '2'" v-model="video.thumbnailMedia" />
        </li>
        
    </div>
</template>


<script>

import { mapGetters, mapActions } from "vuex";
export default {
  props: ['video'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {    
    ...mapActions(["generateVideoThumbnail"]),
    async generate(){
      this.$vs.loading({type:"sound"})
      let res = await this.generateVideoThumbnail(this.video) 
      this.$vs.loading.close() 
      this.$vs.notify({title:'Success', text:"Thumbnail saved successfully" ,color:'success'})
    },
    durationSliderChanged(){
      this.$refs.videoThumbnail.currentTime = this.video.thumbnailTime      
    }
  },
  async mounted() {
  },
};
</script>
