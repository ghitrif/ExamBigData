<template>
    <span class="BtnNode">{{settings.text}}</span>
</template>

<script>
export default {
  name: "BtnNode",
  props: ["settings"],
  data() {
    return {
      
    };
  },
  components: {},
  computed: {
  },
  methods: {},

  mounted() {},
};
</script>
<style lang="scss" >
.BtnNode{
    position:relative;
    width:100%;
    height:100%;     
    display: block;   
    background: black;
    height: 28px;
    color: #fff;
    text-align: center;
    line-height: 28px;
    overflow: hidden;
    font-weight: normal;
    border-radius: 6px;
}
</style>