<template>
    <div class="Homes" style="        
	    overflow: scroll;
    overflow-x: visible;margin:40px;margin-top:-30px;">
      <div>
		<h3 style="font-size: 45px;">Predictive maintenance</h3>
		<h2>Time:15:18:45 - 23 Jan 2023</h2>
	  </div>
    <vs-row>
		<vs-col vs-w="3" v-for="d,i in data" :key="i">
			<div class="statistcs1" style="background: rgb(255 1 1 / 83%);;
    color: black">
				<span class="title_" style="color: black;">{{d.uid}}</span>
				<span class="subtitle_">{{d.type}}</span>
			</div>

		</vs-col>
    </vs-row>
        
    </div>
</template>

<script>

// import CourseViewWeekGlobal from "../components/stats/CourseViewWeekGlobal.vue"
import { mapGetters, mapActions } from "vuex";
export default {
  props: [],
  data() {
    return {
        stats: false,
		data:[{
			uid:"L47230",
			status:1,
			type:'Power Failure'
			},
			{
			uid:"L47249",
			status:1,
			type:'Power Failure'
			},
			{
			uid:"L47249",
			status:1,
			type:'Power Failure'
			},
			{
			uid:"L47257",
			status:1,
			type:'Tool Wear Failure'
			},
			{
			uid:"L47340",
			status:1,
			type:'Overstrain Failure'
			},
			{
			uid:"L47348",
			status:1,
			type:'Power Failure'
			},
		]
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["getCourseStats_global"]), 
   
    async getStats_(){        
        let res = await this.getCourseStats_global()
        this.stats = res
    }
  },
   mounted() {  
    // this.getStats_()    
  },
};
</script>
<style lang="scss">


</style>

<style lang="scss" scoped>
.statistcs1{
	background: #fff;
	// min-height: 200px;
	padding: 30px;
	border-radius: 10px;
	margin: 10px;

	position: relative;
	    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;
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
		    position: absolute;
			top: -15px;
			left: -14px;
		&.airplay{
			color: #7367f0;
			background-color: rgba(115,103,240,0.5);
		}
		&.layers{
			background-color: rgba(0,207,232,0.5);
			color: #00cfe8;
		}
		&.globe{
			color: #ea5455;
			background-color: rgba(234,84,85,0.5);
		}
		&.dollar-sign{
			color: #28c76f;
			background-color: rgba(40,199,111,0.5);
		}
	}
}

</style>
