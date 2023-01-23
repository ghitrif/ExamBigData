<template>
  <a :href="settings.url" 
    :class="['cbtna']"
    :style="style" v-if="type_url" target="blank_">
    {{ settings.content }}</a>

    <a :href="media.path" 
    :class="['cbtna']"
    :style="style" v-else-if="type_download" download target="blank_">
    {{ settings.content }}</a>
  <button
    v-else
    :class="['cbtn']"
    :style="style"
  >
    {{ settings.content }}
  </button>
</template>


<script>
export default {
  name: "gbutton",
  props: ["settings", "editor", "embed"],
  data() {
    return {
     
      
    };
  },
  components: {},
  computed: {
    media(){
      if(typeof this.settings.media == 'string' )
        return JSON.parse(this.settings.media)
      return this.settings.media
    },
    type_url(){
      return (this.settings.action == 'Open URL' && this.embed )
    },
    type_download(){
      return (this.settings.action == 'Download File' && this.embed) 
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
<style lang="scss" scoped >
.cbtn{
    position:relative;
    width:100%;
    height:100%;
    &:focus{
      outline: none;
    }
    
}
.cbtna{
   position:relative;
    width:100%;
    height:100%;
    display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: stretch;
    justify-content: space-evenly;
    &:focus{
      outline: none;
    }
}
</style>