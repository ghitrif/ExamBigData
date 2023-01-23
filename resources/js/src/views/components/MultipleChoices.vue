<template>
    <ul class="ulChoices ulChoices_">
        <li :class="['mb-2',{acc:answer.id == response.result}]" :style="BtnStyle"   v-for="answer,i in response.video.answers" :key="i"  v-if="i!=0">
            <span>{{answer.text}}</span>
            <i v-if="answer.id == response.result" class="el check-circle"></i>
        </li>
    </ul>
</template>


<script>

import axios from 'axios';

export default {
  props: ['response'],
  data() {
    return {
        isPlaying:false
    }
  },computed: {
    BtnStyle(){
      return {
            background: this.response.video.primaryBgColor,
            color:this.response.video.primaryTextColor,
            borderRadius:this.response.video.radius + "px",
      }
    },
  },
  methods: {
  },

    mounted() {
        console.log("🚀 ~ file: MultipleChoices.vue ~ line 35 ~ mounted ~ this.response", this.response)
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>

<style lang="scss" scoped >
.ulChoices_{
    width: 80%;
    li{
        line-height: 35px;
        opacity: 0.8;
        position: relative;
        &.acc{
            opacity: 1;
            background: #36cf71 !important;
            color: #fff;
        }
        i{
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 22px;
        }

    }
}
  
</style>