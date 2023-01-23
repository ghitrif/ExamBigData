<template>
<form ref="form"   class="optinForm" :style="style" v-on:submit.prevent="onSubmit" v-if="show">
   <div  class="row" >
        <div v-if="!embed">
            <contenteditable                     
                class="optin-content text-center"
                :value.sync="settings.title"
            />

            <contenteditable
                class="optin-content text-center"
                :value.sync="settings.content"
            />
        </div>
        <div v-else>
          <p v-html="settings.title"></p>
          <p v-html="settings.content"></p>
        </div>
        <div  class="col-12 mt-3">
            <div role="group" class="form-group"  >
                <div class="text-left">
                  <label>Enter Your Name</label>
                <input required name="name" :style="InputStyle" id="v-first-name" type="text"  class="form-control">
                </div>
            </div>
        </div>
        <div  class="col-12 mt-3">
            <div role="group" class="form-group"  >
                <div class="text-left">
                  <label>Enter Your Email</label>
                <input required name="email" :style="InputStyle" id="v-email" type="email"  class="form-control">
                </div>
            </div>
        </div>
        <div  class="col-12  mt-3">
          <button :style="ButtonStyle" type="submit" class="btn mr-1 btn-primary"> Submit </button>
        </div>
   </div>
</form>
</template>


<script>

import Vue from "vue";
import { mapGetters, mapActions } from "vuex";

Vue.component("contenteditable", {
  template: `<p
    contenteditable="true"
    @input="update"
    @focus="focus"
    @blur="blur"
    v-html="valueText"
  ></p>`,
  props: {
    value: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      focusIn: false,
      valueText: "",
    };
  },
  computed: {
    localValue: {
      get: function () {
        return this.value;
      },
      set: function (newValue) {
        this.$emit("update:value", newValue);
      },
    },
  },
  watch: {
    localValue(newVal) {
      if (!this.focusIn) {
        this.valueText = newVal;
      }
    },
  },
  created() {
    this.valueText = this.value;
  },
  methods: {
    updatecontentEditable(e) {
      console.log(
        "🚀 ~ file: create.vue ~ line 3219 ~ updatecontentEditable ~ e",
        e
      );
    },
    update(e) {
      this.localValue = e.target.innerHTML;
    },
    focus() {
      this.focusIn = true;
      console.log(
        "🚀 ~ file: create.vue ~ line 3226 ~ focus ~ this.focusIn",
        this.focusIn
      );
    },
    blur() {
      this.focusIn = false;
      this.$emit("done", this.valueText);
    },
  },
});
export default {
  name: "optin",
  props: ["settings", "embed"],
  data() {
    return {
      show:true
    };
  },
  components: {},
  computed: {
      position: function(){
        return {
            x: this.settings.x,
            y: this.settings.y,
        }
      },
      InputStyle(){
        let node = (typeof this.settings.settings == 'string')? JSON.parse(this.settings.settings):this.settings.settings
        let style = {
          background: node.ipnutBackground,
          color:node.ipnutColor,
          borderColor:node.ipnutBorderColor,
          background:node.ipnutBackground,
          borderStyle:node.ipnutBorder,
          borderWidth:node.ipnutBorderWeight+"px",
          borderRadius:node.ipnutRadius+"px",
        }
        return style
      },
      ButtonStyle(){
        let node = (typeof this.settings.settings == 'string')? JSON.parse(this.settings.settings):this.settings.settings
        let style = {
          background: node.buttonBackground,
          color:node.buttonColor,
          borderColor:node.buttonBorderColor,
          background:node.buttonBackground,
          borderStyle:node.buttonBorder,
          borderWidth:node.buttonBorderWeight+"px",
          borderRadius:node.buttonRadius+"px",
        }
        return style
      },
      style:function(){
        let style = {
          backgroundImage: (this.settings.bgType == 'gradient')?"-webkit-linear-gradient(180deg, "+ this.settings.background +" "+ this.stop[0] +"%, "+ this.settings.backgroundSecondary +" "+ this.stop[1] +"%)":"",
          backgroundColor: this.settings.background,
          borderWidth: this.settings.borderSize +"px",
          borderStyle: this.settings.borderStyle,
          borderColor: this.settings.borderColor,
          borderRadius: this.settings.radius +"px",          
          opacity: this.settings.opacity,
          color: this.settings.color,
          fontFamily: this.settings.fontFamily,
          letterSpacing: this.settings.letterSpacing+"px",
          fontSize: this.settings.fontSize+"px",
          fontStyle: this.settings.fontStyle,
          fontWeight: this.settings.textStyle,
          textAlign: this.settings.textAlign,
          textTranforme: this.settings.textTranforme,
          textDecoration: this.settings.textDecoration,
          cursor: this.settings.cursor,
        }
        return style

      }
  },
  methods: {
    ...mapActions(["AddEmailToList"]),
    async onSubmit(e){
      e.preventDefault()
      if(this.embed){
        let settings = (typeof this.settings.settings == 'string')? JSON.parse(this.settings.settings):this.settings.settings

        const formData = new FormData(this.$refs['form']);
        const data = {}; // need to convert it before using not with XMLHttpRequest
        for (let [key, val] of formData.entries()) {
            Object.assign(data, { [key]: val })
        }
        data.id = settings.autoresponder_id
        data.autoresponder = settings.autoresponder
        this.$vs.loading({type:"sound"}) 
        let res = await  this.AddEmailToList(data)
        this.$vs.loading.close()
        this.show = false
        this.$vs.notify({title:'Success',text:'thank you form subscription',color:'success'})

      }else{

      }

    }
  },

  mounted() {},
};
</script>
<style lang="scss" scoped>
.optinForm{
    padding: 15px;
    // background: white;
    position: relative;
    height: 100%;
    width: 100%;    
    overflow: auto;
    .btn{        
        width: 100%;
    }
}

</style>