<template>
<div style="height: 40px;width:40px;
    float: right;
    position: relative;
">
    <span class="elementBgColorSpan" @click="colorPiker=!colorPiker" :style="'background:'+value"></span>
    <span class="elementBgColorInput" >
        <!-- <input ref="inputColor" @change="set_color1($event)" v-if="!is_svg" :value="value_"  style="width:100px">                      -->
        <span @click=" set_color_" class="elementBgColorSpan--save" v-if="colorPiker">Close</span>                   
        <sketch-picker @input="set_color"  :value="value" v-if="colorPiker" ></sketch-picker>
    </span>
    <!-- <span @click="copyText" class="icc el copy"></span> -->
</div>
</template>
<script>
import { Sketch } from "vue-color";

export default {
    name:"colorInput",
    props:["value", "svg"],
    data() {
        return {
            colorPiker:false,        
        }
    },
    computed:{
        value_(){
            return this.value
        },
        is_svg(){
            return (this.svg)?true:false
        }
    },
    methods:{
         copyText() {
            var copyText = this.$refs.inputColor
            copyText.select()
            copyText.setSelectionRange(0, 99999); 
            document.execCommand("copy")            
            this.$vs.notify({title:'Success',text:'Successfully copied to clipboard',color:'success'})
        },
        set_color(c){
            this.$emit('input', c.hex8);
        },
        
        set_color_(){
            this.$emit('ch', this.value);
            this.colorPiker=false;
        },
        set_color1(evt){
            this.$emit('input', evt.target.value);
            console.log("🚀 ~ file: colorInput.vue ~ line 44 ~ set_color1 ~ evt.target.value", evt.target.value)
        }

    },
    components: { 
    "sketch-picker": Sketch,
    },

}

</script>
<style lang="scss" scoped>
.elementBgColorSpan{
            display: inline-block;
            float: left;
            margin-right: 5px;
            border: 1px solid #837e7e52;
            position: absolute;
            right: 0px;
            cursor: pointer;
            height: 100%;
            width: 100%;
            position: relative
        }
        .elementBgColorInput{
            float: left;   
            position: relative;    
            position: absolute;
            right: -30px;  
            input{
              padding: 0px;
              height: 30px;
              margin-left: 6px;
              border: 1px solid #0000008f;
              border-radius: 2px;
            }
        }
   .vc-sketch{
              position: absolute;
              padding-top: 30px;
              top: 35px;
              left: -30px;
              z-index: 999 !important;
            }
            
            .elementBgColorSpan--save{
                position: absolute;
                top: 40px;
                z-index: 9;
                left: 136px;
                background: #a5c0ce;
                height: 20px;
                font-size: 11px;
                padding: 0px 10px 0px 10px;
                border-radius: 3px;
                color: #fff;
                cursor: pointer;
                z-index: 9999;
                &:hover{                    
                  background: #2b3140;
                }
            }
.elementBgColorInput{
    input{        
        border: 1px solid #837e7e52 !important;
    }
}
.icc{    
    padding: 5px;
    font-size: 22px;
    cursor: pointer;    
    margin-top: -3px;
    display: inline-block;
}
</style>