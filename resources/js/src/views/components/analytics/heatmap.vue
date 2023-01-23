<template>
    <div class="heatpamp">
        <div id="chartdiv"></div>
    
    </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4maps from "@amcharts/amcharts4/maps";
import am4geodata_worldLow from "@amcharts/amcharts4-geodata/worldLow";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

/* Chart code */
// Themes begin
am4core.useTheme(am4themes_animated);
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
    ...mapActions(["getStatsHeatmap"]), 
    async drawHeatMap(){
        
    //  this.getStats_()  
    let chart = am4core.create("chartdiv", am4maps.MapChart);
    chart.seriesContainer.draggable = false;
    chart.seriesContainer.resizable = false;
    chart.maxZoomLevel = 1;

    let title = chart.titles.create();
    title.text = "";
    title.textAlign = "middle";

    this.$vs.loading({type:"sound"}) 
    let res = await this.getStatsHeatmap()
    this.$vs.loading.close()

    let mapData = [
    ];
    res.visitors.forEach(function(d) {
      mapData.push({ "id":d.code, "name":d.code, "value":d.value, "color": chart.colors.getIndex(0) })
    })

    // Set map definition
    chart.geodata = am4geodata_worldLow;

    // Set projection
    chart.projection = new am4maps.projections.Miller();

    // Create map polygon series
    let polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
    polygonSeries.exclude = ["AQ"];
    polygonSeries.useGeodata = true;
    polygonSeries.nonScalingStroke = true;
    polygonSeries.strokeWidth = 0.5;
    polygonSeries.calculateVisualCenter = true;

    let imageSeries = chart.series.push(new am4maps.MapImageSeries());
    imageSeries.data = mapData;
    imageSeries.dataFields.value = "value";

    let imageTemplate = imageSeries.mapImages.template;
    imageTemplate.nonScaling = true

    let circle = imageTemplate.createChild(am4core.Circle);
    circle.fillOpacity = 0.7;
    circle.propertyFields.fill = "color";
    circle.tooltipText = "{name}: [bold]{value}[/]";


    imageSeries.heatRules.push({
      "target": circle,
      "property": "radius",
      "min": 4,
      "max": 30,
      "dataField": "value"
    })

    imageTemplate.adapter.add("latitude", function(latitude, target) {
      let polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
      if(polygon){
        return polygon.visualLatitude;
      }
      return latitude;
    })

    imageTemplate.adapter.add("longitude", function(longitude, target) {
      let polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
      if(polygon){
        return polygon.visualLongitude;
      }
      return longitude;
    })

    }
    
  },
   mounted() { 
     this.drawHeatMap()
  },
};
</script>
<style lang="scss">

#chartdiv {
  width: 100%;
    height: calc(100vh - 136px);

}
</style>