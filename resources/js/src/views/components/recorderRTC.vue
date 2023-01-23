<template>
<div class="recordrtc" style="position:relative;
    height: calc(100vh - 126px);
    background: black;
    text-align: center;">  
      <video muted id="videoRTC_"  height="100%" autoplay  playsinline >
    </video>
    <img id="recimg" src="/image/recording.gif">
    <div id="video-action" class="video-action">
        <span id="start_" class="start_" @click="start">Start</span>
        <span id="stop_" class="stop_" @click="stop">Stop</span>
    </div>
    
    <div id="likit" class="likit">
        <div>Like it ?</div>
        <span id="yes_" class="yes_" @click="upload">Yes</span>
        <span id="no_" class="no_" @click="cancelRecording">No</span>
    </div>
</div>
</template>

<script>

import axios from "axios"
let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
export default {
  props: ["visitor",'video', 'url'],
  data() {
    return {
        stream:false,
        recorder :false
    };
  },
  computed: {
     
  },
  methods: {
      async start(){
          await this.recorder.startRecording();
          document.getElementById('recimg').style.display = 'inline-block'
          document.getElementById('start_').style.display = 'none'
          document.getElementById('stop_').style.display = 'inline-block'
          
      },
      async cancelRecording(){
          this.$emit('cancelRecording')
      },
      async upload(){
           console.log("click webcam")
          let _this
            let url = "/media/rtc"
            let blob = await this.recorder.getBlob();
            var fileType = blob.type.split('/')[0] || 'audio';
            var fileName = (Math.random() * 1000).toString().replace('.', '') + '.webm';
            var formData = new FormData();
            formData.append(fileType + '-filename', fileName);
            formData.append(fileType + '-blob', blob);
            if(this.visitor){
                url = this.url
                formData.append('video', this.video.id);
                formData.append('visitor', this.visitor);
                formData.append('record', 1);
                formData.append('media', blob);
            }
            this.$vs.loading({type:"sound"})
            let response = await axios.post(url, formData, {
            onUploadProgress: function (progressEvent) {
                // _this.videos.nodes[0].progress = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) ); 
            }.bind(this),
            })
            this.$vs.loading.close()
            // if (response.data.status == 1) {
                this.$emit('doneRecording', response.data.data, 'webcam')
            // s}
            
      },
      async stop(){
        await this.recorder.stopRecording();        
        document.getElementById('recimg').style.display = 'none'
        document.getElementById('video-action').style.display = 'none'
        // document.getElementById('start_').style.display = 'inline-block'
        document.getElementById('likit').style.display = 'block'
        // this.recorder.destroy()
        this.stream.stop();
        let blob = await this.recorder.getBlob();
        // let data = await this.recorder.save("d.webm");
        // invokeSaveAsDialog(data);        
        
        // var video = document.getElementById("videoRTC_");
        // video.src =  window.URL.createObjectURL(blob)
       
      }
  },
  async beforeDestroy() {
      
    console.log("🚀 ~ file: recorderRTC.vue ~ line 85 ~ beforeDestroy ~ beforeDestroy", "beforeDestroy")
    // await this.recorder.stopRecording();
    // await this.stream.stop();
    await this.stream.getTracks().forEach(function(track) {
    track.stop();
    });

   
  },
  async mounted() {
      var videoConstraints = {
                    video: {
                        mandatory: {
                            minWidth: 1280,
                            minHeight: 720,
                            maxWidth: 1920,
                            maxHeight: 1080,
                            // minFrameRate: 3,
                            // maxFrameRate: 32,
                            minAspectRatio: 1.77
                        },
                        optional: []
                    }
            };

// navigator.getUserMedia(videoConstraints, this.onSuccess, this.onFailure);
    let HTMLVideoElement = document.getElementById("videoRTC_")
    this.stream = await navigator.mediaDevices.getUserMedia(videoConstraints);
    this.recorder = new RecordRTCPromisesHandler(this.stream, {
        type: 'video',
        mimeType: 'video/webm',

        
    });
    // this.recorder.startRecording();
    
      document.getElementById("videoRTC_").srcObject = this.stream;
  },
};
</script>
<style lang="scss" scoped>
.video-action, .likit{
    position: absolute;
    bottom: 50px;
    text-align: center;
    width: 100%;
    div{
        color:#fff
    }
    span{
        
        height: 100px;
        width: 100px;
        display: inline-block;
        border-radius: 50%;
        line-height: 100px;
        color: white;
        cursor: pointer;
        display: none;
        &.start_{
            background: #00000069;            
            display: inline-block;
        }
        &.recording_{            
            background: #08f36669;
        }
        &.stop_{
            background: #ff180169;
        }
        &.yes_{
            background: #08f36669;            
            display: inline-block;
            height: 50px;
            width: 50px;
            line-height: 50px;
        }
        &.no_{       
            height: 50px;
            width: 50px;
            line-height: 50px;
            background: #ff180169;     
            display: inline-block;            
        }

    }
}
#recimg{
    position: absolute;
    top:20px;
    right:20px;
    width: 100px;
    display: none;
}
.likit{
    display: none;
}
</style>