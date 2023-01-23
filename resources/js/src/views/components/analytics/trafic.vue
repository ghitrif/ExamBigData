<template>
    <div class="Homes">
    <div class="con-tab-ejemplo">
           <vs-row class="homes" style="margin-top:15px;" >
              <vs-col vs-w="3">
                <div class="statistcs1" style="background: #eeecff;">
                  
                      <span class="el trending-up"></span>
                      <span class="title_">{{stats.average}}%</span>
                      <span class="subtitle_">Average Engagment</span>
                </div>
              </vs-col>
              <vs-col vs-w="3">
                <div class="statistcs1" style="background: #e0f9fd;">
                      <span class="el users"></span>
                      <span class="title_">{{stats.plays}}</span>
                      <span class="subtitle_">Total Plays</span>
                </div>
              </vs-col>
              <vs-col vs-w="3">
                <div class="statistcs1" style="background: #fdeaea;">
                      <span class="el book-open"></span>
                      <span class="title_">{{ stats.playsRate }}%</span>
                      <span class="subtitle_">Plays Rate</span>
                </div>
              </vs-col>
              <vs-col vs-w="3">
                <div class="statistcs1" style="background: #e3e6db;">
                      <span class="el dollar-sign"></span>
                      <span class="title_">{{stats.visitors}}</span>
                      <span class="subtitle_">Toal Visits</span>
                </div>
              </vs-col>
              </vs-row>
              <div style="height: 100%; position: relative;">
                <!-- <video id="video__" style="height: 500px; position: relative;">
                  <source src="/storage/uploads/media/119/drfy5TWJhf2pDhZohKTF27sLo3DBsWk3T3azexig.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video> -->
                <div class="chart" id="chart"></div>
              </div>
        </div>
          
    </div>
</template>

<script>

import ApexCharts from 'apexcharts'
import { mapGetters, mapActions } from "vuex";
export default {
  props: [],
  data() {
    return {
      stats:false
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["GetTrafic", "globalCourseStatsTrafic"]), 
    async globalCourseStatsTrafic(){

    },   
    async getStats_(){ 
      this.$vs.loading({type:"sound"})        
        let res = await this.GetTrafic(this.$route.params.id)
        this.$vs.loading.close()
        this.stats = res
        var options = {
          series: [{
            name: "Watchers",
            data: res.values
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight',
          width: 1,
        },
        title: {
          text: '',
          align: 'left'
        },
        grid: {
          show: false,
          row: {
            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: res.times,
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    
    }
  },
   mounted() {   
     this.getStats_()  
  },
};
</script>
<style lang="scss">

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