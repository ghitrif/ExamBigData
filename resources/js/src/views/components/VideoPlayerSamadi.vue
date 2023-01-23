<template>
    <div class="vvideo"  >
        <span v-if="!isPlaying" @ended="isPlaying=false" class="playVideo zm1" @click="play"><i  class="el play-button-arrowhead "></i></span>
        <video @click="pause()" ref="video" width="100%" height="100%"  :src="media.path" :key="media.path">
            <source :src="media.path" type="video/mp4">
        </video>
    </div>
</template>


<script>

import axios from 'axios';

export default {
  props: ['media'],
  data() {
    return {
        isPlaying:false
    }
  },components: {
  },
  methods: {
    play(){
        this.$refs.video.play()
        this.isPlaying = true
    },
    pause(){
        this.$refs.video.pause()
        this.isPlaying = false
    },
  },

    mounted() {
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>

<style lang="scss" >
  
</style>