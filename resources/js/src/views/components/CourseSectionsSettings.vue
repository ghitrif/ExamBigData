<template>
    <vs-row >
    <vs-col vs-w="12" v-if="loadSortable">
      <ul class="list-group" v-section="{ handle: '.handleSection', onUpdate:onUpdateSections }">
        <li
          class="list-group-item section_"
          v-for="(section, i) in course.sections"
          :key="i"
        >
          <div class="CjnpalV">
            <span class="sec_title">
              <i style="float:left; color: #0000005e;" class="el menu handleSection"></i>
              <i class="NoSection">{{i}}</i>
              <h5 style="float:left; margin-left:10px">{{ section.title }}</h5>
              <span style="float:left; margin-left:10px; " @click="rename_section=true;sc=section" class="el edit-2" title="Rename"></span>
              <!-- <span class="created_at" style="right: 91px;">Created at: {{section.created_at}}</span> -->
              <span @click="trash_section(section,i)" class="el trash-2" title="Delete Section"></span>              
              <span class="el chevron-down" v-collaps=""></span>  </span>
            <ul
              class="list-group less"
              v-lesson="{ handle: '.lessons_handle', onUpdate:(evnt)=>onUpdateLessons(evnt, section) }"
              
            >
            <template v-if="loadSortableLessions">
              <li
                class="list-group-item lesson_"
                v-for="(lesson, x) in section.lessons"
                :key="x"
                
              >
                <div class="CjnpalV">
                  <span class="sec_title subtitle">
                    <i style="float:left; color: #0000005e;" class="el menu lessons_handle"></i>
                    <img style="width:40px; border-radius: 4px;" :src="lesson.thumbnail">
                    <span style="float:left; margin-left:10px">{{lesson.name}}</span>                     
                    <span @click="rename_lesson=true;ls=lesson" style="float:left; margin-left:10px" class="el edit-2" title="Rename"></span>
                    <span @click="trash_lesson(section, lesson, x)" class="el trash-2" title="Delete Section"></span>
                    <span @click="$router.push('/Video/Editor/'+ lesson.uid)" class="openInEditor"><i class="el video-player3"></i> Player Settings</span>
                   <!-- <span class="created_at">Created at: {{section.created_at}}</span> -->
                  </span>
                </div>
              </li>
            </template>
            </ul>
            <div class="addSection" @click="add_new_lesson(section)">
              <i class="el plus"></i> Add New Lesson
            </div>
          </div>
        </li>
      </ul>
    </vs-col>
    <vs-col vs-w="12" class="pr-2" >
      <div class="add_new" @click="add_section_popup_" >       
        <i class="el plus"></i> Add New Section
      </div>
    </vs-col>

    <vs-popup class="holamundo"   :active.sync="rename_section">
        <form v-on:submit.prevent="onSubmitSection" >
          <vs-input required class="inputx" placeholder="Name" v-model="sc.title"/>
          <button style="margin: 0px;
      margin-right: 10px;
      height: 38px;" class="actions addFolder" type="submit"><i class="el edit-2"></i> Rename</button>
          
      </form>
    </vs-popup>
    <vs-popup class="holamundo"  :active.sync="rename_lesson">
        <form v-on:submit.prevent="onSubmitLesson" >
          <vs-input required class="inputx" placeholder="Name" v-model="ls.name"/>
          <button style="margin: 0px;
      margin-right: 10px;
      height: 38px;" class="actions addFolder" type="submit"><i class="el edit-2"></i> Rename</button>
          
      </form>
    </vs-popup>
    
    <vs-popup class="holamundo"  :title="'Add New Section'" :active.sync="add_section_popup">
        <vs-input required class="inputx" placeholder="Section Title" v-model="section.title"/>
        <span style="margin: 0px;
    margin-right: 10px;
    height: 38px;" @click="add_section" class="actions addFolder" ><i class="el plus"></i> Add</span>
    </vs-popup>
    <vs-popup class="holamundo"   :active.sync="add_lesson_popup">
      <template v-if="treeDisplayData !=false">
      
        <vs-input required class="inputx" placeholder="Lesson Title" v-model="lesson.name"/>
             <AppTree
                id="my-tree-id"
                ref="my-tree"
                :custom-options="myCustomOptions"
                :custom-styles="myCustomStyles"
                :nodes="treeDisplayData"
                />
        <span style="margin: 0px;
    margin-right: 10px;
    height: 38px;" @click="add_lesson_video()" :class="['actions addFolder', {btnDisabled:!selectedNodeVideo}]" ><i class="el plus"></i> Add</span>
      </template>
    </vs-popup>
    </vs-row>
</template>

<script>
import Vue from "vue";

import { mapGetters, mapActions } from "vuex";
import Sortable from "sortablejs";

import AppTree from "./tree/Tree";

export default {
  props: ["school", "course"],
  directives: {
    section: {
        inserted: function (el, binding) {
          new Sortable(el, binding.value || { handle: ".handle" });
        },
      },
    lesson:{
        inserted: function (el, binding) {
          new Sortable(el, binding.value || { handle: ".lessons_handle" });
        },
    },
    collaps: {
      bind(el, binding) {
        el.addEventListener("click", function (ev) {
          var parent = ev.target.parentNode.parentNode.parentNode;
          var less = parent.querySelector(".less");
          if (less.style.display != "block") {
            less.style.display = "block";
            less.classList.add("fade-in");
            less.classList.remove("fade-out");
          } else {
            less.classList.remove("fade-in");
            less.classList.add("fade-out");
            setTimeout(function () {
              less.style.display = "none";
            }, 300);
          }
        });
      },
    },
  },
  data: () => ({
    add_section_popup:false,
    loadSortable:true,
    loadSortableLessions:true,
    add_lesson_step : 0,
    rename_section:false,
    rename_lesson:false,
    add_lesson_popup:false,
    treeDisplayData:false,
    selectedNodeVideo:false,
    sc:{},
    ls:{},
    sections: [],
    section:{
        title:"",
        course_id:""
    },
    lesson:{
      type:"",
      name:"",
      duration:"",
      description:"",
      media:"",
      media_url:"",
      section_id:0,
      section:{}
    }
  }),
  components: { 
    AppTree
  },

  methods: {    
    ...mapActions(["loadMedia", "addSection", "addLesson", "deleteLesson", "deleteSection"]),
    onUpdateLessons(){

    },
    add_section_popup_(){
      this.add_section_popup=true
      this.section = {
              title:"",
              course_id:""
              }
    },
    async onSubmitSection(){
      this.$vs.loading({type:"sound"}) 
      let res = await this.addSection(this.sc)
      this.$vs.loading.close()
      this.sc = false
      this.rename_section = false
    },
    async onSubmitLesson(){
      this.$vs.loading({type:"sound"}) 
      let res = await this.addLesson(this.ls)
      this.$vs.loading.close()
      this.ls = false
      this.rename_lesson = false
    },
    async trash_section(section, i){
      let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
      if (!result.isConfirmed)
        return false
      this.$vs.loading({type:"sound"}) 
      let res = await this.deleteSection(section.id)
      this.$vs.loading.close()
      this.course.sections.splice(i,1)
    },
    async trash_lesson(section,lesson, i){
      let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
      if (!result.isConfirmed)
        return false
      this.$vs.loading({type:"sound"}) 
      let res = await this.deleteLesson(lesson.id)
      this.$vs.loading.close()
      section.lessons.splice(i,1)
    },
   async add_lesson_video(){
      if(!this.selectedNodeVideo)
        return false
      this.$vs.loading({type:"sound"}) 
      let res = await this.addLesson({
                type:"video",
                name: this.lesson.name,
                thumbnail: this.selectedNodeVideo.thumbnail,
                path: this.selectedNodeVideo.path,
                duration: this.selectedNodeVideo.duration,
                section_id:this.section.id,
              })
      this.$vs.loading.close()
      this.section.lessons.push(res.data)
      // this.section.title = ""
      this.lesson = {
                  type:"",
                  name:"",
                  duration:"",
                  description:"",
                  media:"",
                  media_url:"",
                  section_id:0,
                  section:{}
                }
      this.selectedNodeVideo = false
      this.add_lesson_popup = false
    },
    myCheckedFunction: function (nodeId, state) {
    },
    mySelectedFunction: function (nodeId, state) {
      let node = this.$refs["my-tree"].getSelectedNode()
      if(node.type == 'video')
        this.selectedNodeVideo =  node   
    },
    async add_new_lesson(section){
      this.section = section
      this.ls = false
      this.selectedNodeVideo = false
      this.add_lesson_popup = true
      if(this.treeDisplayData == false){
        this.$vs.loading({type:"sound"}) 
        let data = await this.loadMedia()
        this.$vs.loading.close()
        this.treeDisplayData = data.data
      }
      this.$refs["my-tree"].expandNode(1);
      
    },
    async add_section(){
      this.section.course_id = this.course.id
      this.$vs.loading({type:"sound"}) 
      let res = await this.addSection(this.section)
      this.$vs.loading.close()
      this.course.sections.push(res.data)
      this.section.title = ""
      this.add_section_popup = false
    },
    onUpdateSections(){

    }
  },
  computed: {
    
    myCustomStyles() {
      return {
        tree: {
          height: "auto",
          maxHeight: "300px",
          overflowY: "visible",
          display: "inline-block",
        },
        row: {
          width: "500px",
          cursor: "pointer",
          child: {
            height: "35px",
          },
        },
        text: {
          style: {},
          active: {
            style: {
              "font-weight": "bold",
              color: "#787878",
            },
          },
        },
      };
    },
    myCustomOptions() {
      return {
        treeEvents: {
          expanded: {
            state: false,
          },
          collapsed: {
            state: false,
          },
          selected: {
            state: true,
            fn: this.mySelectedFunction,
          },
          checked: {
            state: false,
            fn: this.myCheckedFunction,
          },
        },
        events: {
          expanded: {
            state: true,
          },
          selected: {
            state: true,
          },
          checked: {
            state: false,
          },
        },
        showTags: true,
      };
    },
  },

  mounted() {
    
  },
  created() {},
};
</script>

<style lang="scss" scoped>
.section_ {
    display: inline-block;
    width: 100%;
    margin-bottom: 5px;
    padding: 0px;
    background: #fff;
    .created_at{
      position: absolute;
      font-size: 11px;
      font-weight: normal;
      right: 76px;
      color: #7367f0c7;
    }
    .subtitle{
      .trash-2, .edit-2{
          display: none;
        }
        &:hover{
          .edit-2{
            display: inline-block;
          }
          .trash-2{
          position: absolute;
          right: 6px;
          color: red;        
          background: #ff000014;
          border-radius: 50%;
          padding: 6px;
          display: inline-block;
          }
        }

    }

    .CjnpalV{
      position: relative;
      padding-left: 10px !important;
      input{
        height: 18px;
        width: 18px;
        position: absolute;
        top: 9px;
        left: 0px;
        }    
        .openInEditor{
          position: absolute;
          right: 100px;
          display: inline-block;
          color: var(--vprimary);
          display: none;
          &:hover{
            text-decoration: underline;
          }
        } 
      }
    }
    .less {
      // display: none;
      padding-right: 15px;
      border-radius: 0px;
    }
    .lesson_ {
      border: 0px;
      &:first-child{
        border-top: 1px solid #cacaca61;
      }
      cursor: pointer;
      &.active{
        background: #00bcd414;
      }
      &:hover{
        background: #00bcd414;
      }
      
    }
  
    .sec_title {
      padding-left: 20px;
      padding-right: 15px;
      padding-top: 6px;
      text-transform: capitalize  ;
      color: black;
      height: 40px;
      display: flex;
      align-items: center;
      height: 47px;
      &:hover{        
        background: #7367f005;
        .openInEditor{
          display: inline-block;
        }
      }
      img{
        margin-left: 10px;
        margin-right: 10px;
      }
      span{        
        font-weight: 500;
      }
    
      &.sec_title1{
        padding: 20px 15px 20px 15px;
        // border-bottom: 1px solid #cacaca;
        border-radius: 0px;
        position: relative;
        color: black;
        text-transform: capitalize;
        margin-right: 12px;
        span{
          position: absolute;
          bottom: 5px;
          left: 15px;
          color: #00000087;
          font-size: 12px;
          font-weight: 500;
        }
      }
      .el{
        cursor: pointer;
      }
  
      .chevron-down {
        font-size: 20px;
        cursor: pointer;
        color: var(--primary2);
        position: absolute;
        right: 16px;
        background: #7367f029;
        border-radius: 50%;
        padding: 2px;
        color: var(--vprimary);
        &:hover{
          background: var(--vprimary);
          color: #fff;
        }
      }
      .edit-2{        
        cursor: pointer;
        color: var(--vprimary);
        background: #7367f029;
        border-radius: 50%;
        padding: 2px;
        color: var(--vprimary);        
        padding: 5px;        
        font-size: 11px;
        &:hover{
          background: var(--vprimary);
          color: #fff;
        }
      }
      .trash-2{
        position: absolute;
        right: 44px;
        color: red;        
        background: #ff000014;
        border-radius: 50%;
        padding: 6px;
      }
    }
  
</style>
<style lang="scss" scoped>
.add_new{
  line-height: 40px;
  border: 1px dashed #00000066;
  padding: 0px 15px;
  color: var(--vprimary);
  font-weight: 500;
  cursor: pointer;
  margin-top: 10px;
  i{
    padding: 5px;
    background: var(--vprimary);
    color: #fff;
    opacity: .7;
  }
}
.addSection{
   padding: 0px 15px;
  color: var(--vprimary);
  font-weight: 500;
  cursor: pointer;
  height: 30px;
  margin-top: 10px;
  
  i{
    padding: 5px;
    background: var(--vprimary);
    color: #fff;
    opacity: .7;
  }

}
.NoSection{
    float: left;
    display: inline-block;
    height: 22px;
    width: 22px;
    background: var(--vprimary);
    border-radius: 50%;
    text-align: center;
    line-height: 21px;
    color: #fff;
    opacity: 0.6;
    margin-left: 5px;
    font-size: 14px;
    display: none;
}
</style>