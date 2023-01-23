<template>
    <div class="row pxxx" style="margin:0px">
        <div class="col-md-12" style="height: 70px;">
        <div class="form-group" style="margin-top:15px;">    
            <input type="text" class="form-control serach" placeholder="Search by keywords" 
                    v-model="queryImagesPixa" @change="searchImagesPixa">
        </div>
        </div>
        <div class="col-md-12">
        <vs-row style="overflow: auto; height: 100%;max-height:500px;;">
               
                <vs-col vs-w="4" class=" preview_"  >
                    <div v-for="(img,i) in pixa_images" :key="i" v-if="i % 3 == 0">
                        <div class="img" @click="select_image($event, img)">
                            <img :src="img.previewURL">
                        </div>
                    </div>
                </vs-col >
                <vs-col vs-w="4" class=" preview_"  >
                    <div v-for="(img,i) in pixa_images" :key="i" v-if="i % 1 == 0">
                        <div class="img" @click="select_image($event, img)">
                            <img :src="img.previewURL">
                        </div>
                    </div>
                </vs-col >
                <vs-col vs-w="4" class=" preview_"  >
                    <div v-for="(img,i) in pixa_images" :key="i" v-if="i % 2 == 0">
                        <div class="img" @click="select_image($event, img)">
                            <img :src="img.previewURL">
                        </div>
                    </div>
                </vs-col >
        </vs-row>
        </div>
    </div>
</template>


<script>

import axios from 'axios';

export default {
  props: ['value'],
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
    select_image(evt, media){
        this.$emit('select', media)
    },
    async searchImagesPixa(){       
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
.pxxx{
    .serach{
        width: 200px;
        float: right;
    }
    .preview_{
        div{
            // margin-bottom: 15px;
            .img{
                display: block;
                padding: 5px;
                img{
                    position: relative;
                    width: 100%;
                    // border-radius: 6px;
                    cursor: pointer;
                }
            }
            
        }
    }
}
  
</style>