<template>
    <div class="vSelect__ vSelectFont">
        <div class="selectedd">
            <i :class="['el', icon]"></i>
            <img style="float: left;margin-top: 11px; margin-right: 10px;" class="img" v-if="image" :src="image">
            <span class="_selected" @click="open= !open"> {{value_}}</span>
            <i :class="['el_ el chevron-down', {'chevron-up':open == true}]"></i>
        </div>
        <div class="vSelect-options" v-if="open==true" style="max-height: none !important;">
            <li :class="{active:value==option.value}" @click="selected(option)" v-for="(option, i) in options"  :key="i"><i v-if="option.icon" :class="['el icn_', option.icon ]"></i> <img class="img" v-if="option.image" :src="option.image"> <span>{{option.value}}</span></li>
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
        icon(){
            let index = this.options.findIndex(item => item.value === this.value );
            if(index != -1)
                return (this.options[index].icon)? this.options[index].icon:false

        },
        image(){
            let index = this.options.findIndex(item => item.value === this.value );
            if(index != -1)
                return (this.options[index].image)?this.options[index].image:false

        },
        value_(){
            return (this.value)?this.value:this.label;
        }
    },
    methods: { 
        selected(option){
            console.log("🚀 ~ file: AnswerType.vue ~ line 49 ~ selected ~ option", option)
            this.$emit('input', option.value);
            this.open = false

        }
    
    },
  
    mounted() { 
       
      
    },
}

</script>
<style lang="scss" scoped>
.vSelect__{    
    cursor: pointer;
    position: relative;
    border-radius: 0px;
    padding-left: 10px;
    padding-right: 10px;    
    border: 1px solid rgba(0, 0, 0, 0.2);;
    text-align: left;
    height: 45px;
    line-height: 45px;
    margin-top: 10px;
    margin-bottom: 10px;
    background: #eaeaea !important;
    border: 1px solid #eaeaea !important;
    height: 45px !important;
    &.vSelectFont{
        border-radius: 0px;
        height: 30px;
        line-height: 40px;
        font-size: 16px;
        background: #fff;
        color: black !important;
        .img{            
            height: 20px;
            margin-top: 4px;            
            float: left;
            margin-right: 10px;
        }
        .icn_{
            font-size: 20px;            
            color: var(--vprimary) !important;
            float: left;
            margin-right: 10px;
        }
        .el_ {            
            position: absolute;
            right: 5px;
            top: 0px;
            font-size: 18px;
        }
    }

}
.vSelect-options{
    position: absolute;
    width: calc(100% - 9px);
    top: 51px;
    left: 4px;
    max-height: 150px;
    overflow: auto;
    background: #fff;
    box-shadow: 0 0 5px #0000005c;
    border-radius: 6px;
    z-index: 9;    
    padding: 12px 0px;
     img{
    height: 20px;        
    }

    
}

.vSelect-options li{
    display: block;
    height: 35px;
    line-height: 35px;
    padding-left: 10px;
    padding-right: 10px;
    list-style: none;    
    height: 30px;
    width: 100%;
}
.vSelect-options li{
    float: left;
    line-height: 20px;
}
.vSelect-options li:hover, .vSelect-options li.active {
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
    top: -0px;
}
.arrow_up{
    transform: rotate(-90deg);
}
._selected{
    display: block;
}

.selectedd{
    position: relative;
    i{
        float: left;        
        line-height: 45px;
        padding-right: 10px;        
        font-size: 22px;
    }
}
</style>
