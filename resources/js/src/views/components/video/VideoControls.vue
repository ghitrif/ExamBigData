<template>
  <div class="video_" id="video_"  ref="video_">
    <div class="pannel_chapters" v-if="pannel_chapter && video.enableChapter" :style="pannelChaptersStyle">
      <span>Bookmarks <i class="el x" @click="pannel_chapter=false"></i></span>
      <li @click="go_time(chapter.time)" v-for="(chapter, i) in video.chapters" :key="i">
        <i class="el bookmark"></i> {{chapter.description}} 
      </li>
    </div>
    <video id="video" @timeupdate="timeupdate($event)" ref="video" style="height: 100%; position: relative">
      <source :src="$url+video.path" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <template v-if="viewPort!=false && viewPortDone">
    <vue-draggable-resizable
      class="NodeDraggable"
      v-for="(node,i) in video.nodes"
      :draggable="true"
      :x="node.x "
      :y="node.y - viewPort.height"      
      v-show="video_current_time >= node.startTime && video_current_time <= node.endTime"
      :data-ct="video_current_time" :data-st="node.startTime" :data-et="node.endTime"
      @activated="$emit('onBlockActivated', node)"         
        :w="node.width" :h="node.height" @dragging="(x,y) => onDragstopComponent(x, y, node)" @resizing="(w, h, x, y)=>onResizeComponent(w, h, x, y, node)" :parent="false"
      >
      
      <component :viewPort="viewPort" :class="['animated', (video_current_time >= node.startTime && video_current_time <= node.endTime ) ? node.animation: '',
                ]" :t="node.settings"  :key="i" :is="node.type" :settings="node" :editing="true" />        
    </vue-draggable-resizable>
    </template>
    <div class="videoControls">
      <span
        v-if="!is_playing"
        @click="play"
        :style="playerCss"
        class="el play-button-arrowhead"
      ></span>
      <span v-if="is_playing" @click="pause" class="el pause2" :style="playerCss"></span>
      <div class="progress" :style="playerProgressCss">
        <span class="pp" :style="playerCssProress2"></span>
        <span id="pp" :style="playerCssProress1"></span>
      </div>
      <span class="brand" :style="playerCss" v-if="video.enableChapter" @click="show_chapter">
        <i class="el bookmark"></i>
      </span>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Vue from 'vue'
import comps from "./cmp/index.js"
Vue.use(comps)

import VueDraggableResizable from "vue-draggable-resizable";
import "vue-draggable-resizable/dist/VueDraggableResizable.css";
Vue.component("vue-draggable-resizable", VueDraggableResizable);

import Node from "./Node.vue"
export default {
  name: "VideoControls",
  props: ["video", "rulerStep", "rulerStepZomm"],
  data() {
    return {  
      video_current_time:0,  
      viewPortDone:false,    
      is_playing:false,      
      viewPort:false,
      pannel_chapter:false,
    };
  },
  components: {
      Node,
  },
  computed: {
    pannelChaptersStyle(){
      return {background: this.video.chaptersBgColor, color: this.video.chaptersColor}
    },
    viewPort_(){
      let video_ = document.getElementById('video_')
      if(!video_)
        return false
      let viewport = {
        width: video_.clientWidth ,
        height: video_.clientHeight ,
      }
      this.video.viewport = viewport
      return viewport

    },
    playerCssProress1(){
      let style = {
        backgroundColor: (this.video.funnel)?this.video.funnel.progressColor1:this.video.course.progressColor1
      }
      return style
    },
    
    playerCssProress2(){
      let style = {
        backgroundColor: (this.video.funnel)?this.video.funnel.progressColor2:this.video.course.progressColor2
      }
      return style
    },
    playerCss(){
      let style = {
        backgroundColor: (this.video.funnel)?this.video.funnel.backgroundColor:this.video.course.backgroundColor,
        color:(this.video.funnel)?this.video.funnel.textColor:this.video.course.textColor
      }
      return style
    },
    playerProgressCss(){      
      let width = (this.video.enableChapter)?"calc(100% - 82px)":"calc(100% - 44px)"
      let style = {
        backgroundColor: (this.video.funnel)?this.video.funnel.backgroundColor:this.video.course.backgroundColor,
        color:(this.video.funnel)?this.video.funnel.textColor:this.video.course.textColor,
        width: width
      }
      return style
    }
  },
  methods: {
    go_time(time){
      if(time)
        this.$refs.video.currentTime = time
    },
    show_chapter(){
      this.pannel_chapter = !this.pannel_chapter
    },
    toHHMMSS (secs) {
      // let secs = (document.getElementById("video"))?document.getElementById("video").currentTime:0
        var sec_num = parseInt(secs, 10)
        var hours   = Math.floor(sec_num / 3600)
        var minutes = Math.floor(sec_num / 60) % 60
        var seconds = sec_num % 60

        return [hours,minutes,seconds]
            .map(v => v < 10 ? "0" + v : v)
            .filter((v,i) => v !== "00" || i > 0)
            .join(":")
        },
    timeupdate(e) {
      this.video_current_time = e.target.currentTime   
      document.getElementById('toHHMMSS').innerText = this.toHHMMSS(e.target.currentTime)
      var left = (this.video_current_time / this.video.duration) * 100;
      var t = (this.video.duration / (this.rulerStep * this.rulerStepZomm) ) * 100;
      var offset = (left * t) / 100;
      document.getElementById('rullerProgress').style.left = "calc(" + offset + "px - 10px )";   
      document.getElementById('rullerProgress2').style.left = "calc(" + offset + "px  )"; 
      var rullerProgress2 =  document.getElementById('video-ruler') 
      let moduloo = offset % rullerProgress2.clientWidth      
      if(moduloo >= (rullerProgress2.clientWidth/3) && moduloo < (rullerProgress2.clientWidth/3) + 50)
      {
        rullerProgress2.scrollLeft = offset       
      }
    },
    onResizeComponent(x, y, w, h, cmp){
      cmp.width= w
      cmp.height = h   
      cmp.x = x
      cmp.y = y + this.viewPort.height
    },
    onDragstopComponent(x, y, cmp){
        cmp.x = x 
        cmp.y = y + this.viewPort.height
    },
    play(){
      this.$refs.video.play()
      this.is_playing = true
    },
    pause(){
      this.$refs.video.pause()
      this.is_playing = false
    },
    sleep(ms) {
      return new Promise((resolve) => {
        setTimeout(resolve, ms);
      });
    },
    async viewPortDone_(){
      this.$vs.loading({type:"sound"})
      let video_ = document.getElementById('video_')
      // let viewport = {"width":560,"height":315}
      await this.sleep(2500);
       let viewport = {
        width: video_.clientWidth ,
        height: video_.clientHeight ,
      }
      console.log("🚀 ~ file: VideoControls.vue ~ line 181 ~ viewport", viewport)
      let this_ = this
      this.video.nodes.forEach( async function(node) {
        // console.log("🚀 ~ file: VideoControls.vue ~ line 178 ~ this.video.nodes.forEach ~ node", node)
        await this_.calcul(node, viewport)
        // console.log("🚀 ~ file: VideoControls.vue ~ line 179 ~ this.video.nodes.forEach ~ node", node)
      })
      this.viewPortDone = true
      // console.log("🚀 ~ file: VideoControls.vue ~ line 184 ~ this.viewPortDone ", this.viewPortDone )
      
      this.$vs.loading.close()
    },
    async calcul(node, viewPort){      
      node.width = viewPort.width * node.width
      node.x = viewPort.width * node.x
      node.height = viewPort.height * node.height
      node.y = viewPort.height * node.y
      node.borderRadius = viewPort.height * node.borderRadius
      node.fontSize = viewPort.height * node.fontSize

    }
  },

  async mounted() {
      let video_ = document.getElementById('video_')
      this.viewPort = {
        width: video_.clientWidth ,
        height: video_.clientHeight ,
      }
      await this.viewPortDone_()
      // this.video.viewport = this.viewPort
  },
};
</script>
<style lang="scss" scoped>
  .NodeDraggable{   
    &.vdr{
      
      border: 1px solid var(--vprimary) !important;

    } 
  .handle {    
      z-index: 99 !important;
      border: 1px solid var(--vprimary) !important;
      border-radius: 5px;
    }
    .handle-tr {
      top: -6px !important;
      right: -6px !important;
    }
    .handle-mr {
      right: -6px !important;
    }
    .handle-br {
      bottom: -6px !important;
      right: -6px !important;
      }
    .handle-bm {
      bottom: -6px !important;
    }
    .handle-bl {
      bottom: -6px !important;
      left: -5px !important;
    }
    .handle-ml {
      left: -6px !important;
    }
    .handle-tl {
      top: -6px !important;
      left: -6px !important;
    }
    .handle-tm {
      top: -6px !important;
    }
    .handle-bm {
      bottom: -6px !important;
    }
  }
.pannel_chapters{
    position: absolute;
    // width: 200px;
    // height: calc(100% - 30px);
    z-index: 99999999;
    right: 4px;
    padding: 15px;    
    bottom: 31px;
    text-align: left;
    .x{
      float: right;
      cursor: pointer;
    }
    span{
      display: block;
      border-bottom: 1px solid;
      padding-bottom: 5px;      
      font-weight: bold;      
      margin-bottom: 7px;
    }
    li{
      display: block;
      padding: 0px;
      margin: 0px;
      list-style: none;      
      text-align: left;
      cursor: pointer;
      &:hover{
        opacity: .8;
      }
    }

}
</style>