<template>
 <div>
       <vs-row>
    <vs-col vs-w="6">
      <div class="uploadPreview">
          <video    width="200%" style="max-height:200%" controls>
              <source :src="this.path">
            <track kind="captions" :src="this.sub_path" srclang="en" label="English" default>
        </video>
      </div>
    </vs-col>
       <vs-col vs-w="6">
      <div style="">
        <div
          style="
            height: 49px;
            border-bottom: 1px solid #00000014;
            position: relative;
            margin:10px;
          "
        >

          <input
            @change="UploadFile"
            type="file"
            ref="file"
            accept=".mp4"
            style="display: none"
          />
          <span
            style="
              background: var(--vprimary);
              color: #fff;
              position: absolute;
              right: 309px;
              padding: 8px 10px;
              border-radius: 4px;
            "
            class="mediaAction"
            @click="$refs.file.click()"
            ><i v-if="!progress" class="el upload-cloud"></i> <span class="_progress" v-else>{{progress}}%</span> Upload Video</span
          >
         
       
        </div>
          <button
            @click="addSubtitle=true"
          >
            <span
            style="
              background: var(--vprimary);
              color: #fff;
              position: absolute;
              right: 309px;
              padding: 8px 10px;
              border-radius: 4px;
            " 
            > generate subtitle</span
          >
             
           </button>
         
      </div>
       </vs-col> 
   </vs-row>
     <vs-popup class="custompopup" :active.sync="addSubtitle" >
                <form >                    
                   <vs-select
      class="selectExample"
      label="Figuras"
      v-model="select1"
      >
      <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
    </vs-select>
                </form>
            </vs-popup>
 </div>
</template>
<script>
import axios from 'axios'
export default {
  components: {
  },
  data () {
    return {
      path: '',
      progress:0,
      sub_path:'',
      addSubtitle:false,
      options1:[
        {text:'IT', value:0},
        {text:'Blade Runner', value:2},
        {text:'Thor Ragnarok', value:3}
      ]
    }
  },
  methods:{
    UploadFile () {
      const formData = new FormData()
      const file = this.$refs.file.files[0]
      formData.append('file', file)
      const _this = this

      axios.post('/video/subtitle/upload', formData, {
        onUploadProgress: function (progressEvent) {
          _this.progress = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
        }.bind(this)
      })
        .then(response => {
          console.log(response.data)
          this.progress = 0   
          this.path = response.data.path 
          this.sub_path = response.data.sub_path
        })  
    },
    generate_sub () {

    }
  }
}
</script>
<style lang="scss" scoped>
.uploadPreview {
    position: absolute;
    background: black;
    height: 400%;
    width: 50%;
    top: 0px;
    left: 0px;
    border-bottom-left-radius: 6px;
    border-top-left-radius: 6px;
    width: calc(50% - 15px);
    display: flex;
    padding: 15px;
}
.listVideos{
    height: calc(100vh - 200px);
    overflow: auto;
    width: 100%;
    .listVideos--video{
        position: relative;    
        padding: 10px;
        img{
            position: relative;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            &.ct{
                border: 2px solid var(--vprimary);
            }
        }
    }

}

.listVideos--next{
    position: absolute;    
    width: calc(50% + 15px);
    height: 50px;
    background: #000000c7;
    right: 0px;
    bottom: 0px;
    border-bottom-right-radius: 5px;
    span{
        width: 50%;
        float: left;
        line-height: 50px;
        float: left;
        text-align: center;
        font-weight: bold;
        &.ct{
            color: #fff;
            cursor: pointer;
            &:hover{
                background: black;
            }
        }
    }
}
._progress{
    font-weight: normal;
    font-size: 11px;
}
</style>
<style lang="css" scoped>
.selectExample {
  margin: 10px;
}
.con-select-example {
  display: flex;
  align-items: center;
  justify-content: center;
}
.con-select .vs-select {
  width: 100%
}
@media (max-width: 550px) {
  .con-select {
    flex-direction: column;
  }
  .con-select .vs-select {
    width: 100%
  }
}
</style>
