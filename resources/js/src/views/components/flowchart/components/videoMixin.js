
import { mapGetters, mapActions } from "vuex";
export default {
    data () {
        return {
            src: '/videos/video.mp4',
            video:{
              type:false,
              audio:true,
              video:true,
              text:true,
              payment_type:false,
              delay:0,
              limit:120,
              answers:[],
              btnText:"Action text",
              btnDescription:"How would you like to answer?",
              appointmentLink:""
            },
            rtabs:"Answer",
            editVideo:false,
          }
    },
    computed:{
        answer_type(){
            return   [
                  { value: "Open Ended", icon:"video-chat" },
                  // { value: "Voice", icon:"microphone" },
                  { value: "Optin Form", icon:"branding" },
                  { value: "Payment", icon:"credit-card" },
                  { value: "File Upload", icon:"upload-cloud" },
                  { value: "Multiple Choices", icon:"server" },
                  { value: "Call To Action", icon:"action" },
                  { value: "Youtube", icon:"youtube" },
                  { value: "Calendar", icon:"calendar" },
                  { value: "NPS", icon:"smiling-emoticon-square-face" },
                  { value: "Timer", icon:"timer" },
                  { value: "Map", icon:"map" },
                  { value: "Custom Code", icon:"code" },
                ] 
      
          },
          payment_type(){
            return   [
                  { value: "Stripe", image:"/images/integrations/stripe.svg" },
                  { value: "Paypal", image:"/images/integrations/paypal.svg" },
                ] 
      
          },

    },
    created: function () {
    },
    methods: {

      ...mapActions([ "SaveFunnelVideo", "DeleteFunnelVideo", "trashAnswer"]),
     async saveVideo(){
       
      this.$vs.loading({type:"sound"})
       let res = await this.SaveFunnelVideo(this.node)
       this.$vs.loading.close()
       this.$vs.notify({title:'Success',text:'Saved Successfully',color:'success'})
       this.editVideo=false
      },
      async trashVideo(){
        
      let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
      if (!result.isConfirmed)
          return false
        let res = await this.DeleteFunnelVideo(this.node.id)
        location.reload()

      },
      addAnswer() {
            this.node.nodes.push({id:0, text:"text", sort:0, answer:1})
       },
       async trashAnswer_(answer, i){
         if(answer.video_id && answer.id){
          this.$vs.loading({type:"sound"})
           let res =  await this.trashAnswer(answer)
           this.$vs.loading.close()
         }
        this.node.nodes.splice(i,1)
       }
    }
 }