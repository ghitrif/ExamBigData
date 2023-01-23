<template>
  <span class="BlockTitle" :style="style">{{ settings.content }}</span>
</template>


<script>
export default {
  name: "BlockTitle",
  props: ["settings", "editor"],
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
          textAlign: this.settings.textAlign,
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
.BlockTitle{
    position:relative;
    width:100%;
    height:100%;     
    display: block;   
}
</style>