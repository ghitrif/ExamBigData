<template >
  <transition name="popup-t">
    <div
      v-show="active"
      ref="con"
      :class="[`vs-popup-${color}`,{'fullscreen':fullscreen}]"
      class="vs-component con-vs-popup"
      @click="close($event,true)">
      <div
        :style="styleCon"
        class="vs-popup--background"/>
      <div
        ref="popupx"
        :style="stylePopup"
        class="vs-popup"
        style="position:relative"
        >

        <!-- //header -->
          <div class="vs-popup--title" v-if="title">
            <h3>{{ title }}</h3>
            <slot name="subtitle" />
          </div>
          <i class="el x ic-clear close closePopop"
          v-if="!buttonCloseHidden"
            ref="btnclose"
            :style="stylePopup"
            @click="close"></i>
          

        <!-- // slots  -->
        <div
          :style="styleContent"
          :class="classContent"
          class="vs-popup--content">
          <slot/>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import { Cursor } from '@amcharts/amcharts4/.internal/charts/cursors/Cursor'
import _color from '../utils/color.js'
export default {
  name:'VsPopup',
  props:{
    color:{
      default:'primary',
      type:String
    },
    active: {
      default:false,
      type: Boolean
    },
    title:{
      default:'popup',
      type:String
    },
    buttonCloseHidden:{
      default:false,
      type:Boolean
    },
    fullscreen:{
      default:false,
      type:Boolean
    },
    backgroundColor:{
      default:null,
      type:String
    },
    backgroundColorPopup:{
      default:'rgb(255,255,255)',
      type:String
    },
    styleContent:{
      default:null,
      type: String
    },
    classContent:{
      default:null,
      type: String
    },
    iconPack:{
      default:'material-icons',
      type:String
    },
    iconClose:{
      default:'close',
      type:String
    },
  },
  computed:{
    styleHeader(){
      return {
        color: _color.getColor(this.color,1),
      }
    },
    styleAfter(){
      return {
        background: _color.getColor(this.color,1)
      }
    },
    styleCon(){
      return {
        background: _color.getColor(this.backgroundColor,1)
      }
    },
    stylePopup(){
      return {
        background: _color.getColor(this.backgroundColorPopup,1),
        Cursor:"pointer"
      }
    }
  },
  mounted(){
    this.insertBody()
  },
  beforeDestroy() {
    // close the left open prompt
    let elx = this.$refs.con
    if (document.body) {
      document.body.removeChild(elx)
    }
  },
  methods:{
    giveColor(color){
      return _color.rColor(color)
    },
    close(event,con){
      if(con){
        if(event.target.className
            && event.target.className.indexOf
            && event.target.className.indexOf('vs-popup--background')!=-1){
          this.$emit('update:active',false)
          this.$emit('close', false)
        } else {
          this.$emit('update:active',false)
          this.$emit('close', false)
        }
      }
    },
    insertBody(){
      let elx = this.$refs.con
      document.body.insertBefore(elx, document.body.firstChild)
    },
  }
}
</script>
<style lang="scss" scoped>
.con-vs-popup{
  .closePopop{
      position: absolute;
      top: 10px;
      right: 10px;
  }
  .copy{
      position: absolute;
      width: 44px;
      height: 38px;
      right: 0px;
      /* top: 0px; */
      background: var(--primary);;
      bottom: 0px;
      color: #fff;
      font-size: 23px;
      padding: 5px;
      text-align: center;
      cursor: pointer;
      z-index: 2;
  }
  .hidecopy{
    position: absolute;
      width: calc(100%);
      height: 33px;
      left: 0px;
      background: #7367f000;
      color: var(--primary);
      bottom: 0px;
      font-size: 23px;
      padding: 5px;
      text-align: left;
      cursor: pointer;
      z-index: 1;

  }
  .fa-clone_{
          position: absolute;
          right: 0px;
          bottom: 0px;
          background: var(--vprimary);
          font-size: 23px;
          padding: 5px;
          color: #fff;
          z-index: 11;
          cursor: pointer;
      }

  .popup {
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: 99999999999;
    background: #646161ad;
    top: 0px;
    left: 0px;
    .body {
      width: 50%;
      min-height: 400px;
      margin: 0 auto;
      background: white;
      margin-top: 82px;
      // background-image: linear-gradient(var(--primary) -42%, white 57%);
      padding: 50px;
      position: relative;
      .title {
        text-align: center;
        display: inline-block;
        width: 100%;
      }
      .close {
        position: absolute;
        right: 20px;
        top: 20px;
        cursor: pointer;
      }
      
    }
  }
  .zoom {
    transition: transform 0.2s;
  }

  .zoom:hover {
    transform: scale(1.04);
  }
  .shre span{
      margin-right: 10px;
  }

  
}


</style>