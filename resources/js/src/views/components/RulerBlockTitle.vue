<template>
<span :id="'draggable_node_'+index" >
    <i :class="icon"></i> <b>{{name}}</b>           
</span>       
</template>

<script>
export default {
  props: ['node', "index"],
  data() {
    return {
        icons: {'YoutubeComponent':{icon:'el youtube', name:"Youtube"},
                   "Share":{icon:'el share', name:"Social Share"},
                   "Map": {icon:'el map', name:"Map"},
                   "optin": {icon:'el mail-send', name:"Optin Form"},
                   "embedCode": {icon:'el code', name:"HTML Code"},
                   "BlockTitle": {icon:'el text-box', name:"Annotation"},
                   "ImageComponent": {icon:'el image', name:"Image"},
                   "ButtonComponent": {icon:'el buy-button', name:"Button"},
                   "Timer": {icon:'el stopwatch', name:"Timer"} }
    };
  },
  computed: {
      icon(){
          return this.icons[this.node.type].icon
      },      
      name(){
          return this.icons[this.node.type].name
      }
  },
  methods: {
  },
  async mounted() {
  },
};
</script>