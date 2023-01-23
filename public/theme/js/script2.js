
// import axios from 'axios'
let token = document.head.querySelector('meta[name="csrf-token"]');
const ax = axios
ax.defaults.headers.common['X-CSRF-TOKEN'] = token.content

Vue.use(VueQuillEditor);
  var app = new Vue({
    el: "#app",
    data() {
      return {  
        settings:{} , 
      };
    },
    computed:{
        course(){
            return window.course
        }

    },
    methods: {
        save(){
            ax.post('/pages/save/sales/'+ this.course.id, {settings: this.settings})
            .then(response => {
                alert("Saved");
            })
        },
        trash_item(list, i){
            list.splice(i,1)
        },
        add_item(list){
            list.push('Item')
        },
        async upload_image(evt){
            var this_ = this
            var file    = this.$refs.image;
            let reader = new FileReader();
            if(file.files[0]) {
                reader.onload = ()  => {
                this_.settings.topbar.backgrounImage = reader.result
            }
            reader.readAsDataURL(file.files[0]);
            }

        },
        change_video(){

        }
     
    },
    mounted(){
        this.settings = window.settings.settings
        console.log("🚀 ~ file: script2.js ~ line 78 ~ mounted ~ this.settings", this.settings)
    }
  });