<template>
    <div class="vSelect vSelectFont">
        <span class="_selected" @click="open= !open">{{value_}}</span>
        <i :class="['el_ el chevrons-down', {'chevrons-up':open == true}]"></i>
        <div class="vSelect-options" v-if="open==true">
            <span :class="{active:value==option.value}" @click="selected(option)" v-for="(option, i) in options" :style="'font-family:'+option.value+' !important'" :key="i"><i v-if="option.icon" :class="['el icn_', option.icon ]"></i> {{option.value}}</span>
        </div>

    </div>

</template>


<script>

export default {
    name:"fontSelector",
    props:['label', 'options', 'value' ],
    data() {
        return {
            open:false
        
        }
    },components: { 
    },
    computed: {
        value_(){
            return (this.value)?this.value:this.label;
        }
    },
    methods: { 
        selected(option){
            this.$emit('input', option.value);
            this.open = false

        }
    
    },
  
    mounted() { 
       
      
    },
}

</script>
<style lang="scss" scoped>
.vSelect{    
    cursor: pointer;
    position: relative;
    border-radius: 17px;
    padding-left: 10px;
    padding-right: 10px;    
    border: 1px solid rgba(0, 0, 0, 0.2);;
    text-align: left;
    height: 38px;
    line-height: 38px;
    margin-top: 5px;
    margin-bottom: 5px;
    &.vSelectFont{
        border-radius: 0px;
        height: 30px;
        line-height: 28px;
        font-size: 12px;
        background: #fff;
        .icn_{
            
        }
        .el_ {            
            position: absolute;
            right: 5px;
            top: 4px;
            font-size: 18px;
        }
    }

}
.vSelect-options{
    position: absolute;
    width: calc(100% + 5px);
    top: -2px;
    left: -2px;
    max-height: 150px;
    overflow: auto;
    background: #fff;
    box-shadow: 0 0 5px #0000005c;
    border-radius: 6px;
    z-index: 9;
}
.vSelect-options span{
    display: block;
    height: 35px;
    line-height: 35px;
    padding-left: 10px;
    padding-right: 10px;
}
.vSelect-options span:hover, .vSelect-options span.active {
    background: azure
}
.vSelect-options span.active{
    // background: #806ff6;
    // color: #fff;
}
.arrow_down{
    float: right;
    transform: rotate(90deg);
    font-size: 20px;
    color: #8b8888;
    position: relative;
    top: -30px;
}
.arrow_up{
    transform: rotate(-90deg);
}
._selected{
    display: block;
}
</style>
