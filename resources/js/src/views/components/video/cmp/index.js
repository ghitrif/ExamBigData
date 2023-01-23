
import ButtonComponent from './ButtonComponent.vue'
import BlockTitle from './BlockTitle.vue'
import colorInput from './colorInput.vue'
import fontSelector from './fontSelector.vue'
import MediaFile from './MediaFile.vue'
import Optin from './Optin.vue'
import Timer from './Timer.vue'
import embedCode from './embedCode.vue'
import Map from './Map.vue'
import Share from './Share.vue'
import Submit from './submit.vue'
import ImageComponent from './ImageComponent.vue'
import YoutubeComponent from './YoutubeComponent.vue'
export default Vue => {    
    Vue.component("ButtonComponent", ButtonComponent)
    Vue.component("colorInput", colorInput)
    Vue.component("fontSelector", fontSelector)
    Vue.component("MediaFile", MediaFile)
    Vue.component("BlockTitle", BlockTitle)
    Vue.component("Optin", Optin)
    Vue.component("Timer", Timer)
    Vue.component("embedCode", embedCode)
    Vue.component("Map", Map)
    Vue.component("Share", Share)
    Vue.component("Submit", Submit)
    Vue.component("ImageComponent", ImageComponent)
    Vue.component("YoutubeComponent", YoutubeComponent)
  }