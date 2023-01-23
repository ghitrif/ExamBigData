<template>
  <div class="flowchart-node" :style="nodeStyle" 
    @mousedown="handleMousedown"
    @mouseover="handleMouseOver"
    @mouseleave="handleMouseLeave"
    
      @dblclick="editVideoPopup"
    v-bind:class="{selected: options.selected === id}">
    <div class="node-port node-input" v-if="node.type != 'start'"
       @mousedown="inputMouseDown"
       @mouseup="inputMouseUp">
    </div>
    <div v-if="node.type != 'start'" :image="image" class="node-main" >
      <span class="num">{{(i+1)}}</span>
      <!-- <div v-text="type" class="node-type"></div> -->
      <img class="flow-image" :src="image" alt="image">
      <div v-text="label" class="node-label">{{node.name}}</div>
    </div>
    <div v-else class="startScreen">
      <i class="el  arrow-right"></i>
      <span>Start</span>

    </div>
    <div class="nodeElement">
      <template v-if="node.type != 'start'">
      
      <span class="elemBTN" v-for="(btn,i) in btns" :key="i">        
        <BtnNode :settings="btn" />
        <!-- <span @click="trashBtnNode(btn)" v-if="btn.goto_id && btn.action == 'Jump To Video' " class="el trash trashNode"></span> -->
        <div :class="['node-port node-output', {'el arrow-right-circle':btn.goto_id}, {'el plus-circle':!btn.goto_id}]" 
        :style="{background: 'var(--vblack)', color:'#fff'}"
        @mousedown="outputMouseDown($event, i, btn)">
        </div>
      </span>
      </template>
      <template v-else>
        <span class="elemBTN startScreenElm" v-for="(btn,i) in btns" :key="i">        
        
        <div :class="['node-port node-output', ]" 
        :style="{background: 'var(--vblack)', color:'#fff'}"
        @mousedown="outputMouseDown($event, i, btn)">
        </div>
      </span>

      </template>
    </div>
    
    
    <!-- <div v-show="show.delete" class="node-delete">&times;</div> -->
    <!-- <div class="node-actions">
      <i class="fas fa-magic edit-video el edit-3" @click="$router.push('/Video/Editor/'+node.uid)"></i>
      <i @click="$emit('deleteNode')" class="far fa-trash-alt el trash-2"></i>
    </div> -->
    <vs-popup class="videoPopupEdit" fullscreen title="fullscreen" :active.sync="editVideo">
      <div class="__div" v-if="editVideo">
        
        <div class="leftm">
          <div class="videoPreview" style="">
           
              <FunnelEmbedDesktop :funnel="funnel" :video="node" v-if="FunnelEmbedDesktopReload" />
          </div>
          
        </div>
        
        <div class="rightm">
          <div class="btmBtnSave" @click="saveVideo">
            <i class="el save"></i>
            <span>Save</span>
          </div>
          <div class="act">
              <feather-icon icon="TrashIcon" class="m-0 cursor-pointer" @click="trashVideo" />              
              <feather-icon icon="XIcon" class="m-0 cursor-pointer" @click="editVideo=false" />
          </div>
                      
              <ul class="list-group listAnswer" >
                    <li class="list-group-item" >
                      <span>Step name</span>
                      <input class="form-control ex" v-model="node.name"> 
                    </li>
              </ul>
          <div class="rtabs">
            <li :class="{actv:rtabs=='Answer'}" @click="rtabs='Answer'">Answer</li>
            <li :class="{actv:rtabs=='Video'}" @click="rtabs='Video'">Video</li>
            <li :class="{actv:rtabs=='Branding'}" @click="rtabs='Branding'">Branding</li>
          </div>
          <div class="rtabs-body" v-if="rtabs=='Branding'">
              <div  class="mt-2 colorPi" >                
                <label>Primary Background Color: </label>
                <ColorInput v-model="node.BgColor" /> 
              </div>
              <div  class="mt-2 colorPi" >                
                <label>Primary Text Color: </label>
                <ColorInput v-model="node.TextColor" /> 
              </div>
              <div  class="mt-2 colorPi" >                
                <label>Button Background Color: </label>
                <ColorInput v-model="node.primaryBgColor" /> 
              </div>
              <div  class="mt-2 colorPi" >                
                <label>Button Text Color: </label>
                <ColorInput v-model="node.primaryTextColor" /> 
              </div>
              <div  class="mt-2 colorPi" >                
                <label>Campaign title Color </label>
                <ColorInput v-model="node.ct_color" /> 
              </div>
              
              <div class="switch_ xswithch mt-3" style="padding:0px !important">
                <label>Button border radius?</label>
                <input type="number" v-model="node.radius" />
              </div>
          </div>
          <div class="rtabs-body" v-if="rtabs=='Video'">
          <div class="videoTabTool">
            <img :src="node.thumbnail">
            <div class="videoTabTool--footer">              
              <span @click="trimVideo=true"><i class="el scissors" ></i> Trim</span>
              <a :href="node.path" download><i class="el download-cloud"></i> Download</a>
            </div>
             
          </div>
          <div style="padding: 15px;" v-show="trimVideo">
            <div>              
              <vs-slider :min=0 :max=node.duration step=1 v-model="value1"/>
            </div>
            
            <div>              
              <span class="actions" @click="trime_video">Trim</span>
            </div>
            
          </div>

          </div>
          <div class="rtabs-body" v-if="rtabs=='Answer'">
            <div>
              <span>Select answer type:</span>
              <AnswerType :label="'Select answer type:'" :options="answer_type" v-model="node.type"></AnswerType>
            </div>
            <template v-if="node.type == 'Open Ended'">
            <div class="mb-3 switch_" >Video <vs-switch v-model="node.audio"/></div>            
            <div class="mb-3 switch_">Audio <vs-switch v-model="node.video"/></div>            
            <div class="mb-3 switch_">Text <vs-switch v-model="node.text"/></div> 
            <vs-divider/>
            
            <div class="mt-2 listAnswer">
              <span>Message</span>
              <textarea style="height:100px" class="form-control ex" v-model="node.btnDescription"></textarea>
            </div>
            <vs-divider/>
            <div class="switch_">
              <span><label>Time limit on video/audio?</label> <input v-model="node.limit" class="form-control" ></span>
            </div> 
            </template>
            <template v-else-if="node.type == 'Multiple Choices'">
              <div class="mt-2 listAnswer">
                <span>Question</span>
                <textarea style="height:100px" class="form-control ex" v-model="node.btnDescription"></textarea>
              </div>
              
              <ul class="list-group listAnswer" >
                  <li class="list-group-item" v-for="answer,i in node.nodes" :key="i"  v-if="i!=0">
                    <input class="form-control" v-model="answer.text"> 
                    <i class="el minus" @click="trashAnswer_(answer, i)" title="Remove Option"></i>
                    <i class="el menu"></i></li>
              </ul>
              <div class="addChoice" @click="addAnswer">
                <i class="el plus" title="Add Option"></i> Add Choice
              </div>
            </template>

            <template v-else-if="node.type == 'Call To Action'">  
              
              <div class="mt-2 listAnswer">
                <span>Call to action description</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.btnDescription"></textarea>
              </div>             
              <ul class="list-group listAnswer" >
                    <li class="list-group-item" >
                      <span>Call to action text:</span>
                      <input class="form-control ex" v-model="node.btnText"> 
                    </li>
              </ul>
               
              <div class="switch_ mt-2" style="padding: 0px;"> 
                <span>Call to action URL:</span>             
                <input placeholder="Https://" v-model="node.bntLink" type="text" class="full_">
              </div>
              
            </template>

            <template v-else-if="node.type == 'Map' || node.type == 'Youtube' || node.type == 'Custom Code'">
               <div class="mt-2 listAnswer">
                <span v-if="node.type == 'Map'">Map embed code </span>
                <span v-if="node.type == 'Youtube'">Youtube embed code</span>
                <span v-if="node.type == 'Custom Code'">Your custome embed code</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.embed"></textarea>
              </div> 
            </template>  
            <template v-else-if="node.type == 'Timer'">  
              <div class="listAnswer"> 
                <span class="mt-2">Countdown start </span>
                <datetime
                  @close="FunnelEmbedDesktopReload_"
                  type="datetime"
                  v-model="node.timer.start"
                  format="DateTime.DATETIME_SHORT"
                ></datetime>
                <span class="mt-2">Countdown end </span>
                <datetime
                  type="datetime"
                  v-model="node.timer.end"
                  format="DateTime.DATETIME_SHORT"
                ></datetime>         
                <ul class="list-group listAnswer" >
                      <li class="list-group-item" >
                        <span>Call to action text:</span>
                        <input class="form-control ex" v-model="node.btnText"> 
                      </li>
                </ul>
                <div class="switch_ mt-2" style="padding: 0px;"> 
                  <span>Call to action URL:</span>             
                  <input placeholder="Https://" v-model="node.bntLink" type="text" class="full_">
                </div>
              </div>
            </template>    
            <template v-else-if="node.type == 'Calendar'">     
              
              <div class="mt-2 listAnswer">
                <span>Call to action description</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.btnDescription"></textarea>
              </div>          
              <ul class="list-group listAnswer" >
                    <li class="list-group-item" >
                      <span>Add your appointment scheduling link:</span>
                      <input class="form-control ex" v-model="node.appointmentLink"> 
                    </li>
              </ul>
              <div class="listAnswer mt-3">
                <div>Works with...</div>
                <div>
                  <span><img style="width: 75px; margin-right: 8px; margin-top:5px" src="/images/integrations/oncehub.svg"></span>
                  <span><img style="width: 75px; margin-right: 8px;margin-top:5px" src="/images/integrations/HubSpot.svg"></span>
                  <span><img style="width: 75px; margin-right: 8px;margin-top:5px" src="/images/integrations/calendly.svg"></span>
                  <span><img style="width: 122px; margin-right: 8px;margin-top:5px" src="/images/integrations/acuityscheduling.svg"></span>
                </div>
              </div>
            </template>

            <template v-else-if="node.type == 'NPS'">    
                       
            <div class="mt-2 mb-2 listAnswer">
                <span>Description</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.btnDescription"></textarea>
            </div>
            <div class="mb-3 mt-3 switch_" >With labels? <vs-switch v-model="node.with_labels"/></div> 
              <div class="mb-3">
                NPS scale labels:
              </div>  
              <div class="switch_" style="padding: 0px;">              
              <input v-model="node.left_label" type="text" class="full_">
              <input v-model="node.right_label" type="text" class="full_">
              </div>  
                   
            </template>

            <template v-else-if="node.type == 'Payment'">              
              <div class="listAnswer" >
                  <span>Payment processor:</span>
                  <AnswerType :label="'Select payment processor:'" :options="payment_type" v-model="node.payment_type"></AnswerType>
              </div>
              <div class="mt-2 listAnswer">
                <span>Description</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.pdescription"></textarea>
              </div> 
              <div class="listAnswer currency mt-2">                
                  <span>Amount:</span>                  
                  <input class="form-control" step=any type="number" v-model="node.price">                  
              </div>
              <div class="listAnswer currency  mt-2">                
                  <span>Currency:</span>
                  <select class="form-control" v-model="node.currency">
                    <option v-for="currency,i in vars.currencies" :key="i" :value="currency" >{{currency.cc}}</option>
                  </select>
              </div>
              
              
              
              
            </template>

            <template v-else-if="node.type == 'File Upload'"> 
                          
              <ul class="list-group listAnswer" >
                    <li class="list-group-item" >
                      <span>Call to action text:</span>
                      <input class="form-control ex" v-model="node.btnText"> 
                    </li>
              </ul>
              <div class="mt-2 listAnswer">
                <span>Call to action description</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.btnDescription"></textarea>
              </div> 
            </template>
             <template v-else-if="node.type == 'Optin Form'"> 
                          
              <div class="listAnswer" >
                  <span>Autoresponders:</span>
                  <IntegrationsSelect :label="'Select Autoresponder:'"  v-model="node.payment_type" @input="AutoresponderSelect($event)" />
                  <div class="  mt-2">                
                    <span>List:</span>
                     <select  placeholder="Select list"  is-selected.sync="true"
                     class="selectList"
                     v-model="node.id_list_contact_integration" 
                     >
                     <option :key="index" :value="item.id" 
                      v-for="item,index in filterListIntegration" >{{item.name}} </option>
                     <!-- <vs-select-item selected  value="-1" text="Select list"  v-if="listContact.length==0 || node.id_list_contact_integration==-1 " /> -->
                       <option v-if="filterListIntegration.length==0" value="-1" 
                       text="There is no list" disabled >There is no list</option>
                      </select>
                     <!-- v-model="node.id_list_contact_integration" -->
                    <!-- <select class="form-control"  v-model="node.id_list_contact_integration">
                      <option  :value="itms.id" v-for="itms,i in listContact" :key="i"   >{{itms.name}}</option>

                    </select> -->
                  </div>
              </div>
              
            </template>
            <vs-divider/>
            
              <div class="mt-2 listAnswer" v-if="node.type != 'Timer'">
                <span>Thank you message</span>
                <textarea style="height:150px" class="form-control ex" v-model="node.thankyou"></textarea>
              </div> 
            
            <div class="switch_">
              <span><label>Delay interaction?</label> <input v-model="node.delay" class="form-control" ></span>
            </div>           

          </div>
        </div>
      </div>
    </vs-popup>
  </div>
</template>

<script>

import Vue from 'vue'
import Stripe from "../../payment/stripe.vue"
import ButtonComponent from "../../video/cmp/ButtonComponent.vue"
import AnswerType from "../../video/cmp/AnswerType.vue"
import IntegrationsSelect from "../../video/cmp/IntegrationsSelect.vue"
import videoMixin from "./videoMixin.js"
import BtnNode from "./BtnNode.vue"
import ColorInput from '../../video/cmp/colorInput.vue'

import FunnelEmbedDesktop from "../../../pages/FunnelEmbedDesktop.vue"

import vars from '../../video/vars.js'

import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

import { mapGetters, mapActions } from "vuex";
import Optin from '../../video/cmp/Optin.vue'
export default {
  
   mixins: [videoMixin],
  name: 'FlowchartNode',
  props: {
    id: {
      type: Number,
      default: 1000,
      validator(val) {
        return typeof val === 'number'
      }
    },
    x: {
      type: Number,
      default: 0,
      validator(val) {
        return typeof val === 'number'
      }
    },    
    y: {
      type: Number,
      default: 0,
      validator(val) {
        return typeof val === 'number'
      }
    },
    i:{

    },
    type: {
      type: String,
      default: 'Default'
    },
    label: {
      type: String,
      default: 'input name'
    },
    image: {
      type: String,
      default: ''
    },
    options: {
      type: Object,
      default() {
        return {
          centerX: 1024,
          scale: 1,
          centerY: 140,
        }
      }
    },
    node: {
      type: Object,
    },
    funnel: {
      type: Object,
    },
    
  },
  data() {
    return { 
      reloadVideoPlay:true,
      listContactIntegration:[],
      FunnelEmbedDesktopReload:true,
        trimVideo:false,
        value1:[0, 0],      
        vars:vars,
        server_image: {
          url: '/',
          fetch: null,
          revert: null,
          process: {
            headers: {
              'X-XSRF-TOKEN': "this.$http.defaults.headers.common['Authorization']",
              'Authorization': "this.$http.defaults.headers.common['Authorization']"
              },
            ondata: (fd) => {
                  //  fd.append('scene', this.scene.id);
                  //  fd.append('campaign', this.tour.id);
                  //  fd.append('action', this.upload_scene_action);
                   return fd;
             },
            onload: (res) => {
            console.log("🚀 ~ file: FlowchartNode.vue ~ line 328 ~ data ~ res", res)
                // return this.onload_scene_image(res);
            }
          }
        },
      show: {
        delete: false,
      }
    }
  },
  components:{
    ButtonComponent,
    AnswerType,
    IntegrationsSelect,
    Stripe,
    BtnNode,
    ColorInput,
    FunnelEmbedDesktop,
    datetime: Datetime,
    FilePond: vueFilePond(   FilePondPluginFileMetadata, FilePondPluginFileValidateType),
    Optin,

  },
  mounted() {
    this.value1 = [0, this.node.duration] 
    if(typeof this.node.currency === 'string')
      this.node.currency = JSON.parse(this.node.currency)
      
    if(typeof this.node.timer === 'string')
      this.node.timer = JSON.parse(this.node.timer)
    this.AutoresponderSelect(this.node.payment_type);

  },
  computed: {
    filterListIntegration(){
       let res =  this.listContactIntegration;
           if(this.node.payment_type=="Stripe" || this.node.payment_type=="Paypal")
        {
          this.node.payment_type="AWeber";
          res=res.filter(itms => itms.responder=="AWeber");
          return res;
        }
     res = res.filter(itms => itms.responder==this.node.payment_type)
     return res;
    },
    ccurrency(){
      if(!this.node.currency)
        return false
      let c = this.node.currency
      if(typeof c === 'string')
        c = JSON.parse(c)
        return c

    },
    btns(){  
      if(this.node.type == 'Multiple Choices' || this.node.type == 'start')    
          return this.node.nodes
      else
        return [this.node.nodes[0]]
        // return this.node.nodes.filter(function (e) {
        //     return e.type == 'ButtonComponent';
        // });
    },
    nodeStyle() {
      return {
        top: this.options.centerY + this.y * this.options.scale + 'px', // remove: this.options.offsetTop + 
        left: this.options.centerX + this.x * this.options.scale + 'px', // remove: this.options.offsetLeft + 
        transform: `scale(${this.options.scale})`,
      }
    }
  },
  methods: {
        ...mapActions([ "TrimFunnelVideo","GetAllbyIntegration"]),
     async AutoresponderSelect(value){
        //  value = value.toLowerCase();
         this.node.id_list_contact_integration=-1
         let res = await  this.GetAllbyIntegration(value);
         this.listContactIntegration=res.data;
      },
    async FunnelEmbedDesktopReload_(){
      this.FunnelEmbedDesktopReload = false
      this.$nextTick(() => {
        this.FunnelEmbedDesktopReload = true
      });
    },
    async trime_video(){
      let data = {
        id:this.node.id,
        from:this.value1[0],
        to:this.value1[1],
      }
      this.$vs.loading({type:"sound"}) 
      let res = await this.TrimFunnelVideo(data)             
      this.$vs.loading.close()

    },
    async trashBtnNode(node){
      node.goto_id = 0
      this.$parent.trashBtnNode(node)
    },
    editVideoPopup(){
      if(this.node.type != "start")
        this.editVideo=true
    },
    handleMousedown(e) {
      const target = e.target || e.srcElement;
      // console.log(target);
      if (target.className.indexOf('node-input') < 0 && target.className.indexOf('node-output') < 0) {
        this.$emit('nodeSelected', e);
      }
      e.preventDefault();
    },
    handleMouseOver() {
      this.show.delete = true;
    },
    handleMouseLeave() {
      this.show.delete = false;
    },
    outputMouseDown(e,i, btn) {
      this.$emit('linkingStart',this.node.id, i, btn)
      e.preventDefault();
    },
    outputMouseDownStartScreen(e,i, btn) {
      this.$emit('linkingStart',this.node.id, 0, btn)
      e.preventDefault();
    },
    inputMouseDown(e) {
      e.preventDefault();
    },
    inputMouseUp(e) {
      this.$emit('linkingStop', this.node.id, this.node)
      e.preventDefault();
    },
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
$themeColor: rgb(255, 136, 85);
$portSize: 12;

.flowchart-node {
  margin: 0;
  width: 150px;
  // height: 120px;
  position: absolute;
  box-sizing: border-box;
  border: none;
  background: transparent;
  z-index: 1;
  opacity: .9;
  cursor: move;
  transform-origin: top left;  
  border: 0px solid var(--vblack);
  border-radius: 8px;
  .node-main {
    text-align: center;
    // padding:5px;    
    // height: 60px;
    // margin-bottom: 5px; 
       
    border-bottom: 1px solid #00000045;
    display: block;
    width: 100%;
    background-repeat: no-repeat !important  ;
    background-size: 100% 100% !important;
    height: 120px;
    position: relative;
    // border-radius: 6px;
    // border-top-right-radius: 6px;
        border: 2px solid black;
    border-radius: 0px;
    .node-type {
      background: var(--vblack);
      color: white;
      font-size: 13px;
      padding: 6px;
    }
    .node-label {
      font-size: 13px;
      max-height: 41px;
      width: 100%;
      overflow: hidden;      
      text-align: center;
      position: absolute;
    color: black;
    bottom: 3px;
    width: 100%;
    text-align: left;
    padding-left: 10px;
    overflow: hidden;
    height: 19px;
    }
  }
  .node-port {
    position: absolute;
    width: #{$portSize}px;
    height: #{$portSize}px;
    left: 50%;
    transform: translate(-50%);
    border: 1px solid #ccc;
    border-radius: 100px;
    background: white;    
    z-index: 9;
    &:hover {
      background: var(--vblack);
      border: 1px solid var(--vblack);
    }
  }
  .node-input {
    top: #{-2+$portSize/-2}px;
    top: 40px;
    left: 0% !important;    
    border: 2px solid #fff;
    border-radius: 50%;
    background: black;
    width: 20px;
    height: 20px;
  }
  .node-output {
    bottom: #{-2+$portSize/-2}px;
    bottom: 6px;
    left: 100% !important;
    display: inline-flex !important;
    height: 15px;
    width: 15px;
    border: 0px;
    .el{

    }
  }
  // .node-delete {
  //   position: absolute;
  //   right: 10px;
  //   top: -15px;
  //   font-size: 12px;
  //   width: 12px;
  //   height: 12px;
  //   color: var(--vprimary);
  //   cursor: pointer;
  //   // background: white;
  //   // border: 1px solid var(--vprimary);
  //   border-radius: 100px;
  //   text-align: center;
  //   font-size: 31px;
  //   &:hover{
  //     // background: var(--vprimary);
  //     color: var(--vprimary);
  //   }
  // }
}
.selected {
  // box-shadow: 0 0 0 2px var(--vprimary);
}
.flow-image{
  position: relative;
  width: 100%;
  height: 95px;
  margin: 0px;
  padding: 0px;
  // border-radius: 8px;
}
.node-actions{
  height: 30px;
  margin: 0px;
  padding: 0px;
  text-align: center;
  i{
    padding: 3px;
    background: var(--vprimary);
    border:1px solid var(--vprimary);
    color: #fff;
    border-radius: 4px;
    margin-right: 8px;
    &:hover{      
    background: transparent;
    color: var(--vprimary);
    cursor: pointer;

    }
  }
}
.nodeElement{
  // padding: 5px;
  // padding-right: 10px;
  // padding-left: 10px;
    position: relative;
  .elemBTN{
      display: block;
      width: 100%;
      position: relative;
      // border-bottom: 1px solid #000000c7;
          padding: 2px 0px;
      button{        
        position: relative;
        min-height: 25px;
        font-size: 15px !important;
        background: var(--vblack) !important;

      }
  }
}
.trashNode{
    position: absolute;
    right: 10px;
    top: 2px;
    color: #fff;
    padding: 3px;
    text-shadow: 0 0 3px black;    
    z-index: 99999999;
    cursor: pointer;
}

</style>
<style lang="scss">
.videoPopupEdit {
  .vs-popup{
    margin: 0px !important;
    max-width: calc(100%) !important;
    max-height: calc(100%) !important;
    border-radius: 0px !important;
    background: rgb(58 55 88 / 58%) !important;;
  }
  .vs-popup--title, .vs-popup--close{
    display: none !important;
  }
  .vs-popup--background{
    background: transparent !important;
  }
  .__div{
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0px;
    left: 0px;
    float: left;
  }
  .leftm{
    width: calc(100vw - 360px);
    float: left;
    height: 100vh;
    padding: 15px;    
    display: flex;
    align-items: center;
    .videoPreview{
      height: 400px;
      width: 80%;
      text-align: center;
      position: relative;
      
      margin: 0 auto;
      position: relative;
      
      background: url(/images/preview-desktop.png);
      background-repeat: no-repeat;
      background-size: 100% 90%;
      padding-top: 24px;
      transform: scale(0.8);
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;

    }
    .bodyVideoPreview{
      height: 100%;
      position: relative;
      margin: 0 auto;
      overflow: hidden;
      background: url('/images/preview-desktop.png');
      background-repeat: no-repeat;
      background-size: 100% 90%;
      display: inline-block;   
      padding-top: 17px;
      video{        
        position: relative;
        height: 100%;
        left: 0px;
      }
     
    }
  }
  .rightm{
    width: 360px;
    background: #fff;
    height: 100vh;
    float: left;
    padding: 15px;
    position: relative;
    .btmBtnSave{
      position: absolute;
      bottom: 0px;
      left: 0px;
      height: 50px;
      width: 100%;
      background: black;
      text-align: center;
      line-height: 50px;
      color: #fff;
      font-size: 18px;
      cursor: pointer;
      &:hover{
        color: var(--vprimary);
      }
      
    }
    .act{
      float: right;
      color: black;
      padding-right: 5px;
      padding-top: 5px;      
      width: 100%;
      text-align: right;
      svg{        
        height: 20px;
        &:hover{
          height: 22px;
        }
      }
    }
  }
}
.listAnswer{
  position: relative;  
  display: inline-block;
  width: 100%;
  line-height: 34px;
  &.currency{
    .currency_{      
      float: right;
      margin-right: 5px;
      font-size: 21px;      
    }
    select{
        width: 80px;
        float: right;
        background: #eaeaea !important;
        border: 1px solid #eaeaea !important;
    }
    input{      
        width: 80px;
        float: right;
        background: #eaeaea !important;
        border: 1px solid #eaeaea !important;
    }

  }

  textarea{
      width: calc(100% );
      float: left;
      background: #7d00fe0d;
      border: 0px;      
      border-radius: 6px;
      height: 40px;
      padding-right: 20px;
      resize: none;
      margin-bottom: 15px;
       &:hover, &:focus{
        border: 2px solid var(--vprimary);
      }
      }
  li{
    height: 40px;
    position: relative;    
    margin-bottom: 10px;
    input{
      width: calc(100% - 30px);
      float: left;
      background: #7d00fe0d;
      border: 0px;      
      border-radius: 6px;
      height: 40px;
      padding-right: 20px;
      &.ex{
        width: 100%;
        background: #eaeaea;
      }
      &:hover, &:focus{
        border: 2px solid var(--vprimary);
      }
    }
    .menu{
      float: right;
      height: 34px;
      width: 30px;
      text-align: center;
      line-height: 34px;
      font-size: 22px;
      opacity: 0.6;
    }
    .minus{
      position: absolute;
      right: 40px;
      top: 11px;
      background: #fff;
      color: black;
      border-radius: 50%;
      padding: 3px;
      box-shadow: 0 0 2px #00000040;
      cursor: pointer;
      &:hover{
        background: black;
        color: #fff;
      }
    }
  }
}
.addChoice{  
    margin-top: 15px;
    cursor: pointer;
    .plus{      
      background: #7d00fe0d;
      border-radius: 50%;      
      padding: 5px;
      color: black;
      font-weight: bold;
    }
    &:hover{
      .plus{
          background: black;
          color: #fff;
      }
    }
}
.num{
      position: absolute;
    left: 8px;
    background: var(--vprimary);
    display: inline-block;
    height: 30px;
    width: 30px;
    border-radius: 50%;
    color: #fff;
    line-height: 27px;
    top: 5px;
    display: none;
}
.startScreen{
    min-height: 130px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: black;
    background: #fff;
    border-radius: 6px;
    border: 1px solid black;
    i{
      font-size: 40px;
    }
}
.startScreenElm{
  border: 0px !important;
  .node-output{
    top: -75px !important;
    border: 2px solid #fff !important;
    height: 20px !important;
    width: 20px !important;
  }
}
.videoTabTool{
  margin-top: 30px;
  position: relative;
  img{
    width: 100%;
    border-radius: 10px;
  }
  .videoTabTool--footer{
    position: absolute;
    bottom: 6px;
    height: 40px;
    width: 100%;
    text-align: right;
    padding: 10px;
    span, a{      
      background: #fff;
      padding: 5px 15px;
      border-radius: 30px;
      margin: 0px 0px;
      cursor: pointer;
    }
    
  }
}
.selectList{
  width: 100%;
  background-color: #eaeaea;
  height: 45px;
  border: 0px solid #eaeaea;
  padding-left: 15px;
    font-size: 16px;
    font-weight: 600;
  option{
    height: 30px;
  }
}
</style>
