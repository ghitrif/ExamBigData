<template>
    <div class="tab_settings ChapterSettings">
        <span class="title">Chapters Settings</span>
        
        <li>
            <label>Enable</label>
            <vs-switch v-model="video.enableChapter"/>
        </li>  
        <li v-if="video.enableChapter">
            <div class="mb-3">Text color</div>            
            <colorInput v-model="video.chaptersColor"></colorInput>
            
            <div class="mb-3">Background color</div>            
            <colorInput v-model="video.chaptersBgColor"></colorInput> 
        </li>             
       
       <template v-if="video.enableChapter">
            <li v-for="(chapter, i) in video.chapters" :key="i">  
                <div class=" form-group" style="position:relative; padding-right: 40px;">
                    <input v-model="chapter.description" type="text" class="form-control" placeholder="Description">
                    <span class="el trash" @click="trash(chapter, i)"></span>
                </div>
                <div class="mt-2">
                    <span style="font-size: 13px;">Time({{chapter.time}}s)</span>
                    <vue-slider :min="0" :max="video.duration" style="margin-buttom:10px;padding:10px" v-model="chapter.time" />
                </div>
            </li>
        <div class="mt-3" >
            <div class="newChapter" @click="add_new"><span class="el plus"></span> Add New Chapter</div>
        </div>        
       </template>
    </div>
</template>
<script>

import { mapGetters, mapActions } from "vuex";
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'
export default {
  props: ['video'],
  data() {
    return {
        time:0
    };
  },
  components: {
      VueSlider
  },
  computed: {},
  methods: {
    ...mapActions([ "addChapter", "deleteChapter"]), 
      async trash(chapter, i){
          let res = await this.deleteChapter(chapter.id)
          this.video.chapters.splice(i,1)
          this.$vs.notify({title:'Success',text:'Chapter deleted successfully',color:'success'})
      },
      async add_new(){
          let res = await this.addChapter({description:"Description", time:0, video_id: this.video.id})
          this.video.chapters.push(res.data)          
          this.$vs.notify({title:'Success',text:'Chapter added successfully',color:'success'})
      }
  },
  async mounted() {
  },
};
</script>
<style lang="scss" scoped>
.ChapterSettings{
    .newChapter{
        border: 1px dashed;
        padding: 10px;cursor:pointer;
        cursor: pointer;
        color: var(--vprimary);
        .plus {
            background: var(--vprimary);
            padding: 5px;
            color: #fff;
            border-radius: 50%;
            margin-right: 3px;
        }

    }
    .trash{
        background: #f90303a6;
        color: #fff;
        padding: 9px;
        border-radius: 5px;
        position: absolute;
        right: 0px;
        top: 0px;
        cursor: pointer;
    }
    
}
</style>