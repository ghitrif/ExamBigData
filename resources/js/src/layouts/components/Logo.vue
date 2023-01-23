<template>
  <img :src="brand.logo" style=" height: 50px !important;; margin:10px" @click="$router.push('/')">
</template>
<script>

export default {

  computed: {
      brand(){
          let brand = window.brand
          return brand
      }
    
  },
  
}

</script>
