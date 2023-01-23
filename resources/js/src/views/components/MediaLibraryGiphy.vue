<template >
  <vs-row>
    <vs-col vs-w="6">
      <div class="uploadPreview" >
          <video v-if="selected" width="100%" style="max-height:100%" controls>
            <source :src="VideoSource" type="video/mp4">
            Your browser does not support the video tag.
        </video>
      </div>
    </vs-col>

    <vs-col vs-w="6">
      <div style="">
        <div
          style="
            border-bottom: 1px solid #00000014;
            position: relative;
          "
        >
        
        <div style=" padding: 18px 10px 1px 10px;">
           <vs-input  v-model="queryGiphy" @click="searchImagesGiphy" style="max-width:100%; " icon="search" placeholder="Search" />
        </div>
        </div>

        <div class="listVideos" style="height: calc(100vh - 231px);">
            <div v-if="!giphy_videos" style="text-align:center">
                <img src="/images/Spinner-1s-331px.svg">
            </div>
          <vs-row v-else >
            <vs-col vs-w="3" >
                <template v-for="(video, i) in giphy_videos"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 0">
                        <img :class="{ct:selected==video}" :src="video.images.fixed_width_still.url">
                    </div>
                </template>
            </vs-col>
            <vs-col vs-w="3" >
                <template v-for="(video, i) in giphy_videos"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 1">
                        <img :class="{ct:selected==video}" :src="video.images.fixed_width_still.url">
                    </div>
                </template>
            </vs-col>
            
            <vs-col vs-w="3" >
                <template v-for="(video, i) in giphy_videos"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 2">
                        <img :class="{ct:selected==video}" :src="video.images.fixed_width_still.url">
                    </div>
                </template>
            </vs-col>
            
            <vs-col vs-w="3" >
                <template v-for="(video, i) in giphy_videos"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 3">
                        <img :class="{ct:selected==video}" :src="video.images.fixed_width_still.url">
                    </div>
                </template>
            </vs-col>
          </vs-row>
        </div>
        
        <div class="listVideos--next">
            <span @click="$emit('cancelRecording')" class="ct" style="border-right: 1px solid #84848454;"><i class="el arrow-left"></i> Back</span>
            <span v-if="!selected"  >Next <i class="el arrow-right"></i></span>
            <span v-else @click="doneRecording" class="ct" >Next <i class="el arrow-right"></i></span>
        </div>
      </div>
    </vs-col>
  </vs-row>
</template>

<script>
import axios from "axios";

import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
        selected:false,
        medias: [],
        progress:0,
        //pixaby mixin
        tab:"giphy",   
        //queryGiphy
        queryGiphy:"Business",
        giphy_videos:false,
        
  }),
  methods: {
    ...mapActions([
      "loadImages",
      "deleteMedia",
      "loadMedia",
      "RenameMedia",
      "CreateFolder",
    ]),
    selected_video(video){
        this.selected = false
        this.$nextTick(() => {
            this.selected = video
        });

    },
    async searchImagesGiphy(){
        const API_KEY = "dc6zaTOxFJmzC";
        let url =`//api.giphy.com/v1/gifs/search?api_key=${API_KEY}&q=${this.queryGiphy}&fmt=json`
        let encodedQuery = encodeURI(this.queryGiphy);
        url = url+encodedQuery
         const res =  await fetch(url, {});
        const data = await res.json();
        this.giphy_videos = data.data

    },  
    doneRecording(){
        this.$emit('doneRecording', this.selected, this.tab)
    },
    async UploadFile() {
      let formData = new FormData();
      const file = this.$refs.file.files[0];
      formData.append("file", file);
      let _this = this;
    
      let response = await axios.post("/media", formData, {
        onUploadProgress: function (progressEvent) {
           _this.progress = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
        }.bind(this),
      });
      if (response.data.status == 1) {
            this.medias.unshift(response.data.data)  
            _this.progress = 0        
            this.$vs.notify({title:'Success',text:'Video Uploaded Successfully',color:'success'})
      } else {
      }
    },
  },
  computed:{
      VideoSource(){
          if(this.tab=="pixa"){
              return this.selected.videos.small.url
          }else if(this.tab== "giphy"){              
              return this.selected.images.original_mp4.mp4
          }
      }

  },

   mounted() {
    this.searchImagesGiphy()
  },
};
</script>

<style lang="scss" scoped>
.uploadPreview {
    position: absolute;
    background: black;
    height: 100%;
    width: 50%;
    top: 0px;
    left: 0px;
    border-bottom-left-radius: 6px;
    border-top-left-radius: 6px;
    width: calc(50% - 15px);
    display: flex;
    padding: 15px;
}
.listVideos{
    height: calc(100vh - 200px);
    overflow: auto;
    width: 100%;
    .listVideos--video{
        position: relative;    
        padding: 10px;
        img{
            position: relative;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            &.ct{
                border: 2px solid var(--vprimary);
            }
        }
    }

}

.listVideos--next{
    position: absolute;    
    width: calc(50% + 15px);
    height: 50px;
    background: transparent;
    right: 0px;
    bottom: 0px;
    border-bottom-right-radius: 5px;
    span{
        width: 50%;
        float: left;
        line-height: 50px;
        float: left;
        text-align: center;
        font-weight: bold;
        text-align: center;
        background: var(--vprimary);
        margin: 0px 10px;
        width: calc(50% - 20px);
        border-radius: 10px;
        &.ct{
            color: #fff;
            cursor: pointer;
            &:hover{
                background: black;
            }
        }
    }
}
._progress{
    font-weight: normal;
    font-size: 11px;
}
.video-tabs{
    .tb{
        font-weight: 600;
        cursor: pointer;        
        padding: 7px 10px;
        &.ac{
            border-bottom: 2px solid var(--vprimary);
        }
    }
}
</style>