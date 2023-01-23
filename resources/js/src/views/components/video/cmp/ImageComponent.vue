<template>
  <img :style="style" class="ImageComponent" :src="image">
  <!-- <span>{{this.$url+image}}</span> -->
</template>


<script>
export default {
  name: "ImageComponent",
  props: ["settings", "editor"],
  data() {
    return {
      
    };
  },
  components: {},
  computed: {
    image(){
      if(typeof this.settings.media  == 'string')
                return JSON.parse(this.settings.media).path
      return this.settings.media.path
    },
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
          borderRadius: this.settings.borderRadius +"%",          
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
.ImageComponent{
    position:relative;
    width:100%;
    height:100%;    
}
</style>