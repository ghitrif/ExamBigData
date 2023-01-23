
import CourseBrandSettings from "./CourseBrandSettings.vue"
import CoursePaymentsSettings from "./CoursePaymentsSettings.vue"
import CourseStudentsManage from "./CourseStudentsManage.vue"
import CourseSalesManage from "./CourseSalesManage.vue"
import CourseSectionsSettings from "./CourseSectionsSettings.vue"
import CoursePagesManage from "./CoursePagesManage.vue"
import CourseDomainManage from "./CourseDomainManage.vue"
import CourseAnalyticsManage from "./CourseAnalyticsManage.vue"
import CourseStats from "./CourseStats.vue"
export default Vue => {    
    Vue.component("CourseBrandSettings", CourseBrandSettings)
    Vue.component("CoursePaymentsSettings", CoursePaymentsSettings)
    Vue.component("CourseStudentsManage", CourseStudentsManage)
    Vue.component("CourseSalesManage", CourseSalesManage)
    Vue.component("CourseSectionsSettings", CourseSectionsSettings)
    Vue.component("CoursePagesManage", CoursePagesManage)
    Vue.component("CourseDomainManage", CourseDomainManage)
    Vue.component("CourseAnalyticsManage", CourseAnalyticsManage)
    Vue.component("CourseStats", CourseStats)
  }