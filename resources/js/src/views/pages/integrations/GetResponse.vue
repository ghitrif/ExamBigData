<template>
<div>
      <form v-on:submit.prevent="btn_Connect">
      <div class="mb-3">
          <label for="key">key : </label> <br>
         <input class="form-control" name="apiKey" v-model="apiKey" required>  
     </div>   
   <button  type="submit" class="actions dcsxd"  > Connect now </button>
    </form>

</div>     
</template>

<script>

export default {
   data(){
       return{
           apiKey:"",
       }
   },
   methods:{
       btn_Connect: function()
       {
          this.$emit("GetResponse",this.apiKey);
       }
   }

    
}
</script>


<style lang="scss" scoped>
    label{
        font-size: 20px;
    }
    .actions{
            float: left !important;
            &:focus,&:visited, &:hover{
                color: #fff !important;
                background: var(--vprimary);
            }
        }
        .dcsxd{
    background: transparent;
    border: 1px solid var(--vprimary);
    color: var(--vprimary);
    font-weight: normal;
    &:hover{
            background:var(--vprimary);
    }
}
</style>