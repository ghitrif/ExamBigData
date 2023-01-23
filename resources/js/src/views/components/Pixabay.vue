<template>
    <vs-row class="pixa_images" style="margin:0px">
        <vs-col
          vs-w="12" style="height: 70px;">
        <div class="form-group" style="margin-top:15px;">    
            <input type="text" class="form-control inputSerach" placeholder="Search by keywords" 
                    v-model="queryImagesPixa" @change="searchImagesPixa">
        </div>
        </vs-col>
        <vs-col
          vs-w="12">
        <vs-row style="overflow: auto; height: 100%;max-height:500px;;">
            <vs-col
          vs-w="6" style="padding-right: 5px; padding-left: 5px">
              <li v-for="(image, i) in pixa_images" :key="i" v-if="i % 2 == 0">
                <img
                  draggable data="startDrag_image"
                  @dragstart="
                    startDrag_image($event, {
                      src: image.webformatURL,
                      type: 'image',
                    })
                  "
                  :src="image.webformatURL"
                />
              </li>
            </vs-col>
            <vs-col
          vs-w="6" style="padding-right: 5px; padding-left: 5px">
              <li v-for="(image, i) in pixa_images" :key="i" v-if="i % 2 != 0">
                <img
                  draggable
                  @dragstart="
                    startDrag_image($event, {
                      src: image.webformatURL,
                      type: 'image',
                    })
                  "
                  :src="image.webformatURL"
                />
              </li>
            </vs-col>
        
        </vs-row>   
        </vs-col>
    </vs-row>
</template>


<script>

import axios from 'axios';

export default {
  props: ['select'],
  data() {
    return {
        queryImagesPixa:"Business",
        pixa_images:[],
        pixa_loading:false,
        apiUrl: 'https://pixabay.com/api',
        apiKey: '8653965-67fc8570b61c58e735d9adade',
    }
  },components: {
  },
  methods: {
    select_image(evt, img){
        this.$emit('select', img)
    },
    async searchImagesPixa(){
        if(this.$store.getters.role < 2){
            this.$emit('show_upgrade_popup')
            return false
        }

       
        this.pixa_images       = [];
        this.pixa_loading  = true;
        var searchQuery = encodeURIComponent(this.queryImagesPixa); 
        const res =  await fetch(`${this.apiUrl}/?key=${this.apiKey}&q=${searchQuery}&per_page=200&safesearch=true`, {});
        const data = await res.json();
         if (data.total != 0) {
            this.pixa_images      = data.hits
          } 
    

    },
  },

    mounted() {
        this.searchImagesPixa()
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>

<style lang="scss" scoped>
.pixa_images{
    .inputSerach{
        width: 200px;
        float: right;
    }
    li{
        list-style: none;
        padding: 0px;
        margin:0px;
         img{
                position: relative;
                width: 100%;
                border-radius: 6px;
                cursor: pointer;
            }
        
    }
    .pixa_preview{
        div{
            // padding: 10px;
            margin-bottom: 15px;
            img{
                position: relative;
                width: 100%;
                border-radius: 6px;
                cursor: pointer;
            }
        }
    }
}
  
</style>