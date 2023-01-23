<template>
    <ul class="ulChoices ulChoices_">
        <li :class="['mb-2',{acc:answer.id == response.result},{'shake-vertical':answer.id == response.result}]" :style="BtnStyle"   v-for="answer,i in step.nodes" :key="i"  v-if="i!=0">
            <span>{{answer.text}}</span>
            <i v-if="answer.id == response.result" class="el check-circle"></i>
        </li>
    </ul>
</template>

<script>

import axios from 'axios';

export default {
  props: ['response','step'],
  data() {
    return {
        isPlaying:false
    }
  },computed: {
    BtnStyle(){
      return {
            background: this.step.primaryBgColor,
            color:this.step.primaryTextColor,
            borderRadius:this.step.radius + "px",
      }
    },
  },
  methods: {
  },

    mounted() {
    },
    created() {
        
    },
    destroyed() {
    },
}

</script>

<style lang="scss" >
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