<template>
    <div class="ResponseText">
        <form style="padding: 20px;" v-on:submit.prevent="onSubmit" >
            <div class="mt-2 listAnswer">
              <span>Response</span>
              <textarea required v-model="response.text" style="height:100px" class="form-control ex" ></textarea>
            </div>
            <div>
                <button ref="btn" class="actions" >Save</button>
            </div>
        </form>    
    </div>
</template>

<script>

import { mapActions } from "vuex";
export default {
  props: ['video', "visitor"],
  data() {
    return {
        response: {
            text:""
        }
    };
  },
  components: {
  },
  computed: {},
  methods: {      
    ...mapActions([
      "ResponseHumanVisitor",
    ]),
      async onSubmit(){          
        this.$refs.btn.classList.toggle("shake-vertical")    
        await new Promise(resolve => setTimeout(resolve, 1000));
        this.$refs.btn.classList.toggle("shake-vertical") 
        let data = {
            visitor: this.visitor,
            video: this.video.id,
            response: this.response.text
        }
        console.log("🚀 ~ file: ResponseText.vue ~ line 43 ~ onSubmit ~ data", data)
        
        this.$vs.loading({type:"sound"}) 
        let res = await this.ResponseHumanVisitor(data)           
        this.$vs.loading.close()
        this.$emit('playnext', 4)

      }
  },
  async mounted() {
  },
};
</script>
<style lang="scss" scoped>
.ResponseText{
    textarea{
        border: 1px solid var(--PrimaryBgColor) !important;
        &:focus, &:hover{
            border: 1px solid var(--PrimaryBgColor) !important;
        }
    }
    .actions{
        width: 100%;
        line-height: 30px !important;
        background: var(--PrimaryBgColor) !important;
        color: var(--PrimaryTextColor) !important;
        border-radius: var(--Btnradius) !important;
    }

}
</style>