<template>
  <a :href="media.path" download="" class="btn-slide2">
    <span class="circle2"><i class="el download-cloud"></i></span>
    <span class="title2">Download</span>
    <span class="title-hover2">Click here</span>
  </a>
</template>


<script>
import axios from "axios";

export default {
  props: ["media"],
  data() {
    return {};
  },
  computed: {},
  methods: {},

  mounted() {},
  created() {},
  destroyed() {},
};
</script>

<style lang="scss" scoped >
.btn-slide,
.btn-slide2 {
  position: relative;
  display: inline-block;
  height: 53px;
  width: 200px;
  line-height: 50px;
  padding: 0;
  border-radius: 50px;
  background: #fdfdfd;
  border: 2px solid #0099cc;
  margin: 10px;
  transition: 0.5s;
}

.btn-slide2 {
  border: 2px solid #36cf71;
}

.btn-slide:hover {
  background-color: #0099cc;
}

.btn-slide2:hover {
  background-color: #36cf71;
}

.btn-slide:hover span.circle,
.btn-slide2:hover span.circle2 {
  left: 100%;
  margin-left: -45px;
  background-color: #fdfdfd;
  color: #0099cc;
}

.btn-slide2:hover span.circle2 {
  color: #36cf71;
}

.btn-slide:hover span.title,
.btn-slide2:hover span.title2 {
  left: 40px;
  opacity: 0;
}

.btn-slide:hover span.title-hover,
.btn-slide2:hover span.title-hover2 {
  opacity: 1;
  left: 40px;
}

.btn-slide span.circle,
.btn-slide2 span.circle2 {
  display: block;
  background-color: #0099cc;
  color: #fff;
  position: absolute;
  float: left;
  margin: 5px;
  line-height: 42px;
  height: 40px;
  width: 40px;
  top: 0;
  left: 0;
  transition: 0.5s;
  border-radius: 50%;
}

.btn-slide2 span.circle2 {
  background-color: #36cf71;
}

.btn-slide span.title,
.btn-slide span.title-hover,
.btn-slide2 span.title2,
.btn-slide2 span.title-hover2 {
  position: absolute;
  left: 90px;
  text-align: center;
  margin: 0 auto;
  font-size: 16px;
  font-weight: bold;
  color: #30abd5;
  transition: 0.5s;
}

.btn-slide2 span.title2,
.btn-slide2 span.title-hover2 {
  color: #36cf71;
  left: 80px;
}

.btn-slide span.title-hover,
.btn-slide2 span.title-hover2 {
  left: 80px;
  opacity: 0;
}

.btn-slide span.title-hover,
.btn-slide2 span.title-hover2 {
  color: #fff;
}
</style>