<template >
  <vs-row>
    <vs-col vs-w="6">
      <div class="uploadPreview">
          <video v-if="selected" width="100%" style="max-height:100%" controls>
            <source :src="selected.path" type="video/mp4">
        Your browser does not support the video tag.
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
          "
        >
          <vs-input
            style="max-width: 300px; float: right"
            icon="search"
            placeholder="Search"
          />

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

        <div class="listVideos">
          <vs-row >
            <vs-col vs-w="3" v-for="(video, i) in medias" :key="i">
              <div class="listVideos--video" @click="selected = video">
                <img  :class="{ct:selected==video}" :src="video.thumbnail" />
              </div>
            </vs-col>
          </vs-row>
        </div>
        
        <div class="listVideos--next">
            <span @click="$emit('cancelRecording')" class="ct" style="border-right: 1px solid #84848454;"><i class="el arrow-left"></i> Back</span>
            <span v-if="!selected"  >Next <i class="el arrow-right"></i></span>
            <span v-else @click="doneRecording" class="ct" >Next <i class="el arrow-right"></i></span>
        </div>
      </div>
    </vs-col>
  </vs-row>
</template>

<script>
import axios from "axios";

import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
        selected:false,
        medias: [],
        progress:0
  }),
  methods: {
    ...mapActions([
      "loadImages",
      "deleteMedia",
      "loadMedia",
      "RenameMedia",
      "CreateFolder",
    ]),
    doneRecording(){
        this.$emit('doneRecording', this.selected, 'uploads')

    },
    async UploadFile() {
      let formData = new FormData();
      const file = this.$refs.file.files[0];
      formData.append("file", file);
      let _this = this;

      let response = await axios.post("/media", formData, {
        onUploadProgress: function (progressEvent) {
           _this.progress = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
        }.bind(this),
      });
      if (response.data.status == 1) {
            this.medias.unshift(response.data.data)  
            _this.progress = 0        
            this.$vs.notify({title:'Success',text:'Video Uploaded Successfully',color:'success'})
      } else {
      }
    },
  },

  async mounted() {
    let data = await this.loadMedia();
    this.medias = data.data;
  },
};
</script>

<style lang="scss" scoped>
.uploadPreview {
    position: absolute;
    background: black;
    height: 100%;
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
    background: transparent;
    right: 0px;
    bottom: 7px;
    border-bottom-right-radius: 5px;
    span{
        width: 50%;
        float: left;
        line-height: 50px;
        float: left;
        text-align: center;
        font-weight: bold;
        text-align: center;
        background: var(--vprimary);
        margin: 0px 10px;
        width: calc(50% - 20px);
        border-radius: 10px;
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