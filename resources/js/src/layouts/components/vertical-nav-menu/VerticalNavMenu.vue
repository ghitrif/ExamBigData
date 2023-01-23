<!-- =========================================================================================
  File Name: VerticalNavMenu.vue
  Description: Vertical NavMenu Component
  Component Name: VerticalNavMenu
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="parentx" v-if="$route.name != 'Interactives' && $route.name != 'FunnelPreview'">
    <vs-sidebar
      class="v-nav-menu items-no-padding"
      id="vs-sidebar"
      v-model="isVerticalNavMenuActive"
      ref="verticalNavMenu"
      default-index="-1"
      :click-not-close="clickNotClose"
      :reduce-not-rebound="reduceNotRebound"
      :parent="parent"
      :hiddenBackground="clickNotClose"
      :reduce="reduce"
      v-hammer:swipe="onMenuSwipe">

      <div @mouseenter="mouseEnter" @mouseleave="mouseLeave">

        <!-- Header -->
        <div class="header-sidebar flex items-end justify-between" slot="header">

          <!-- Logo -->
          <router-link tag="div" class="vx-logo cursor-pointer flex items-center" to="/">
            <logo class=" mr-4 fill-current text-primary" />
            <!-- <span class="vx-logo-text text-primary" v-show="isMouseEnter || !reduce" v-if="title">{{ title }}</span> -->
          </router-link>
          <!-- /Logo -->

          <!-- Menu Buttons -->
          <div>
            <!-- Close Button -->
            <template v-if="showCloseButton">
              <feather-icon icon="XIcon" class="m-0 cursor-pointer" @click="$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)" />
            </template>

            <!-- Toggle Buttons -->
            <!-- <template v-else-if="!showCloseButton && !verticalNavMenuItemsMin">
              <feather-icon
                id="btnVNavMenuMinToggler"
                class="mr-0 cursor-pointer"
                :icon="reduce ? 'CircleIcon' : 'DiscIcon'"
                svg-classes="stroke-current text-primary"
                @click="toggleReduce(!reduce)" />
            </template> -->
          </div>
          <!-- /Menu Toggle Buttons -->
        </div>
        <!-- /Header -->

        <!-- Header Shadow -->
        <div class="shadow-bottom" v-show="showShadowBottom" />

        <!-- Menu Items -->
        <component :is="scrollbarTag" ref="verticalNavMenuPs" class="scroll-area-v-nav-menu pt-2" :settings="settings" @ps-scroll-y="psSectionScroll" @scroll="psSectionScroll" :key="$vs.rtl">
          <template v-for="(item, index) in menuItemsUpdated">

            <!-- Group Header -->
            <span v-if="item.header && !verticalNavMenuItemsMin" class="navigation-header truncate" :key="`header-${index}`">
              {{ item.header }}
            </span>
            <!-- /Group Header -->

            <template v-else-if="!item.header">

              <!-- Nav-Item -->
              <v-nav-menu-item
                v-if="!item.submenu"
                :key="`item-${index}`"
                :index="index"
                :to="item.slug !== 'external' ? item.url : null"
                :href="item.slug === 'external' ? item.url : null"
                :icon="item.icon" :target="item.target"
                :typeIcon="item.typeIcon" 
                :isDisabled="item.isDisabled"
                :slug="item.slug">
                  <span v-show="!verticalNavMenuItemsMin" class="truncate">{{ item.name }}</span>
                  <vs-chip class="ml-auto" :color="item.tagColor" v-if="item.tag && (isMouseEnter || !reduce)">{{ item.tag }}</vs-chip>
              </v-nav-menu-item>
              
              

              <!-- Nav-Group -->
              <template v-else>
                <v-nav-menu-group
                  :key="`group-${index}`"
                  :openHover="openGroupHover"
                  :typeIcon="item.typeIcon" 
                  :group="item"
                  :groupIndex="index"
                  :open="item.open" />
              </template>
              <!-- /Nav-Group -->
            </template>
          </template>
        </component>
        <!-- /Menu Items -->
      </div>


      <a target="blank_" href="/" class="_support">
          <feather-icon  icon="HelpCircleIcon" />
      </a>

      <div class="_profil"  v-click-outside="hide" @click="toggle" >

      <span class="_circle">A</span>
      <span>My account</span>

      </div>
      <div class="_menu scale-in-left" v-if="opened" >
        <div class="profile_details" >          
          <li class="_name">HI, {{user.name}}👋</li>
          <li class="_email">{{user.email}}</li>
        </div>

        
        <div class="_listItems" style="
    padding-bottom: 10px;
    border-bottom: 1px solid #0000003d;" >          
          <a href="/MyAccount">My Account</a>  
        </div>       
         <div class="_listItems "  style="
    padding-bottom: 10px;
    border-bottom: 1px solid #0000003d;" >
           <span class="_org">Your Oranization</span>          
                 
          <a href="/Whitelabel#brand">Whitelabel</a>
          <a href="/Whitelabel#smtp">SMTP Settings</a>
          <a href="/MyAccount#smtpEmail">SMTP Email Settings</a>
          <a href="/Reseller">Manage Users</a>        
          <a href="/Team">Manage Team</a>
        </div>

         <div class="_listItems "  >
           <a href="https://videra.on.spiceworks.com">Support</a>
           <a href="/logout">Logout</a>

         </div>

      </div>
    </vs-sidebar>
    

    <!-- Swipe Gesture -->
    <div
      v-if="!isVerticalNavMenuActive"
      class="v-nav-menu-swipe-area"
      v-hammer:swipe="onSwipeAreaSwipe" />
    <!-- /Swipe Gesture -->
  </div>
</template>


<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import VNavMenuGroup from './VerticalNavMenuGroup.vue'
import VNavMenuItem from './VerticalNavMenuItem.vue'

import ClickOutside from 'vue-click-outside'
import Logo from '../Logo.vue'

export default {
  name: 'v-nav-menu',
  components: {
    VNavMenuGroup,
    VNavMenuItem,
    VuePerfectScrollbar,
    Logo,
    ClickOutside
  },
  props: {
    logo:             { type: String },
    openGroupHover:   { type: Boolean, default: false },
    parent:           { type: String },
    reduceNotRebound: { type: Boolean, default: true },
    navMenuItems:     { type: Array,   required: true },
    title:            { type: String }
  },
  data: () => ({
    btnTopmenu:{
      Course:"white",
      btnDFY:"white",
      btnUnlimitedTraffic:"white",
    },
    maxRole:0,
      opened: false,
    clickNotClose       : false, // disable close navMenu on outside click
    isMouseEnter        : false,
    reduce              : false, // determines if navMenu is reduce - component property
    showCloseButton     : false, // show close button in smaller devices
    settings            : {      // perfectScrollbar settings
      maxScrollbarLength: 60,
      wheelSpeed        : 1,
      swipeEasing       : true
    },
    showShadowBottom    : false
  }),
  computed: {
    user(){
      return window.user
    },
    isGroupActive () {
      return (item) => {
        const path        = this.$route.fullPath
        const routeParent = this.$route.meta ? this.$route.meta.parent : undefined
        let open          = false

        const func = (item) => {
          if (item.submenu) {
            item.submenu.forEach((item) => {
              if (item.url && (path === item.url || routeParent === item.slug)) { open = true } else if (item.submenu) { func(item) }
            })
          }
        }
        func(item)
        return open
      }
    },
    menuItemsUpdated () {
      const clone = this.navMenuItems.slice()

      for (const [index, item] of this.navMenuItems.entries()) {
        if (item.header && item.items.length && (index || 1)) {
          const i = clone.findIndex(ix => ix.header === item.header)
          for (const [subIndex, subItem] of item.items.entries()) {
            clone.splice(i + 1 + subIndex, 0, subItem)
          }
        }
      }

      return clone
    },
    isVerticalNavMenuActive: {
      get ()    { return this.$store.state.isVerticalNavMenuActive },
      set (val) { this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', val) }
    },
    layoutType () { return this.$store.state.mainLayoutType },
    reduceButton: {
      get ()    { return this.$store.state.reduceButton },
      set (val) { this.$store.commit('TOGGLE_REDUCE_BUTTON', val) }
    },
    isVerticalNavMenuReduced () { return Boolean(this.reduce && this.reduceButton) },
    verticalNavMenuItemsMin ()  { return this.$store.state.verticalNavMenuItemsMin },
    scrollbarTag ()             { return this.$store.getters.scrollbarTag          },
    windowWidth ()              { return this.$store.state.windowWidth             }
  },
  watch: {
    '$route' () {
      if (this.isVerticalNavMenuActive && this.showCloseButton) this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)
    },
    reduce (val) {
      const verticalNavMenuWidth = val ? 'reduced' : this.$store.state.windowWidth < 1200 ? 'no-nav-menu' : 'default'
      this.$store.dispatch('updateVerticalNavMenuWidth', verticalNavMenuWidth)

      setTimeout(function () {
        window.dispatchEvent(new Event('resize'))
      }, 100)
    },
    layoutType ()   { this.setVerticalNavMenuWidth() },
    reduceButton () { this.setVerticalNavMenuWidth() },
    windowWidth ()  { this.setVerticalNavMenuWidth() }
  },
  directives: {
    ClickOutside
  },
  methods: {
    toggle () {
      this.opened = true
    },
 
    hide () {
      this.opened = false
    },
    onMenuSwipe (event) {
      if (event.direction === 4 && this.$vs.rtl) {

        // Swipe Right
        if (this.isVerticalNavMenuActive && this.showCloseButton) this.isVerticalNavMenuActive = false

      } else if (event.direction === 2 && !this.$vs.rtl) {

        // Swipe Left
        if (this.isVerticalNavMenuActive && this.showCloseButton) this.isVerticalNavMenuActive = false
      }
    },
    onSwipeAreaSwipe (event) {

      if (event.direction === 4 && !this.$vs.rtl) {

        // Swipe Right
        if (!this.isVerticalNavMenuActive && this.showCloseButton) this.isVerticalNavMenuActive = true
      } else if (event.direction === 2 && this.$vs.rtl) {

        // Swipe Left
        if (!this.isVerticalNavMenuActive && this.showCloseButton) this.isVerticalNavMenuActive = true
      }
    },
    psSectionScroll () {
      const scroll_el = this.$refs.verticalNavMenuPs.$el || this.$refs.verticalNavMenuPs
      this.showShadowBottom = scroll_el.scrollTop > 0
    },
    mouseEnter () {
      if (this.reduce) this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', false)
      this.isMouseEnter = true
    },
    mouseLeave () {
      if (this.reduce) this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', true)
      this.isMouseEnter = false
    },
    setVerticalNavMenuWidth () {

      if (this.windowWidth > 1200) {
        if (this.layoutType === 'vertical') {

          // Set reduce
          this.reduce = !!this.reduceButton

          // Open NavMenu
          this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)

          // Set Menu Items Only Icon Mode
          const verticalNavMenuItemsMin = !!(this.reduceButton && !this.isMouseEnter)
          this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', verticalNavMenuItemsMin)

          // Menu Action buttons
          this.clickNotClose   = true
          this.showCloseButton = false

          const verticalNavMenuWidth   = this.isVerticalNavMenuReduced ? 'reduced' : 'default'
          this.$store.dispatch('updateVerticalNavMenuWidth', verticalNavMenuWidth)

          return
        }
      }

      // Close NavMenu
      this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)

      // Reduce button
      if (this.reduceButton) this.reduce = false

      // Menu Action buttons
      this.showCloseButton = true
      this.clickNotClose   = false

      // Update NavMenu Width
      this.$store.dispatch('updateVerticalNavMenuWidth', 'no-nav-menu')

      // Remove Only Icon in Menu
      this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', false)


      // if(this.layoutType === 'vertical' || (this.layoutType === 'horizontal' && this.windowWidth < 1200))
      // if (this.windowWidth < 1200) {

      //   // Close NavMenu
      //   this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)

      //   // Reduce button
      //   if (this.reduceButton) this.reduce = false

      //   // Menu Action buttons
      //   this.showCloseButton = true
      //   this.clickNotClose   = false

      //   // Update NavMenu Width
      //   this.$store.dispatch('updateVerticalNavMenuWidth', 'no-nav-menu')

      //   // Remove Only Icon in Menu
      //   this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', false)

      // } else {

      //   // Set reduce
      //   this.reduce = this.reduceButton ? true : false

      //   // Open NavMenu
      //   this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)

      //   // Set Menu Items Only Icon Mode
      //   const verticalNavMenuItemsMin = (this.reduceButton && !this.isMouseEnter) ? true : false
      //   this.$store.commit('UPDATE_VERTICAL_NAV_MENU_ITEMS_MIN', verticalNavMenuItemsMin)

      //   // Menu Action buttons
      //   this.clickNotClose   = true
      //   this.showCloseButton = false

      //   const verticalNavMenuWidth   = this.isVerticalNavMenuReduced ? "reduced" : "default"
      //   this.$store.dispatch('updateVerticalNavMenuWidth', verticalNavMenuWidth)
      // }
    },
    toggleReduce (val) {
      this.reduceButton = val
      this.setVerticalNavMenuWidth()
    }
  },
  mounted () {
    this.setVerticalNavMenuWidth();
    this.maxRole =  Number(this.user.role);
  }
}

</script>


<style lang="scss" >
// @import "@/assets/scss/vuexy/components/verticalNavMenu.scss"
</style>

<style lang="scss">
._support{
    position: absolute;
    bottom: 50px;
    z-index: 999999999;
    display: block;
    width: 100%;
    text-align: center;
    .feather-icon{
      margin-left: 9px;
    }
}
._menu{  
    position: absolute;
    bottom: 15px;
    left: 75px;
    z-index: 999999999;
    display: block;
    width: 300px;
    height: calc(100vh - 60px);
    text-align: center;
    padding: 8px;
    margin-top: 0px;
    background: rgb(255, 255, 255);
    z-index: 1450;
    border-radius: 8px;
    box-shadow: rgb(0 0 0 / 30%) 0px 0px 40px;
    animation: 0.1s ease-in-out 0s 1 normal none running civfrT;
    pointer-events: auto;
    max-width: 400px;
    min-width: 200px;
    padding: 20px;
    .profile_details{
      text-align: left;      
      padding-bottom: 10px;
      border-bottom: 1px solid #0000003d;
      li{
        list-style: none;
        padding: 0px;
        margin: 0px;
      }
      ._name{
        color: var(--vprimary);
      }

    }

    ._listItems{
      text-align: left;
      ._org{
        color: var(--vprimary);
        margin-top: 15px;
        display: block;
        width: 100%;
      }
      a{        
        letter-spacing: -0.1px;    
        font-weight: 400 !important;
        color: #111111 !important;
        opacity: 1 !important;        
        display: block;
        padding: 6px 10px;
        &:visited, &:focus{
          color: #111111 !important;
        }
        &:hover{
          color:var(--vprimary) !important;
          background: #7d00fe12;
        }
      }
    }

}
._profil{
    position: absolute;
    bottom: 5px;
    z-index: 999999999;
    display: block;
    width: 100%;
    height: 40px;
    text-align: center;
    width: 226px;
    text-align: left;
    color: #fff;
    padding-left: 10px;
    ._circle{
          background: #fff;
          height: 40px;
          width: 40px;
          border-radius: 50%;
          line-height: 40px;
          color: var(--vprimary);;
          margin: 0 auto;
          cursor: pointer;
          display: inline-block;
          text-align: center;

    }
}
.navel{
  font-size: 22px;
    margin-right: 9px;
}
.ps-container{  
    overflow: visible !important;
}
.vs-sidebar-group{
  color: #fff;
  opacity: .8;
  overflow: hidden;
  cursor: pointer;

    .vs-sidebar-group-items{
      max-height: none;
      background: #ffffff42;
      margin: 10px 20px;
      border-radius: 6px;
    }
  .group-header{   
    padding-left: 21px;
    font-weight: 600;
    font-size: .85rem;
    position: relative;
    .feather-icon{
      margin-right: 9px;
    }
    .feather-grp-header-arrow{
      position: absolute !important;
      right: 0px;
      top: 0px;
      cursor: pointer;
      &:hover{
        opacity: 1;
      }

    }
  }
}
</style>
