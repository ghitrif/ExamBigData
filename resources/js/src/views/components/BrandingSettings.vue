<template>
    <div class="tab_settings BrandingSettings">
        <span class="title">Branding</span>
        <!-- <li>
            <label for="">Allow Comments</label>
            <vs-switch v-model="video.funnel.enableComments"/>
        </li> -->
        <template v-if="video.funnel">
              
        <li>
            <div class="mb-3">Player color</div>            
            <colorInput v-model="video.funnel.textColor"></colorInput> 
        </li>
        <li>
            <div class="mb-3">Player Background color</div>            
            <colorInput  v-model="video.funnel.backgroundColor"></colorInput> 
        </li>  
        
        <li>
            <div class="mb-3">Player Progress Primary</div>            
            <colorInput  v-model="video.funnel.progressColor1"></colorInput> 
        </li> 
        
        <li>
            <div class="mb-3">Player Progress Secondary</div>            
            <colorInput  v-model="video.funnel.progressColor2"></colorInput> 
        </li>  
        </template>

         <template v-else>
              
        <li>
            <div class="mb-3">Player color</div>            
            <colorInput v-model="video.course.textColor"></colorInput> 
        </li>
        <li>
            <div class="mb-3">Player Background color</div>            
            <colorInput  v-model="video.course.backgroundColor"></colorInput> 
        </li>  
        
        <li>
            <div class="mb-3">Player Progress Primary</div>            
            <colorInput  v-model="video.course.progressColor1"></colorInput> 
        </li> 
        
        <li>
            <div class="mb-3">Player Progress Secondary</div>            
            <colorInput  v-model="video.course.progressColor2"></colorInput> 
        </li>  
         </template>
        <!-- <li>
            <div class="mb-3">Custom logo <vs-switch v-model="video.funnel.enableBranding"/></div>            
            <MediaFile v-if="video.funnel.enableBranding" v-model="video.funnel.brandingLogo" />
        </li> -->
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
    }
}
</style>