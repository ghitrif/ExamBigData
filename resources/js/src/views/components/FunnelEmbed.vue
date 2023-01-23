<template>
    <Vpopup class="sharePopup"  title="" :active.sync="embedPopup" @close="close">
          <div class="row" style="padding:0px; margin:0 auto; width:400px ;font-weight: bold;" v-if="viewport">
              <div class="col-12 form-group" style="position:relative; margin-top: 15px;">
                  <div class="mb-3">Embed Code </div>
                  <div style="position: relative;">
                    <textarea  class="ttarea" id="embed_code" @click="copyText('embed_code')" >{{ embed_code }}</textarea>
                    <span class="actions" style="font-weight: normal;" @click="copyText('embed_code')"><i class="el copy" style="position: relative;font-weight: normal;font-size:15px"></i> Copy Code
    </span>
                </div>
              </div>              
               <hr style="width:100%; border: 0px; border-bottom: 1px solid#0000000f;" />         
          </div>      
       </Vpopup>
</template>



<script>

import Vpopup from "./vpopup/vpopup.vue"
export default {
  props: ['active', 'funnel', 'f', "embedPopup", 'video_'],
  data() {
    return {
    }
  },components: {
      Vpopup,
  },
  computed:{
    embed_code(){
      if(!this.viewport)
        return false
      return '\<script\>\n'
        +'(function(doc, id){\n'        
        +'var e = document.getElementById(id);\n'
        +'var i = '+ this.viewport.width / this.viewport.height +';\n'
        +' e.setAttribute("height", (e.clientWidth/i));\n'
        +'  }(document, "'+ this.funnel.uid +'"));\n'
        +'\<\/script\>\n'
        +'<iframe width="100%" src="'+ this.url +'" id="'+ this.funnel.uid +'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
    },
    url(){
     return location.protocol +"//" +window.location.hostname +'/Funnel/Embed/'+ this.funnel.uid
    },
    viewport(){
      if( this.funnel.hasOwnProperty('Videos') ){
        if(this.funnel.Videos.nodes.length)
          return JSON.parse(this.funnel.Videos.nodes[0].viewport)
        else
          return false
      }      
      else if( this.funnel.videos.length )
          return JSON.parse(this.funnel.videos[0].viewport)

      return false
     
    }
  },
  methods: {
      close(){
          this.$emit("close")
      },
      
    copyText(id) {
      var copyText = document.getElementById(id)
      copyText.select()
      copyText.setSelectionRange(0, 99999); 
      document.execCommand("copy")            
      this.$vs.notify({title:'Success',text:'Successfully copied to clipboard',color:'success'})
      copyText.setSelectionRange(0, 0); 
    },
   
  },

    mounted() {
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>

<style lang="scss" scoped>
.ttarea{
    height: 234px;
    width: 100%;    
    opacity: .7;
    padding: 10px;    
}
</style>