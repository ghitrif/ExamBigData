<template>
    <img style="height: 40px;" :src="'/images/icons/'+image.image" :alt="image.title">
</template>
<script>
export default {
  name: "FileIcon",
  props: ["ext"],
  data() {
    return {
      
    };
  },
  components: {
  },
  computed: {
      image: function(){
        
        let exts = {
                    mov:{
                        image:"video.png",
                        title:"Video"
                    },
                    wmv:{
                        image:"video.png",
                        title:"Video"
                    },
                    flv:{
                        image:"video.png",
                        title:"Video"
                    },
                    avi:{
                        image:"video.png",
                        title:"Video"
                    },
                    webm:{
                        image:"video.png",
                        title:"Video"
                    },
                    mp3:{
                        image:"audio.png",
                        title:"Audio"
                    },
                    doc:{
                        image:"doc.png",
                        title:"Document"
                    },
                    docx:{
                        image:"doc.png",
                        title:"Document"
                    },
                    xls:{
                        image:"sheet.png",
                        title:"Sheet"
                    },
                    xlsx:{
                        image:"sheet.png",
                        title:"Sheet"
                    },
                    ppt:{
                        image:"presentation.png",
                        title:"Presentation"
                    },
                    pptx:{
                        image:"presentation.png",
                        title:"Presentation"
                    },
                    zip:{
                        image:"archive.png",
                        title:"Archive"
                    },
                    tar:{
                        image:"archive.png",
                        title:"Archive"
                    },
                    txt:{
                        image:"text.png",
                        title:"Text"
                    },
                    pdf:{
                        image:"pdf.png",
                        title:"PDF"
                    },
        }
        return exts[this.ext]


      },
  },
  methods: {},

  mounted() {},
};
</script>