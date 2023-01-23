
<template>
  <div class="timer_" :style="style">
    <div class="day" v-if="!expired">
      <span class="number">{{ (days.toString().substr(-2)).padStart(2, '0') }}</span>
      <div class="format">{{ wordString.day }}</div>
    </div>
    <div class="hour" v-if="!expired">
      <span class="number">{{ (hours.toString()).padStart(2, '0') }}</span>
      <div class="format">{{ wordString.hours }}</div>
    </div>
    <div class="min" v-if="!expired">
      <span class="number">{{ (minutes.toString()).padStart(2, '0') }}</span>
      <div class="format">{{ wordString.minutes }}</div>
    </div>
    <div class="sec" v-if="!expired">
      <span class="number">{{ (seconds.toString()).padStart(2, '0') }}</span>
      <div class="format">{{ wordString.seconds }}</div>
    </div>
    <div v-if="expired" style="font-size: 33px;">
        {{wordString.text_expired}}
    </div>
  </div>
</template>

<script>
export default {
  props: ['video'],
  data: function () {
    return {
      timer: "",
      start: "",
      end: "",
      interval: "",
      days: "",
      minutes: "",
      hours: "",
      seconds: "",
      message: "",
      statusType: "",
      statusText: "",
    };
  },
  created: function () {
    // this.wordString = JSON.parse(this.trans);
    // this.wordString = this.t;

  },
  mounted() {
    // if(typeof(this.starttime) == 'string' || typeof(this.endtime) == 'string'){
    //   this.starttime = Date.parse( this.starttime);
    //   this.endtime = Date.parse(this.endtime);
    //   console.log("parsed")
    // }
    // console.log(this.starttime)
    
    this.start = (!this.wordString.start)? new Date().getTime() :new Date(this.wordString.start).getTime();
    this.end = (!this.wordString.end)? new Date(new Date().setDate(new Date().getDate()+( Math.floor(Math.random() * 10) + 1 ))) : new Date(this.wordString.end).getTime();
    // this.end = new Date(this.wordString.end).getTime();
    // Update the count down every 1 second
    this.timerCount(this.start, this.end);
    this.interval = setInterval(() => {
      this.timerCount(this.start, this.end);
    }, 1000);
  },
  computed:{
      wordString(){
        if(!this.video.timer)
          return {
                    "day": "DD",
                    "hours": "HH",
                    "minutes": "MM",
                    "seconds": "Sec.",
                    "text_expired": "Expired",
                    "background": "#2196f3",
                    "start":false,
                    "end":false
                }
        if(typeof this.video.timer === 'string')
          return JSON.parse(this.video.timer);
        return this.video.timer

      },
       expired:function(){
        var now = new Date().getTime();
        var distance = this.start - now;
        var passTime = this.end - now;
        return (distance < 0 && passTime < 0)
    },
    style:function(){
        if(this.menu)
          return ""
          this.video
          console.log("🚀 ~ file: Timer.vue ~ line 94 ~ this.video", this.video)
        let style = {
          // backgroundImage: (this.settings.bgType == 'gradient')?"-webkit-linear-gradient(180deg, "+ this.settings.background +" "+ this.stop[0] +"%, "+ this.settings.backgroundSecondary +" "+ this.stop[1] +"%)":"",
          backgroundColor: this.video.primaryBgColor,
          // borderWidth: this.settings.borderSize +"px",
          // borderStyle: this.settings.borderStyle,
          // borderColor: this.settings.borderColor,
          // borderRadius: this.settings.radius +"px",          
          // opacity: this.settings.opacity,
          color: this.video.primaryTextColor,
          // fontFamily: this.settings.fontFamily,
          // letterSpacing: this.settings.letterSpacing+"px",
          // fontSize: this.settings.fontSize+"px",
          // fontStyle: this.settings.fontStyle,
          // fontWeight: this.settings.textStyle,
          // textAlign: this.settings.textAlign,
          // textTranforme: this.settings.textTranforme,
          // textDecoration: this.settings.textDecoration,
          // cursor: this.settings.cursor,
          // padding:this.settings.padding

        }
        return style
      }
  },
  methods: {
   
    timerCount: function (start, end) {
      var now = new Date().getTime();
      var distance = start - now;
      var passTime = end - now;

      if (distance < 0 && passTime < 0) {
        this.message = this.wordString.text_expired;
        this.statusType = "expired";
        this.statusText = this.wordString.text_expired;
        clearInterval(this.interval);
        return;
      } else if (distance < 0 && passTime > 0) {
        this.calcTime(passTime);
        // this.message = this.wordString.running;
        // this.statusType = "running";
        // this.statusText = this.wordString.status.running;
      } else if (distance > 0 && passTime > 0) {
        this.calcTime(distance);
        // this.message = this.wordString.upcoming;
        // this.statusType = "upcoming";
        // this.statusText = this.wordString.status.upcoming;
      }
    },
    calcTime: function (dist) {
      // Time calculations for days, hours, minutes and seconds
      this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
      this.hours = Math.floor(
        (dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
      this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
    },
  },
};
</script>

<style lang="scss" scoped>

.timer_ {
    font-size: 20px;
    color: #fff;
    text-align:center;
    // margin-top: 50px;
    padding: 12px;
    padding-bottom: 3px;
    border-radius: 10px;
    padding: 21px 0px !important;    
    margin: 20px;

      .day, .hour, .min, .sec {
        font-size: 30px;
        display: inline-block;
        font-weight: 500;
        text-align: center;
        margin: 0 4px;
        .format {
          font-weight: 300;
          font-size: 14px;
          //@include margin-start(5);
          //display: inline-block;
          opacity: 0.8;
          // min-width: 54px;
          overflow: hidden;
        }
      }
      .number{
        background: rgba(51, 51, 51, 0.53);
        padding: 0 5px;
        border-radius: 5px;
        display: inline-block;
        // min-width: 54px;
        font-size: 26px;
          overflow: hidden;
        text-align: center;
      }
      .message {
        font-size: 14px;
        font-weight: 400;
        margin-top: 5px;
      }
      .status-tag{
        width: 270px;
        margin: 10px auto;
        padding: 8px 0;
        font-weight: 500;
        color: #000;
        text-align: center;
        border-radius: 15px;
        &.upcoming{
          background-color: lightGreen;
        }
        &.running{
          background-color: gold;
        }
        &.expired{
          background-color: silver;
        }
      }
    }
</style>