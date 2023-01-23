<template>
    <div class="courseSettings">
         <vs-row class="homes" style="margin-top:15px;" v-if="stats">
		<vs-col vs-w="3">
			<div class="statistcs1" style="background: #eeecff;">
				
						<span class="el trending-up"></span>
						<span class="title_">{{stats.orders | kFormatter}}</span>
						<span class="subtitle_">Sales </span>
			</div>
		</vs-col>
		<vs-col vs-w="3">
			<div class="statistcs1" style="background: #e0f9fd;">
						<span class="el users"></span>
						<span class="title_">{{stats.students | kFormatter}}</span>
						<span class="subtitle_">Students</span>
			</div>
		</vs-col>
		<vs-col vs-w="3">
			<div class="statistcs1" style="background: #fdeaea;">
						<span class="el book-open"></span>
						<span class="title_">{{stats.visitors | kFormatter}}</span>
						<span class="subtitle_">Visits</span>
			</div>
		</vs-col>
		<vs-col vs-w="3">
			<div class="statistcs1" style="background: #e3e6db;">
						<span class="el dollar-sign"></span>
						<span class="title_">{{stats.revenue | formatNumber}}</span>
						<span class="subtitle_">Revenue</span>
			</div>
		</vs-col>
    </vs-row>
    <vs-row>
		<vs-col vs-w="12">
			<CourseViewWeek :course="course" />

		</vs-col>
    </vs-row>
        
    </div>
</template>

<script>
import Vue from 'vue'

import CourseViewWeek from "./stats/CourseViewWeek.vue"
import { mapGetters, mapActions } from "vuex";
var numeral = require("numeral");

  Vue.filter("formatNumber", function (value) {
    return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
  });
  Vue.filter("kFormatter", function (num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
  });

export default {
  props: ['course'],
  data() {
    return {
        stats: false
    };
  },
  components: {
	  CourseViewWeek
  },
  computed: {},
  methods: {
    ...mapActions(["getCourseStats"]), 
   
    async getStats_(){        
        let res = await this.getCourseStats(this.$route.params.id)
        this.stats = res
    }
  },
   mounted() {  
    this.getStats_()    
  },
};
</script>
<style lang="scss" scoped>
.statistcs1{
	background: #fff;
	// min-height: 200px;
	padding: 30px;
	border-radius: 10px;
	margin: 10px;
	.subtitle_{
		display: block;
	}
	.title_{
		-webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(34,41,47,0);
    letter-spacing: .01rem;
    text-align: left;
    direction: ltr;
    -webkit-box-direction: normal;
    word-wrap: break-word;
    box-sizing: border-box;
    font-family: inherit;
    line-height: 1.2;
    color: #5e5873;
    font-size: 1.286rem;
    font-weight: 600!important;
    margin-top: 0;
    margin-bottom: 0!important;
	display: inline-block;
	}
	.el{
		display: inline-block;
		padding: 9px;
		border-radius: 50%;
		font-size: 28px;
		margin-right: 15px;
		float: left;
		&.trending-up{
			color: #7367f0;
			background-color: rgba(115,103,240,.12);
		}
		&.users{
			background-color: rgba(0,207,232,.12);
			color: #00cfe8;
		}
		&.book-open{
			color: #ea5455;
			background-color: rgba(234,84,85,.12);
		}
		&.dollar-sign{
			color: #28c76f;
			background-color: rgba(40,199,111,.12);
		}
	}
}

</style>