<template>
  <div class="ShareComp" :style="style">
       <facebook
            v-if="b.facebook"
            :url="b.facebook"
            scale="3"
        ></facebook>
        <Twitter  :url="b.twitter" scale="3"></Twitter>
        <Telegram
            :url="b.telegram"
            scale="3"
        ></Telegram>
        <whats-app
            :url="b.whatsapp"
            scale="3"
        ></whats-app>
        <pinterest
            :url="b.pinterest"
            scale="3"
        ></pinterest>
        <reddit :url="b.reddit" scale="3"></reddit>
              
  </div>
</template>


<script>
import {
  Facebook,
  Twitter,
  Reddit,
  LinkedIn,
  WhatsApp,
  Telegram,
  Pinterest,
} from "vue-socialmedia-share";

export default {
  name: "Share",
  props: ["settings"],
  data() {
    return {
      
    };
  },
  components: {
    Facebook,
    Twitter,
    Reddit,
    LinkedIn,
    WhatsApp,
    Telegram,
    Pinterest,
  },
  computed: {
      position: function(){
        return {
            x: this.settings.x,
            y: this.settings.y,
        }
      },
      b(){
          if(typeof(this.settings.settings) == 'string' ){
              if(this.settings.settings == "")
                return {
                        facebook:"",
                        telegram:"",
                        whatsapp:"",
                        pinterest:"",
                        reddit:""
                        }
              return JSON.parse(this.settings.settings)
          }
          return this.settings.settings
      },
      style:function(){
        let style = {
          backgroundImage: (this.settings.bgType == 'gradient')?"-webkit-linear-gradient(180deg, "+ this.settings.background +" "+ this.stop[0] +"%, "+ this.settings.backgroundSecondary +" "+ this.stop[1] +"%)":"",
          backgroundColor: this.settings.background,
          borderWidth: this.settings.borderSize +"px",
          borderStyle: this.settings.borderStyle,
          borderColor: this.settings.borderColor,
          borderRadius: this.settings.radius +"px",          
          opacity: this.settings.opacity,
          color: this.settings.color,
          fontFamily: this.settings.fontFamily,
          letterSpacing: this.settings.letterSpacing+"px",
          fontSize: this.settings.fontSize+"px",
          fontStyle: this.settings.fontStyle,
          fontWeight: this.settings.textStyle,
          textAlign: this.settings.textAlign,
          textTranforme: this.settings.textTranforme,
          textDecoration: this.settings.textDecoration,
          cursor: this.settings.cursor,
          padding:this.settings.padding
        }
        return style
      }
  },
  methods: {},

  mounted() {},
};
</script>
<style lang="scss" scoped>
.ShareComp{
    position:relative;
    width:100%;
    height:100%;   
    img{
        position:relative;
        width:100%;
        height:100%;  

    } 
    span{
        margin: 10px;
    }
}
</style>