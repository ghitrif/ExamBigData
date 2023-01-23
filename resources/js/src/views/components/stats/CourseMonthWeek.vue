<template>
<div class="row  col-md-10" style="margin:0 auto; margin-top:40px" >
    <div class="col-lg-12 col-md-12 col-sm-12 item  " v-if="loaded==33">
        <div class="card item-card card-block" style="padding: 30px;">
            <div id="chart"></div>
        </div>
    </div>
      <div v-else style="ext-align: center;">
        <img style="width:60px" src="/images/loading.gif">
    </div>
     
</div>
 
</template>
<script>
import ApexCharts from 'apexcharts'
import { mapGetters, mapActions } from "vuex";
export default {
  props: ["course"],
  data() {
    return {
        loaded:false
       
    };
  },
  components:{
  },
  methods:{

    ...mapActions(["CourseStats_weekly"]),
      
    async load_stats() {
        let res = await this.CourseStats_weekly({id:this.course.id, days:10})
         var options_ = {
          series: [{
          name: 'Views',
          data: res.visits
        },{
          name: 'Sales',
          data: res.sales
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: res.dates
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options_);
        chart.render();

    }

  },
  computed: {
    emails: function() {
            let s = this.dates.length;
            var data = Array.from({ length: s }, (v, i) => 0);
            var _this = this;
            this.statsEmail.forEach(function(stat) {
                data[_this.dates.indexOf(stat.date)] = stat.count;
            });
            return data;
    },
    visits: function() {
            let s = this.dates.length;
            var data = Array.from({ length: s }, (v, i) => 0);
            var _this = this;
            this.statsVisit.forEach(function(stat) {
                data[_this.dates.indexOf(stat.date)] = stat.count;
            });
            return data;
    },
  },
   async mounted(){
       await this.load_stats();
       
  }
};
</script>

<style lang="scss" >
</style>
