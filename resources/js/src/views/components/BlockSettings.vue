<template>
    <div class="tab_settings BlockSettings">
        
        <li v-if="node.type == 'ImageComponent' ">
            <h4 style="color:var(--vprimary)" class="mb-3">Choose Image</h4>            
            <MediaFile :type="'image'" v-model="node.media" />
        </li>
        <li v-if="node.type == 'YoutubeComponent' ">
            <div class="mb-3">Youtube Video ID</div>         
            <input  type="text" class="form-control" v-model="node.settings.id">
        </li>
        <li v-if="node.type == 'embedCode' || node.type == 'Map' ">
            <div class="mt-2">Embed Code: </div>
            <vs-textarea v-model="node.content" />
        </li>
        <li v-if=" node.type == 'optin' ">
            <h4 style="color:var(--vprimary)">Autoresponders: </h4>         
            <div class="mt-2">Autoresponder </div>
             
            <select @change="autoresponders_list_($event)" class="form-control" placeholder="Choose Autoresponder" v-model="node.settings.autoresponder">
                <option v-for="item,index in vars.Autoresponders" :key="index" :value="item">{{item}}</option>
            </select>    
            <div class="mt-2">Autoresponder</div>
            <select class="form-control" v-model="node.settings.autoresponder_id">
                <option v-for="item,index in lists" :key="index" :value="item.id">{{item.name}}</option>
            </select>
        </li>
        
        <li v-if=" node.type == 'Share' ">  
                  
        <h4 style="color:var(--vprimary)">Social share: </h4>          
            <div class="mt-2">Facebook </div>
            <input  type="text" class="form-control" v-model="node.settings.facebook">
            <div class="mt-2">Twitter </div>
            <input  type="text" class="form-control" v-model="node.settings.twitter">
            <div class="mt-2">Telegram </div>
            <input  type="text" class="form-control" v-model="node.settings.telegram">
            <div class="mt-2">Whatsapp </div>
            <input  type="text" class="form-control" v-model="node.settings.whatsapp">
            <div class="mt-2">Pinterest </div>
            <input  type="text" class="form-control" v-model="node.settings.pinterest">
            <div class="mt-2">Reddit </div>
            <input  type="text" class="form-control" v-model="node.settings.reddit">
        </li>
        <li v-if="node.type == 'ButtonComponent'">            
        <h4 style="color:var(--vprimary)">Action: </h4>
        <fontSelector :label="'Choose Action'" :options="vars.btnActionOptions" v-model="node.action"></fontSelector>
        <input v-if="node.action == 'Open URL'" type="url" class="form-control" v-model="node.url">
        <MediaFile v-if="node.action == 'Download File'" v-model="node.media" />
        <template v-else-if="node.action == 'Skip To Time'">
            <input type="number" class="form-control" v-model="node.url" style="width: 80px;float:left">    
            <vs-button class="float-left chooseTime ml-3" style="" ><span class="el stopwatch"></span> Choose</vs-button>
        </template>
        <template v-else-if="node.action == 'Jump To Video'">
            <select v-model="node.goto_id" class="form-control">
                <option v-for="(video, i) in funnel.videos" :key="i" :value="video.id">{{video.name}}</option>
            </select>

        </template>
        </li>
        <li v-if="Typeface ">            
        <h4 style="color:var(--vprimary)">Typeface</h4>
        <div>   
            <template v-if="TextContent ">
                <div class="mt-2">Text: </div>
                <input type="text" class="form-control" v-model="node.content">
            </template>
            <div class="mt-2">Text color: </div>
            <colorInput v-model="node.color"></colorInput>             
            <div class="mt-2">Background color: </div>
            <colorInput v-model="node.background"></colorInput> 
            <template v-if="FontStyle">
            <div class="Slabel mt-2">Font Style:</div>
            <fontSelector :label="'Font Style'" :options="vars.fontsOption" v-model="node.fontFamily"></fontSelector>
            </template>
            <!-- <span class="Slabel mt-4">Text Style </span>
            <fontSelector :label="'Text Style'" :options="vars.textStyleOption" v-model="node.textStyle"></fontSelector> -->
            <template v-if="TextStyle">
            <div class="mt-5 mb-5 TextStyle">  
                <span :class="['el ta paragraph-left', {activ:node.textAlign == 'left'}]" @click="node.textAlign = 'left'"></span>
                <span :class="['el ta paragraph-center', {activ:node.textAlign == 'center'}]" @click="node.textAlign = 'center'"></span>
                <span :class="['el ta paragraph-justify', {activ:node.textAlign == 'justify'}]"  @click="node.textAlign = 'justify'"></span>
                <span :class="['el ta paragraph-right', {activ:node.textAlign == 'right'}]"  @click="node.textAlign = 'right'"></span>
                <span class="" style="position: relative;top: -2px;">|</span>
                <span :class="['el ta bold', {activ:node.textStyle == 'bold'}]" @click="node.textStyle =(node.textStyle != 'bold')?'bold':'normal'"></span>
                <span :class="['el ta italic', {activ:node.fontStyle == 'italic'}]" @click="node.fontStyle =(node.fontStyle != 'italic')?'italic':'normal'" ></span>
                <span :class="['el ta underline', {activ:node.textDecoration == 'underline'}]" @click="node.textDecoration=(node.textDecoration != 'underline')?'underline':'none'"></span>
                <span :class="['el ta strikethrough', {activ:node.textDecoration == 'line-through'}]" @click="node.textDecoration=(node.textDecoration != 'line-through')?'line-through':'none'"></span>
            </div>
            <div class="Slabel mt-2">Size: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.fontSize" />
            <div class="Slabel mt-2">Lettre Spacing: </div>
            <vue-slider :min="0" :max="10" style="margin-buttom:10px;padding:10px" v-model="node.letterSpacing" />
            </template>
        </div>
        </li>
        
        <li v-if="borderStyle ">            
            <h4 style="color:var(--vprimary)">Border Style </h4>     
            <div class="mt-2">Border Color: </div>
            <colorInput v-model="node.borderColor"></colorInput>
            <div class="mt-2">Style: </div>
            <fontSelector :label="'Border Style'" :options="vars.borderOption" v-model="node.borderStyle"></fontSelector>
            
            <div class="mt-2">Weight: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.borderSize" />
            
            <div class="mt-2">Rounded Corners: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.borderRadius" />
        </li>

        <li v-if="node.type == 'optin'">            
            <h4 style="color:var(--vprimary)">Text Input style</h4>     
            <div class="mt-2">Background Color: </div>
            <colorInput v-model="node.settings.ipnutBackground"></colorInput>
            <div class="mt-2">Text Color: </div>
            <colorInput v-model="node.settings.ipnutColor"></colorInput> 
            
            <h4 class="mt-2" style="color:var(--vprimary)">Text Input Border</h4> 

            <div class="mt-2">Border Color: </div>
            <colorInput v-model="node.settings.ipnutBorderColor"></colorInput>
            <div class="mt-2">Style: </div>
            <fontSelector :label="'Border Style'" :options="vars.borderOption" v-model="node.settings.ipnutBorder"></fontSelector>
            <div class="mt-2">Weight: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.settings.ipnutBorderWeight" />
            
            <div class="mt-2">Rounded Corners: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.settings.ipnutRadius" />
        </li>

        <li v-if="node.type == 'optin'">            
            <h4 style="color:var(--vprimary)">Button Input style</h4>     
            <div class="mt-2">Background Color: </div>
            <colorInput v-model="node.settings.buttonBackground"></colorInput>
            <div class="mt-2">Text Color: </div>
            <colorInput v-model="node.settings.buttonColor"></colorInput> 
            
            <h4 class="mt-2" style="color:var(--vprimary)">Text Input Border</h4> 

            <div class="mt-2">Border Color: </div>
            <colorInput v-model="node.settings.buttonBorderColor"></colorInput>
            <div class="mt-2">Style: </div>
            <fontSelector :label="'Border Style'" :options="vars.borderOption" v-model="node.settings.buttonBorder"></fontSelector>
            <div class="mt-2">Weight: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.settings.buttonBorderWeight" />
            
            <div class="mt-2">Rounded Corners: </div>
            <vue-slider style="margin-buttom:10px;padding:10px" v-model="node.settings.buttonRadius" />
        </li>
        <li v-if="node.type == 'Timer'">
            
            <h4 style="color:var(--vprimary)">Timer Settings</h4> 
              <div class="mt-2">Countdown start </div>
              <datetime
                type="datetime"
                v-model="node.settings.start"
                format="DateTime.DATETIME_SHORT"
              ></datetime>
              <div class="mt-2">Countdown end </div>
              <datetime
                type="datetime"
                v-model="node.settings.end"
                format="DateTime.DATETIME_SHORT"
              ></datetime>
        </li>
        <AnimatationSettings v-model="node.animation" />
        
    </div>
</template>

<script>


import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'
import { mapGetters, mapActions } from "vuex";
import AnimatationSettings from "./AnimatationSettings.vue"
import vars from './video/vars.js'
export default {
  name: "BlockSettings",
  props: ['node', "funnel"],
  data() {
    return {
        vars:vars,
        lists:[]
    };
  },
  components: {
    VueSlider,      
    datetime: Datetime,
    AnimatationSettings
  },
  computed: {     
      Typeface(){          
          let node = this.node
          return  (node.type != 'embedCode' 
                    && node.type != 'Map' 
                    && node.type != 'Share' 
                    && node.type != 'YoutubeComponent' 
                    && node.type != 'ImageComponent' 
          ) 
      },
      borderStyle(){
          let node = this.node
          return (this.node.type != 'embedCode' && node.type != 'Map' && node.type != 'Share' && node.type != 'Timer' && node.type != 'YoutubeComponent')
      },
      FontStyle(){
          let node = this.node
          return (node.type != 'Timer')
      },
      TextStyle(){
          let node = this.node
          return (
              node.type != 'Timer' && node.type != 'optin'
          )
      },
      TextContent(){
          let node = this.node
          return (node.type != 'optin' && node.type != 'Timer')
      }
  },
  methods: {
       
    ...mapActions(["GetIntegrationList"]),
    async autoresponders_list_(event, b = false){
        
      let autoresponder = !b ? this.node.settings.autoresponder : b.settings.autoresponder;
      
      this.$vs.loading({type:"sound"})
      let res = await this.GetIntegrationList(autoresponder)
      this.$vs.loading.close()
      this.lists = res.data

    },
  },
  async mounted() {
      this.autoresponders_list_();
  },
};
</script>
<style lang="scss" scoped>
.tab_settings{
    padding: 10px;
    overflow: auto;    
    position: relative;
    height: 100%;
    .title{
        line-height: 40px;
        border-bottom: 1px solid #00000017;
        display: block;
    }
    li{
        list-style: none;
        display: inline-block;
        background: #7367f014;
        padding: 20px 10px;
        width: 100%;
        border-radius: 7px;
        margin-top: 10px;
        label{
            float: left;
        }
        .vs-switch{
            float: right;
        }
    }
}
</style>
<style lang="scss">
.ta{
    padding: 5px;
    font-size: 19px;
    color: black;
    cursor: pointer;
}
.vue-slider-rail {
    background-color: #00000052 !important;
}
.chooseTime{
    float: left !important;
    height: 32px !important;
    line-height: 32px !important;
    padding: 0px 16px !important;
}
.vdatetime-input{
    height: 30px !important;
    border: 1px solid #837e7e52 !important;
}
.TextStyle{
    .el{        
        border: 1px solid #0000002e;
        margin-bottom: 14px;
        &.activ{
            display: inline-block;        
            border: 1px solid #000000b8;
        }
        
    }
    

}
</style>