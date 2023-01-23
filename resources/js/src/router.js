import Vue from 'vue'
import Router from 'vue-router'

import store from './store/store'
Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes: [

    {
      // =============================================================================
      // MAIN LAYOUT ROUTES
      // =============================================================================
      path: '',
      component: () => import('./layouts/main/Main.vue'),
      children: [
        // =============================================================================
        // Theme Routes
        // =============================================================================
        {
          path: '/',
          name: 'home',
          component: () => import('@/views/pages/Home.vue')
        }, 

        {
          path: '/MyAccount',
          name: 'MyAccount',
          component: () => import('@/views/pages/Account.vue')
        }, 
        {
          path: '/Team',
          name: 'Team',
          component: () => import('@/views/pages/Team.vue')
        },
        
       
        
      ]
    },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
    {
      path: '',
      component: () => import('@/layouts/full-page/FullPage.vue'),
      children: [
        // =============================================================================
        // PAGES
        // =============================================================================
        {
          path: '/login',
          name: 'page-login',
          component: () => import('@/views/pages/Login.vue')
        },
        {
          path: '/error-404',
          name: 'page-error-404',
          component: () => import('@/views/pages/Error404.vue')
        },
     
        
      ]
    },
    // Redirect to 404 page, if no match found
    {
      path: '*',
      redirect: '/error-404'
    },
  ]
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

router.beforeEach( async (to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    // if (store.getters.isLoggedIn) {
      
      if(to.matched.some(record => record.meta.role) ){
        const role = to.meta.role
        const resp = await store.dispatch('fetchUser', {role:role})
        if(role > resp.role && role != null  )          
            next('/upgrade')
        else          
          next()
      }else
      next()
      return
    // }
    // next('/login') 
  } else {
    next() 
  }
})
export default router
