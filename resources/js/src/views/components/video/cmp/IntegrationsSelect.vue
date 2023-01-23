<template>
    <div class="vSelect__ vSelectFont">
        <div class="selectedd">
            <i :class="['el', icon]"></i>
            <img style="float: left;margin-top: 11px; margin-right: 10px;" class="img img_" v-if="image" :src="image">
            <span class="_selected" @click="open= !open"> {{value_}}</span>
            <i :class="['el_ el chevron-down', {'chevron-up':open == true}]"></i>
        </div>
        <div class="vSelect-options" v-if="open==true">
            <li :class="{active:value==option.name}" @click="selected(option)" v-for="(option, i) in options"  :key="i"> <img class="img img_" v-if="option.image" :src="option.image"> <span>{{option.name}}</span></li>
        </div>

    </div>

</template>


<script>

export default {
    name:"fontSelector",
    props:['label', 'value' ],
    data() {
        return {
            open:false,
            options: [
                {
                    name:"AWeber",
                    image: "/images/integrations/aweber.png",
                    description: "Powerfully-simple email marketing designed to help your small business grow."
                },
                {
                    name:"GetResponse",
                    image: "/images/integrations/getresponse.svg",
                    description: "Powerful, simplified tool to send emails, and automate your marketing."
                },
                // {
                //     name:"Mailchimp",
                //     image: "@assets/images/integrations/Mailchimp.png",
                //     description: "Mailchimp is an all-in-one Marketing Platform for small business."
                // },
                {
                    name:"ConvertKit",
                    image: "/images/integrations/convertkit.png",
                    description: "Own the relationship with your audience & grow your business"
                },

                
                {
                    name:"Benchmark",
                    image: "/images/integrations/benchmarkisotype.svg",
                    description: "Own the relationship with your audience & grow your business"
                },  
                {
                    name:"ActiveCampaign",
                    image: "/images/integrations/Active-campaign.svg",
                    description: "Own the relationship with your audience & grow your business"
                },
                {
                    name:"MailChimp",
                    image: "/images/integrations/mail-chimp-img.png",
                    description: "Own the relationship with your audience & grow your business"
                }, 
                
                {
                    name:"Moosend",
                    image: "/images/integrations/moosend.png",
                    description: "Own the relationship with your audience & grow your business"
                }, 
                
                {
                    name:"Icontact",
                    image: "/images/integrations/iContact.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                {
                    name:"SendLane",
                    image: "/images/integrations/Sendlane.svg",
                    description: "Own the relationship with your audience & grow your business"
                },
                // makininch ------------------------------------------
                {
                    name:"ConstantContact",
                    image: "/images/integrations/contantcontact.png",
                    description: "Own the relationship with your audience & grow your business"
                },  
                {
                    name:"SendinBlue",
                    image: "/images/integrations/sendinBlue.png",
                    description: "Own the relationship with your audience & grow your business"
                },  
                {
                    name:"Ontraport",
                    image: "/images/integrations/ontraport.png",
                    description: "Own the relationship with your audience & grow your business"
                },  
                {
                    name:"MarketHero",
                    image: "/images/integrations/markethero.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                {
                    name:"sendiio",
                    image: "/images/integrations/sendiio.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Adobe Campaign - Premium",
                    image: "/images/integrations/AdobeCampaignPremium.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Adobe Campaign - Standard",
                    image: "/images/integrations/AdobeCampaignStandard.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Amazon SES",
                    image: "/images/integrations/Amazon.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Automizy",
                    image: "/images/integrations/Automizy.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Braze (Appboy)",
                    image: "/images/integrations/Braze.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Campaign Monitor",
                    image: "/images/integrations/CampaignMonitor.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Cheetah Digital",
                    image: "/images/integrations/Cheetah.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Chook",
                    image: "/images/integrations/Chook.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Doppler",
                    image: "/images/integrations/Doppler.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Drip",
                    image: "/images/integrations/Drip.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Newsletters for WordPress",
                    image: "/images/integrations/WordPress.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Emarsys",
                    image: "/images/integrations/Emarsys.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Emma",
                    image: "/images/integrations/Emma.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Exponea",
                    image: "/images/integrations/Exponea.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Facebook",
                    image: "/images/integrations/Facebook.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"GrooveMail",
                    image: "/images/integrations/GrooveMail.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"HubSpot Professional / Enterprise",
                    image: "/images/integrations/HubSpot.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"InfusionSoft (Keap)",
                    image: "/images/integrations/InfusionSoft.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Inxmail",
                    image: "/images/integrations/Inxmail.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Iterable",
                    image: "/images/integrations/Iterable.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                    {
                    name:"Klaviyo",
                    image: "/images/integrations/Klaviyo.png",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"Lemlist",
                    image: "/images/integrations/Lemlist.png",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"LISTRAK",
                    image: "/images/integrations/LISTRAK.webp",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"MailerLite",
                    image: "/images/integrations/MailerLite.webp",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"Mailgun",
                    image: "/images/integrations/Mailgun.png",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"MailPoet for WordPress",
                    image: "/images/integrations/MailPoet.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"Omnisend",
                    image: "/images/integrations/Omnisend.jpg",
                    description: "Own the relationship with your audience & grow your business"
                },    {
                    name:"Pardot",
                    image: "/images/integrations/Pardot.png",
                    description: "Own the relationship with your audience & grow your business"
                },
                  {
                    name:"Rejoiner",
                    image: "/images/integrations/Rejoiner.png",
                    description: "Own the relationship with your audience & grow your business"
                },
              
            ]
        
        }
    },components: { 
    },
    computed: {
        icon(){
            let index = this.options.findIndex(item => item.value === this.value );
            if(index != -1)
                return (this.options[index].icon)? this.options[index].icon:false

        },
        image(){
            let index = this.options.findIndex(item => item.name === this.value );
            if(index != -1)
                return (this.options[index].image)?this.options[index].image:false

        },
        value_(){
            return (this.value)?this.value:this.label;
        }
    },
    methods: { 
        selected(option){
            this.$emit('input', option.name);
            this.open = false

        }
    
    },
  
    mounted() { 
       
      
    },
}

</script>
<style lang="scss" scoped>
.vSelect__{    
    cursor: pointer;
    position: relative;
    border-radius: 0px;
    padding-left: 10px;
    padding-right: 10px;    
    border: 1px solid rgba(0, 0, 0, 0.2);;
    text-align: left;
    height: 45px;
    line-height: 45px;
    margin-top: 10px;
    margin-bottom: 10px;
    background: #eaeaea !important;
    border: 1px solid #eaeaea !important;
    height: 45px !important;
    &.vSelectFont{
        border-radius: 0px;
        height: 30px;
        line-height: 40px;
        font-size: 16px;
        background: #fff;
        color: black !important;
        .img{            
            height: 20px;
            margin-top: 4px;            
            float: left;
            margin-right: 10px;
            &.img_{
                
                width: 30px;
            }
        }
        .icn_{
            font-size: 20px;            
            color: var(--vprimary) !important;
            float: left;
            margin-right: 10px;
        }
        .el_ {            
            position: absolute;
            right: 5px;
            top: 0px;
            font-size: 18px;
        }
    }

}
.vSelect-options{
    position: absolute;
    width: calc(100% - 9px);
    top: 51px;
    left: 4px;
    max-height: 150px;
    overflow: auto;
    background: #fff;
    box-shadow: 0 0 5px #0000005c;
    border-radius: 6px;
    z-index: 9;    
    padding: 12px 0px;
     img{
    height: 20px;        
    }

    
}

.vSelect-options li{
    display: block;
    height: 35px;
    line-height: 35px;
    padding-left: 10px;
    padding-right: 10px;
    list-style: none;    
    height: 30px;
    width: 100%;
}
.vSelect-options li{
    float: left;
    line-height: 20px;
}
.vSelect-options li:hover, .vSelect-options li.active {
    background: azure
}
.vSelect-options span.active{
    // background: #806ff6;
    // color: #fff;
}
.arrow_down{
    float: right;
    transform: rotate(90deg);
    font-size: 20px;
    color: #8b8888;
    position: relative;
    top: -0px;
}
.arrow_up{
    transform: rotate(-90deg);
}
._selected{
    display: block;
}

.selectedd{
    position: relative;
    i{
        float: left;        
        line-height: 45px;
        padding-right: 10px;        
        font-size: 22px;
    }
}

</style>
