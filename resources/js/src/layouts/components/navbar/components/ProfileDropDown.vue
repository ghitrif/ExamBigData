<template>
  <div class="the-navbar__user-meta flex items-center" >

    <div class="text-right leading-tight hidden sm:block">
      <p class="font-semibold">{{ user.name }}</p>
    </div>

    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">

      <div class="con-img ml-3">
        <img  key="onlineImg" :src="user.image" alt="user-img" width="40" height="40" class="rounded-full shadow-md cursor-pointer block" />
      </div>

      <vs-dropdown-menu class="vx-navbar-dropdown">
        <ul style="min-width: 9rem">

          <li
            class="flex py-2 px-4 cursor-pointer  ">
            <a href="/MyAccount">
            <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">My Account</span>
            </a>
          </li>
          
          <li
            class="flex py-2 px-4 cursor-pointer  ">
            <a href="/Training">
            <i class="el archive"></i>
            <span class="ml-2">Training</span>
            </a>
          </li>
            <li
            class="flex py-2 px-4 cursor-pointer  ">
            <a href="https://coursempire.on.spiceworks.com/portal" target="blank_">
            <i class="el users"></i>
            <span class="ml-2">Support</span>
            </a>
          </li>

          

        
          <vs-divider class="m-1" />

          <li
            class="flex py-2 px-4 cursor-pointer  ">
            <a href="/logout">
            <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">Logout</span>
            </a>
          </li>
        </ul>
      </vs-dropdown-menu>
    </vs-dropdown>
  </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";
export default {
  data () {
    return {

    }
  },
  computed: {
    ...mapGetters(["user"]),
    user(){
      return window.user
    },
    activeUserInfo () {
      return {name:"gg", image:""}
    }
  },
  methods: {
    logout () {

      // Change role on logout. Same value as initialRole of acj.js
      this.$acl.change('admin')
      localStorage.removeItem('userInfo')

      // This is just for demo Purpose. If user clicks on logout -> redirect
      this.$router.push('/pages/login').catch(() => {})
    }
  }
}
</script>
