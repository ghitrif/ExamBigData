<template>
<div class="recordrtcAudio" style="width: 100%;" >
      <audio-recorder
    :upload-url="url"
    :video="video"
    :visitor="visitor"
    :attempts="3"
    :time="2"
    :headers="headers"
    :before-recording="callback"
    :pause-recording="callback"
    :after-recording="callback"
    :select-record="callback"
    :before-upload="callback"
    :successful-upload="callback"
    :failed-upload="callback"
    @playnext="playnext"
    />

</div>
</template>

<script>
import Vue from 'vue'
import axios from "axios"
let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
import AudioRecorder from "../components/audioRecorder/index.js"

Vue.use(AudioRecorder)
export default {
  props: ['video', 'url', 'visitor'],
  data() {
    return {
    };
  },
  computed: {
     
  },
  methods: {
    playnext(){
      this.$emit("playnext", 4)

    },
    callback (data) {
        console.debug(data)
    }
  },
  async mounted() {

  },
};
</script>
<style lang="scss">
</style>