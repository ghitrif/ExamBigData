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
           <vs-input  v-model="query" @click="searchImagesPixels" style="max-width:100%; " icon="search" placeholder="Search" />
        </div>
        </div>

        <div class="listVideos" style="height: calc(100vh - 231px);" @scroll="scrollFunction($event)">
            <div v-if="!medias" style="text-align:center">
                <img src="/images/Spinner-1s-331px.svg">
            </div>
          <vs-row v-else >
            <vs-col vs-w="3" >
                <template v-for="(video, i) in medias"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 0">
                        <img :class="{ct:selected==video}" :src="video.video_pictures[1].picture">
                    </div>
                </template>
            </vs-col>
            <vs-col vs-w="3" >
                <template v-for="(video, i) in medias"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 1">
                        <img :class="{ct:selected==video}" :src="video.video_pictures[1].picture">
                    </div>
                </template>
            </vs-col>
            
            <vs-col vs-w="3" >
                <template v-for="(video, i) in medias"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 2">
                        <img :class="{ct:selected==video}" :src="video.video_pictures[1].picture">
                    </div>
                </template>
            </vs-col>
            
            <vs-col vs-w="3" >
                <template v-for="(video, i) in medias"  >
                    <div class="listVideos--video" @click="selected_video(video)" :key="i" v-if="i % 4 == 3">
                        <img :class="{ct:selected==video}" :src="video.video_pictures[1].picture">
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
import { createClient } from 'pexels';

import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
        selected:false,
        medias: [],
        progress:0,
        //pixaby mixin
        tab:"pixels",   
        //queryGiphy
        query:"Business",
        giphy_videos:false,
        next_page : true,
        
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
    scrollFunction(evt){
        let scrollTop  = evt.target.scrollTop 
        let clientHeight   = evt.target.clientHeight  
        let scrollHeight   = evt.target.scrollHeight  
        
        var maxScrollPosition = evt.target.scrollHeight - evt.target.clientHeight;
    
        if(scrollTop > (maxScrollPosition - 1)){ 
            this.searchImagesPixels(1)           
            
        }

    },
    async searchImagesPixels(next = 0){
        if(!next){            
            this.medias = []
            this.next_page = 0
        }
           
        var query = this.query
        var _this = this
        
        let client = createClient('563492ad6f9170000100000191ecabbd83384ff2ab30927b6749f45d');
        client.videos.search({ query, per_page: 80, page:_this.next_page }).then(videos => {        
            // _this.medias = videos.videos
            videos.videos.forEach( function(video) {
                _this.medias.push(video)
            })
            if(videos.next_page)
                _this.next_page++
            else            
                _this.next_page = 0
       });
    },  
    doneRecording(){
        this.$emit('doneRecording', this.selected, this.tab)
    },
 },
  computed:{
      VideoSource(){
          if(this.selected)
              return this.selected.video_files[3].link
        return false
      }
  },

   mounted() {
    this.searchImagesPixels()
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
    bottom: 7px;
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