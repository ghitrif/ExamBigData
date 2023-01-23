<template >
  <vs-row>
    <vs-col vs-w="6">
      <div class="uploadPreview" >
          <video v-if="selected" width="100%" style="max-height:100%" controls>
            <source :src="selected" type="video/mp4">
            Your browser does not support the video tag.
        </video>
      </div>
    </vs-col>

    <vs-col vs-w="6">
      <div style="">
        
        <div style="height: calc(100vh - 231px);">
            <form v-on:submit.prevent="getYoutubeLinks_" v-if="!links"  >
                <vs-input v-model="video_url" required label="Youtube URL" placeholder="Youtube URL"/>
            <Submit style="width: 100%;float:none" />
            </form>
            <template v-else>
                <div class="customForm"   >
                    <label>Choose Video Quality:</label>
                    <select @change="selected_video" v-model="quality" class="form-control" >
                    <option v-for="link,i in links " :value="link.url" :key="i">{{link.qualityLabel}}</option>
                    </select>
                </div>
                <span style="background: black;
    padding: 10px;
    margin-top: 10px;
    display: block;
    text-align: center;
    color: #fff;
    cursor:pointer" @click="links=false;selected=false; video_url=''">Reset</span>
            </template>
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
import submit from './video/cmp/submit.vue';
export default {
  components: { submit },
  data: () => ({

        video_url:"",
        selected:false,
        quality:"",
        links:false,
        tab:"youtube",  
        
        
  }),
  methods: {
    ...mapActions([
      "getYoutubeLinks",
    ]),
    selected_video(){
        this.selected = false
        this.$nextTick(() => {
            this.selected = this.quality
        });

    },
  
    async getYoutubeLinks_(){
        this.links = false
        
      this.$vs.loading({type:"sound"})
       let res = await this.getYoutubeLinks(this.video_url)           
      this.$vs.loading.close()
       this.links = res.data       
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