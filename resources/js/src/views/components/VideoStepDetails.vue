<template>
  <div>
        <template v-if="selectedResponse">                    
            <VideoPlayerSamadi v-if="selectedResponse.extension == 'mp4'" :media="selectedResponse" />
        </template>
        <div class="interationBody--top" style="text-align:center" >
            <template v-if="selectedResponse">
                <template v-if="selectedResponse=='overview'">
                    <MultipleChoicesOverview :step='step' />
                </template>
                <VueSvgGauge
                    v-else-if="selectedResponse.type == 'NPS'"
                    :start-angle="-90"
                    :end-angle="90"
                    :value="selectedResponse.result"
                    :separator-step="1"
                    :min="0"
                    :max="10"
                    :gauge-color="[{ offset: 0, color: resultsColor}, { offset: 100, color: resultsColor}]"
                    :scale-interval="0.1"
                >
                <div class="inner-textJ">
                    <span style="position:relative">
                        <i class="number_">{{selectedResponse.result}}</i>
                        <i :class="['el passive', resultsClass]" ></i>
                    </span>
                    
                </div>
                </VueSvgGauge>

                <template v-else-if="selectedResponse.type == 'Open Ended'">                                    
                    <audio controls v-if="selectedResponse.extension == 'mp3'">
                        <source :src="selectedResponse.path" type="audio/mpeg">
                    </audio>

                    <div v-else-if="selectedResponse.response">
                      
                      <div> <b>Text Response:</b> </div>
                      <p> {{selectedResponse.response}} </p>

                    </div>
                </template>
                <template v-else-if="selectedResponse.type == 'Payment'" >
                        <img  style="width: 56px;
    margin-bottom: 15px;" :src="'/images/integrations/'+selectedResponse.payment.type+'.svg'">

                       <div style="    text-align: left;
    font-weight: normal;
    color: black;">
                        <div> <b>Name:</b> {{selectedResponse.payment.name}}</div>
                        <div> <b>Email:</b> {{selectedResponse.payment.email}}</div>
                        <div> <b>Amount:</b> {{selectedResponse.payment.amount}}</div>
                        <div> <b>Adress:</b> {{selectedResponse.payment.adress}}</div>
                        <div> <b>Zip:</b> {{selectedResponse.payment.zip}}</div>
                       </div>

                </template>
                <template v-else-if="selectedResponse.type == 'Optin Form'" >
                    <div class="optinForm">
                        <i class="el mail" style="    font-size: 70px;
    font-weight: normal;"></i>
                        <div> Name: {{selectedResponse.name}}</div>
                        <div> Email: {{selectedResponse.email}}</div>
                    </div>

                </template>
                <MultipleChoices v-else-if="selectedResponse.type == 'Multiple Choices'" :response="selectedResponse" :step="step" />
                <BtnSlide v-else-if="selectedResponse.type == 'File Upload'" :media="selectedResponse" />
            </template>
            <div class="visitorDetails" v-if="visitor">
                <h3 class="mb-2">{{visitor | name}}</h3>
                <span style="font-size: 11px;">22 SEP 21 @ 16:54</span>
                <span class="em mt-2" v-if="visitor.email">{{visitor.email}}</span>
                <span @click="replyContact_" :class="['replay',{disabled:!visitor.email}]">Replay <i class="el back-arrow"></i></span>

            </div>
        </div> 
      
        <div class="interationBody--footer">
            <ul class="steps">
                <li v-if="step.type=='Multiple Choices'" :class="[ {acc:selectedResponse=='overview'}]" @click="responeClicked('overview')">
                    <i class="el  trending-up"></i>
                    <span class="d">Overview</span>
                </li>
                <li  v-for="response, i in step.responses" :key="i" :class="[ {acc:selectedResponse==response}]" @click="responeClicked(response)" :style="'background-image: url('+ response.thumbnail +')'">
                    <i :class="getClass(response)"></i>
                    <span class="d">{{response.created_at | onlyDate}}</span>
                </li>
            </ul>
        </div>

        <vs-popup class="addNewVideo" fullscreen title="" :active.sync="replyContact">
            <div v-if="replyContact">
              <div class="step0" style="width: 50%; margin: 0 auto;" v-if="!video_source">
                <div class="mb-3 text-center">How would you like to replay ?</div>
                <vs-row>
                  <vs-col vs-w="4" >
                    <div class="wl zm" @click="video_source='webcam'">
                      <i class="el  webcam"></i>
                      <span>Webcam</span>
                    </div>
                  </vs-col>
                  <vs-col vs-w="4" >
                    
                    <div class="wl zm"  @click="video_source='screen'">
                      <i class="el  computer-screen"></i>
                      <span>SreenShare</span>
                    </div>
                  </vs-col>
                  
                  <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='uploads'">
                      <i class="el   upload-cloud"></i>
                      <span>Uploads</span>
                    </div>
                  </vs-col>
                  
                  <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='library'">
                      <i class="el  video-files"></i>
                      <span>DFY videos</span>
                    </div>
                  </vs-col>   
                  <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='giphy'">
                      <i class="el  giphy"></i>
                      <span>Giphy</span>
                    </div>
                  </vs-col> 
                  
                  <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='pixels'">
                      <i class="el  letter-p"></i>
                      <span>Pixels</span>
                    </div>
                  </vs-col>               
                   <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='youtube'">
                      <i class="el  youtube"></i>
                      <span>Youtube</span>
                    </div>
                  </vs-col>
                  
                   <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='dropbox'">
                      <i class="el  dropbox"></i>
                      <span>DropBox</span>
                    </div>
                  </vs-col>
                   <vs-col vs-w="4" >
                    <div class="wl zm"  @click="video_source='vimeo'">
                      <i class="el  vimeo-1"></i>
                      <span>Vimeo</span>
                    </div>
                  </vs-col>
                </vs-row>
              </div>
               <div v-if="video_source == 'library'">          
                <MediaLibrary @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'webcam'">          
                <Recorder @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'screen'">          
                <recorderRTCScreen @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'uploads'">          
                <UserMedia @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'giphy'">          
                <MediaLibraryGiphy @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'pixels'">          
                <MediaLibraryPixels @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'vimeo'">          
                <MediaLibraryVimeo @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'youtube'">          
                <MediaLibraryYoutube @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
              <div v-else-if="video_source == 'dropbox'">          
                <MediaLibraryDropBox @cancelRecording="cancelRecording" @doneRecording="doneRecording" />
              </div>
            </div>
          </vs-popup>
  </div>
</template>


<script>

import axios from 'axios';

import { mapGetters, mapActions } from "vuex";
import VideoPlayerSamadi from "./VideoPlayerSamadi.vue"
import MultipleChoices from "./MultipleChoicesStep.vue"
import MultipleChoicesOverview from "./MultipleChoicesOverview.vue"
import BtnSlide from "./btnSlide.vue"
import VideoStepDetails from "./VideoStepDetails.vue"

import Recorder from "../components/recorderRTC.vue"
import recorderRTCScreen from "../components/recorderRTCScreen.vue"
import MediaLibrary from "../components/MediaLibrary.vue"
import MediaLibraryGiphy from "../components/MediaLibraryGiphy.vue"
import MediaLibraryPixels from "../components/MediaLibraryPixels.vue"
import MediaLibraryVimeo from "../components/MediaLibraryVimeo.vue"
import MediaLibraryYoutube from "../components/MediaLibraryYoutube.vue"
import MediaLibraryDropBox from "../components/MediaLibraryDropBox.vue"
import UserMedia from "../components/UserMedia.vue"

import { VueSvgGauge } from 'vue-svg-gauge'

export default {
  props: ['step'],
  data() {
    return {
        selectedResponse:false,
        options:{},
        video_source:false,
        replyContact:false
    }
  },
  components:{
      VideoPlayerSamadi,
      MultipleChoices,
      MultipleChoicesOverview,
      BtnSlide,
      VideoStepDetails,
      VueSvgGauge,

      MediaLibrary,
    Recorder,
    recorderRTCScreen,
    UserMedia,
    MediaLibraryGiphy,
    MediaLibraryPixels,
    MediaLibraryVimeo,
    MediaLibraryYoutube,
    MediaLibraryDropBox,
  },
  computed: { 
      resultsClass(){
          if(!this.selectedResponse)
            return ""
          if(this.selectedResponse.result <= 6)
            return "detractor_"
          else if(this.selectedResponse.result <= 8)
            return "passive_"
          else return 'promoter_'
      }, 
      resultsColor(){
          if(!this.selectedResponse)
            return ""
          if(this.selectedResponse.result <= 6)
            return "#d9072d"
          else if(this.selectedResponse.result <= 8)
            return "#f1ea0f"
          else return '#36cf71'
      },
      visitor(){
        if(this.selectedResponse)
            return this.selectedResponse.visitor
        return false

      }
  },  
  filters: {
  onlyDate: function (value) {
        if (!value) return ''
        value = value.toString()
        return value.substring(0, 10)
    },
  name: function (obj) {
    if (!obj) return ''
    if(obj.name)
        return obj.name
    else
        return 'Human'
  },
  },

  methods: { 
    ...mapActions(["replayContact",]),
    replyContact_(){
        if(!this.visitor.email)
            return false
        this.replyContact = true
    },
    cancelRecording(){
        this.video_source = false
    },
    async doneRecording(media, type){
      media = {
        ...media,
        type:type,
        visitor:this.selectedResponse
      }
      if(type == 'vimeo' || type == 'youtube' ){
        media = {
          video_url:media,
          type:type
        }
      }
        await this.replayContact(media)
        this.video_source = false        
        this.replyContact = false
    },
    getClass: function (value) {
        switch(value.type) {
        case 'Open Ended':
            return (value.extension != "mp4") ? "el video-chat":""
            break;
        case 'Multiple Choices':
            return "el server"
            break;
        case 'Call To Action':
            return "el action"
            break;
        case 'Optin Form':
            return "el branding"
            break;
        case 'Calendar':
            return "el calendar"
            break;
        case 'NPS':
            return "el smiling-emoticon-square-face"
            break;
        case 'File Upload':
            return "el upload-cloud"
            break;
        case 'Payment':
            return "el credit-card"
            break;
        default:
            // code block
        }
    },
    async responeClicked(response){
        this.selectedResponse = false
        this.$nextTick(() => {
            this.selectedResponse = response
        });
               
    }
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


.btn-slide, .btn-slide2 {
    position: relative;
    display: inline-block;
    height: 53px;
    width: 200px;
    line-height: 50px;
    padding: 0;
    border-radius: 50px;
    background: #fdfdfd;
    border: 2px solid #0099cc;
    margin: 10px;
    transition: .5s;
}

.btn-slide2 {
    border: 2px solid #36cf71;
}

.btn-slide:hover {
    background-color: #0099cc;
}

.btn-slide2:hover {
    background-color: #36cf71;
}

.btn-slide:hover span.circle, .btn-slide2:hover span.circle2 {
    left: 100%;
    margin-left: -45px;
    background-color: #fdfdfd;
    color: #0099cc;
}

.btn-slide2:hover span.circle2 {
    color: #36cf71;
}

.btn-slide:hover span.title, .btn-slide2:hover span.title2 {
    left: 40px;
    opacity: 0;
}

.btn-slide:hover span.title-hover, .btn-slide2:hover span.title-hover2 {
    opacity: 1;
    left: 40px;
}

.btn-slide span.circle, .btn-slide2 span.circle2 {
    display: block;
    background-color: #0099cc;
    color: #fff;
    position: absolute;
    float: left;
    margin: 5px;
    line-height: 42px;
    height: 40px;
    width: 40px;
    top: 0;
    left: 0;
    transition: .5s;
    border-radius: 50%;
}

.btn-slide2 span.circle2 {
    background-color: #36cf71;
}

.btn-slide span.title,
  .btn-slide span.title-hover, .btn-slide2 span.title2,
  .btn-slide2 span.title-hover2 {
    position: absolute;
    left: 90px;
    text-align: center;
    margin: 0 auto;
    font-size: 16px;
    font-weight: bold;
    color: #30abd5;
    transition: .5s;
}

.btn-slide2 span.title2,
  .btn-slide2 span.title-hover2 {
    color: #36cf71;
    left: 80px;
  }

.btn-slide span.title-hover, .btn-slide2 span.title-hover2 {
    left: 80px;
    opacity: 0;
}

.btn-slide span.title-hover, .btn-slide2 span.title-hover2 {
    color: #fff;
}
  
</style>