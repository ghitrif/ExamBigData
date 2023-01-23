<template>
  <div  class="VideoComponent">
      <div class="mask" v-if="!embed"></div>
      <iframe :src="'https://www.youtube.com/embed/'+ settings.settings.id " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</template>


<script>
export default {
  name: "YoutubeComponent",
  props: ["settings", "embed"],
  data() {
    return {
      
    };
  },
  components: {},
  computed: {
    position: function(){
        return {
            x: this.settings.x,
            y: this.settings.y,
        }
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
.VideoComponent{
    iframe{  
        position:relative;
        width:100%;
        height:100%; 
        
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0px;
    top: 0px;

    }   
    .mask{
        position: absolute;
        width:100%;
        height:100%;
        
    left: 0px;
    top: 0px;
    z-index: 1;
    }
}
</style>