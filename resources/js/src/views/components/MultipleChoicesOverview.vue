<template>
    <ul class="ulChoices ulChoices_ ulChoices__">
        <li :class="['mb-2 text-left']" :style="BtnStyle"   v-for="answer,i in step.nodes" :key="i"  v-if="i!=0">
            <span>{{answer.text}}</span>
            <span class="resuts_" v-text="results(answer.id)"></span>
        </li>
        <div>Total interactions : {{step.responses.length}}</div>
    </ul>
</template>


<script>
import axios from 'axios';

export default {
  props: ['step'],
  data() {
    return {
    }
  },
   filters:{      
      ResponseStats: function (value) {
        return this.step.responses.length
        
      }
    },
    computed: {
    BtnStyle(){
      return {
            background: this.step.primaryBgColor,
            color:this.step.primaryTextColor,
            borderRadius:this.step.radius + "px",
      }
    },
  },
  methods: {
      results(id){
          let results = this.step.responses.filter(response => response.result == id);
          return parseInt((results.length / this.step.responses.length) * 100) + "%"
      }
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
.ulChoices__{
    width: 80%;
    li{
        padding-left: 20px;
        position: relative;
        .resuts_{
            position: absolute;
            right: 0px;
            right: 8px;
            font-weight: normal;
        }

    }
}
  
</style>