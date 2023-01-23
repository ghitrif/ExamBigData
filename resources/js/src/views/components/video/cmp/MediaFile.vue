<template>
    <div class="MediaFile row" >
        <template v-if="media_">
            <span class="FileName">
                <img :src="media_.path" width="40px">
                <b>{{media_.name}}</b>
            </span>
            <span class="FileActions">
                <i class="el edit-2"  @click="popup=true"></i>
                <i class="el  trash" @click="trash2"></i>
            </span>
        </template>
        <template v-else>
            <div class="Choose" @click="popup=true"><b><i class="el plus"></i>Choose File</b></div>
        </template>



        <vs-popup class="holamundo"  title="Add New Folder" :active.sync="AddFolder">
            <form v-on:submit.prevent="CreateFolder_">
                <vs-input required class="inputx" placeholder="Folder Name" v-model="folder.name"/>
                <Submit style="float: right;" />
            </form>
        </vs-popup> 

        <vs-popup class="holamundo"  title="Rename" :active.sync="media_rename">
            <form v-on:submit.prevent="RenameMedia_" v-if="media_rename">
                <vs-input required class="inputx" placeholder="Folder Name" v-model="media.text"/>
                <Submit style="float: right;" />
            </form>
        </vs-popup>
        <vs-popup class="holamundo"  title="Choose Media" :active.sync="popup">
            <div style="min-height:400px">
                <div class="text-center">
                    <h4 style="font-size: 22px;">Choose Media</h4>
                    <p>Upload your media or choose from libraries</p>
                </div>
                <vs-tabs alignment="center">
                <vs-tab label="Uploads">
                    <!-- <div style="height:45px">
                        <input @change="UploadFile" type="file" ref="file" style="display: none" accept="image/*">
                        <span class="actions" @click="$refs.file.click()"><i class="el upload-cloud"></i> Upload new Image</span>
                        <vs-input v-model="keyword" style="max-width:300px; " icon="search" placeholder="Search" />
                    </div> -->
                    <main class="ui__main" v-if="medias">  
              <!-- <span  class="actions upOneLevel"><i class="el arrow-left"></i> One Level</span> -->
              <input @change="UploadFile" type="file" ref="file" style="display: none" >
              <span  class="mediaAction" style="float:left" @click="medias = medias0" ><i class="el corner-up-left"></i> Up Top Level</span>
              <span  class="mediaAction" @click="$refs.file.click()" ><i class="el upload-cloud"></i> Upload File</span>
              <span class="mediaAction" @click="addFolderPopup"><i class="el plus"></i>Add Folder</span>
            
            <table class="file-list file-table2" id="file-table">
                <tr class="file-list__header">
                    <th >Preview <i class="fa fa-long-arrow-down"></i></th>
                    <th width="100" >Type</th>
                    <th width="100" >Size</th>
                    <!-- <th width="150">Created at</th> -->
                    <th width="150">Actions</th>
                </tr>
            </table>
            <div class="emptyTable" v-if="!filtred_medias.nodes">
              <i class="el hard-drive"></i>
              <br>
              <h5>Empty folder</h5>
              <p>You have not uploaded any media</p>
            </div>
            
            <div v-else  style="height: calc(100vh - 250px);overflow: auto;
    overflow-x: hidden;width:100%">
            <table class="file-list" id="file-table">
                <tr class="file-list__file" v-for="(v,i) in filtred_medias.nodes" :key="i"> 
                    <td class="media_name" @click="setVideo(v)" >
                      <template v-if="v.id">
                        <img :src="v.thumbnail+'100.jpg'" v-if="v.type != 'folder' && v.type != 'file'" style="width:60px; height: 40px;" />
                        <i v-else-if="v.type == 'folder'" class="el folder2"></i>
                        <FileIcon v-else-if="v.type == 'file'" :ext="v.ext"></FileIcon>
                        <span>{{v.text}}</span>
                      </template>
                      <template v-else-if="!v.message">
                        <img style="width: 31px;" :src="loading">
                        {{v.progress}}%
                      </template>
                      <template v-else>
                          <img src="/images/warning.svg" style=" height: 31px;">
                          <span style="color:red; font-size: 11px;">{{v.message}}</span>
                      </template>
                      </td>
                    <td  width="100">
                        {{v.type}}
                    </td>
                    <td  width="100">
                        {{v.size}}
                    </td>
                    <!-- <td  width="150">{{v.created_at}}</td> -->
                    <td class="media_actions"  width="150" >               

                      
                       <template v-if="v.id">
                        <i @click="media=v;media_rename = true" class="el edit-3" title="Rename"></i>
                        <i @click="trash(v, i)" class="el trash-2" title="Delete"></i>

                        <a v-if="v.type == 'video'" :href="v.path" target="blank_">
                        <i  class="el download-cloud" title="Download"></i>
                        </a>
                        <!-- <span class="chooose" v-if="v.type != 'folder'" >Choose</span> -->
                      </template>
                      <template v-else-if="v.message">
                            <i @click="trash(v, i)" class="el trash-2" title="Delete"></i>
                      </template>
                    </td>
                </tr>
                
            </table>
            </div>
            
            <!-- /.file-list -->            
        </main>
                    
                </vs-tab>
                <!-- <vs-tab label="Youzign">
                    <div>

                    </div>
                </vs-tab> -->
                <vs-tab label="Stock Images">
                    <div>
                        <pixabay @select="select_pixa" />
                    </div>
                </vs-tab>
                <!-- <vs-tab label="Pixel">
                    <div>

                    </div>
                </vs-tab> -->
                </vs-tabs>            
            </div>
        </vs-popup>
           
        
        
    </div>
</template>



<script>
import axios from "axios"
import FileIcon from "./FileIcon.vue"
import pixabay from "./pixabay.vue"
// axios.defaults.headers.common['Authorization'] ="Bearer "+( localStorage.getItem('authorization') || '' );
let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
import { mapGetters, mapActions } from "vuex";
export default {
    name:"MediaFile",
    props:["value", 'type'],
    data() {
        return {
            media:false,
            media_rename:false,
            popup:false,
            medias:[],
            medias0:[],
            keyword:"",
            loading: "/images/Spinner-1s-331px.svg",
            AddFolder:false,            
            folder:{
                name:"",
                media_id:0
            },

        }
    },
    computed:{
        media_(){
            if(!this.value)
                return false
            if(typeof this.value  == 'string')
                return JSON.parse(this.value)
            //check json format or string
            return this.value            
        },
        filtred_medias(){
            let medias = this.medias
            let type = this.type
            if(type == 'all' || !type)
                return medias

            if(type && medias.nodes){
                medias.nodes = medias.nodes.filter(function (media) {
                            return (media.type == type ||  media.type == 'folder') ;
                        });


            }
              
            return medias
        }
    },
    methods:{
    ...mapActions(["loadImages", "deleteMedia", "loadMedia", "RenameMedia", "CreateFolder"]),
    async CreateFolder_(){
      this.folder.media_id = this.medias.id
      this.$vs.loading({type:"sound"})
      let res = await this.CreateFolder(this.folder)
      this.$vs.loading.close()
      this.medias.nodes.push(res.data)
      this.AddFolder = false
    },
    select_pixa(media){
        this.$emit('input', {path:media.webformatURL, name:'Image', type:'image', id:media.id, ext:'jpg', size:media.imageSize, from:"upload"});
        this.popup = false
    },    
    addFolderPopup(){
    //   if(!this.media.length){
         this.medias = this.medias0
    //   }      
      this.AddFolder = true
    },
    async RenameMedia_(){
      this.$vs.loading({type:"sound"})      
      let res = await this.RenameMedia(this.media)
      this.$vs.loading.close()
      this.media = false
      this.media_rename = false      
      this.$vs.notify({title:'Success',text:'Saved Successfully',color:'success'})

    },
    async setVideo(media){
        if(media.type == 'folder'){
            this.medias = media
            return false
        }
        this.$emit('input', {path:media.path, name:media.text, type:media.type, id:media.id, ext:media.ext, size:media.size, from:"upload"});
        this.popup = false
    },
    async trash2(){
            let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
            if (!result.isConfirmed)
                return false
            this.$emit('input', false);
        },
        async choose(media){
            if(media.type == 'folder')
                return false
            this.$emit('input', {path:media.path, name:media.text, type:media.type, id:media.id, ext:media.ext, size:media.size, from:"upload"});
            this.popup = false
        },
        async trash(media, i){
            let res = await this.deleteMedia(media)
            this.medias.nodes.splice(i,1)            
            this.$vs.notify({title:'Success',text:'Image Deleted Successfully',color:'success'})
        },    
        async UploadFile(){ 
            let formData = new FormData();     
            const file = this.$refs.file.files[0];
            formData.append("file", file);
            formData.append("media_id", this.medias.id);     
            let _this = this;
            this.medias.nodes.unshift({
                        id: 0,
                        media_id: 0,
                        nodes: [],
                        path: null,
                        root: 0,
                        text: "",
                        thumbnail: null,
                        type: "image",
                        message:false,
                        progress:0
            })
            let response = await axios.post("/media", formData, {
                onUploadProgress: function (progressEvent) {
                    _this.medias.nodes[0].progress = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) ); 
                }.bind(this),
                })
                if (response.data.status == 1) {
                    this.medias.nodes.splice(0,1)
                    this.medias.nodes.unshift(response.data.data)
                }
                else{
                     _this.medias.nodes[0].message = response.data.errors.file[0]
                }
            },
    },
    components: {    
        FileIcon  ,
        pixabay  
    },
    async mounted() {
        let data = await this.loadMedia()
        this.medias = data.data[0]
        this.medias0 = data.data[0]
    },

}

</script>
<style lang="scss" scoped>
.MediaFile{
    position: relative;
    padding: 10px;
    border: 1px solid #cac1c1;
    border-radius: 5px;
    &:hover{        
        border-color: var(--vprimary);
    }
    .FileName{
        overflow: hidden;
        display: block;
        width: 100%;
        min-height: 30px;
        padding-right: 50px;
        line-height: 30px;
        img{
            float: left;
        }
        b{
            float: left;
            margin-left: 10px;max-width: 133px;
            overflow: hidden;
            height: 30px;
            font-size: 11px;
            font-weight: 400;
        }
    }
    .Choose{
        text-align: center;
        cursor: pointer;
        &:hover{            
            color: var(--vprimary);
        }
    }
    .FileActions{
        position: absolute;        
        right: 2px;
        top: 15px;
        i{            
            padding: 5px;
            background: var(--vprimary);
            color: #fff;
            border-radius: 5px;
            margin-right: 5px;
            cursor: pointer;
            opacity: .7;
            &:hover{
                opacity: 1;
            }
            &.trash{
                background: red;
                color: #fff;

            }
        }

    }

}


.UploadsMEdia{
    max-height: 400px;
    overflow: auto;
    .div_{
            width: calc(100% / 3);
            float: left;
            position: relative;
            padding: 4px;
            cursor: pointer;
            .el{
                display: none;
                }
            .t{
                position: absolute;position: absolute;
                left: 4px;
                color: #fff;
                background: #00000063;
                padding: 1px 10px;
                font-size: 11px;
                border-radius: 10px;
                max-width: 100%;
                overflow: hidden;
                bottom: 10px;
            }
        div{
            position: relative;
            &:hover{
                .el{                
                    position: absolute;
                    display: inline-block;
                    right: 40px;
                    top: 10px;                
                    background: var(--vprimary);
                    color: #fff;
                    padding: 5px;
                    z-index: 99;
                    &:hover{
                        border-radius: 50%;
                    }
                    &.trash-2{
                        background: red;
                        right: 10px;
                    }
                }
            }          
            
            img{
                width: 100%;
                position: relative;            
                border-radius: 6px;
                border: 1px solid #0000003b;
                &:hover{
                    box-shadow: 0 0 10px #7367f06e;
                }
            }

        }
    }
}
.chooose{
    background: var(--vprimary);
    color: #fff;
    padding: 2px 7px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 11px;
}
.mediaAction{
    display: inline-block;
    padding: 10px 10px;
    float: right;
    cursor: pointer;
    &:hover{
        font-weight: bold;
    }
}
</style>