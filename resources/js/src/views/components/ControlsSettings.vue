<template>
    <div class="tab_settings BrandingSettings">
        <span class="title">Controls</span>
        <li>
            <div><b>Start:</b></div>
            <label for="">Autoplay</label>
            <vs-switch v-model="video.funnel.autoplay"/>
        </li>
        <li>            
            <div><b>End:</b></div>
            <div class="mt-3">
                <vs-radio v-model="video.funnel.end" vs-value="Pause">Pause on last frame</vs-radio>
            </div>
            <div class="mt-3">
                <vs-radio v-model="video.funnel.end" vs-value="Reset">Reset to the thumbnail</vs-radio>
            </div>            
            <div class="mt-3">
                <vs-radio v-model="video.funnel.end" vs-value="replay">Video replay</vs-radio>
            </div>            
            <div class="mt-3">
                <vs-radio v-model="video.funnel.end" vs-value="Rewatch">Rewatch button</vs-radio>
            </div>                      
            <div class="mt-3">
                <vs-radio v-model="video.funnel.end" vs-value="Redirect">Redirect to a specified URL</vs-radio>
            </div>                    
            <div class="mt-3">
                <input v-if="video.funnel.end == 'Redirect'" type="url" class="form-control" placeholder="https://">
            </div>
        </li>
        <li v-if="6==7">            
            <div><b>Controls bar:</b></div>
            <div class="mt-3">                
                <label for="">Enable controls bar</label>
                <vs-switch v-model="video.funnel.controls"/>
            </div>            
            <div class="mt-3">                
                <label for="">Show play button</label>
                <vs-switch v-model="video.funnel.playButton"/>
            </div>                      
            <div class="mt-3">                
                <label for="">Show video time</label>
                <vs-switch v-model="video.funnel.time"/>
            </div>                          
            <div class="mt-3">                
                <label for="">Show video speed</label>
                <vs-switch v-model="video.funnel.speed"/>
            </div>                                            
            <!-- <div class="mt-3">                
                <label for="">Show language</label>
                <vs-switch v-model="video.funnel.end"/>
            </div>                                   -->
            <!-- <div class="mt-3">                
                <label for="">Show fullscreen</label>
                <vs-switch v-model="video.funnel.end"/>
            </div>    -->
        </li>
    </div>
</template>
<script>
export default {
  props: ['video'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {
  },
  async mounted() {
  },
};
</script>
<style lang="scss" scoped>
.tab_settings{
    padding: 10px;
    .title{
        line-height: 40px;
        border-bottom: 1px solid #00000017;
        display: block;
    }
    li{
        list-style: none;
        display: inline-block;
        background: #7367f014;
        padding: 20px 10px;
        width: 100%;
        border-radius: 7px;
        margin-top: 10px;
        label{
            float: left;
        }
        .vs-switch{
            float: right;
        }
        .mt-3{
            padding-top: 10px;
            padding-bottom: 10px;
        }
    }
}
</style>