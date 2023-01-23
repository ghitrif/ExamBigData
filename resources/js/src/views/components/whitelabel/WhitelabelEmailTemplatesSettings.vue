<template>
    <div class="courseSettings" style="margin:40px" >
        <vs-collapse  :type="'border'" accordion >
     <vs-collapse-item>
       <div slot="header">
         Reset Password
       </div>
       <label>Subject</label>
       <vs-input  required class="inputx" />
        <vs-textarea label="Email"  />
     </vs-collapse-item>
     <vs-collapse-item>
       <div slot="header">
         When a new User Added
       </div>
       <label>Subject</label>
       <vs-input  required class="inputx" />
        <vs-textarea label="Email"  />
     </vs-collapse-item>
    </vs-collapse>
                
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ['brand'],
  data() {
    return {
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["createBrand"]),
    async configDomainCourse_(){
      let res = await this.CreateCourse(this.course)
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    },
    async save(){
      let res = await this.createBrand(this.brand)
      this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
    }
   
  },
   mounted() {     
  },
};
</script>
<style lang="scss">

</style>