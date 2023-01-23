<template>
    <div class="courseSettings rightP_" style="    margin: 20px;
    background: #fff;
    padding: 20px;
    margin-top: 0px;
    height: calc(100vh - 21px);
    border-radius: 10px;">
        <div style="height:45px"> 
            <vs-input v-model="search" style="max-width:300px; float:right" icon="search" placeholder="Search" /> 
            <span style="margin: 0px;
    margin-right: 10px;
    height: 38px;" class="actions addFolder" @click="popup=true" ><i class="el plus"></i> Add New Membre</span>
        </div>
        <main class="ui__main">
            <table class="file-list" id="file-table">
                <tr class="file-list__header">
                    <th >Name <i class="fa fa-long-arrow-down"></i></th>
                    <th width="300" >Email</th>
                    <th width="150">Date Created</th>
                    <th width="150">Actions</th>
                </tr>
            </table>
                <div   style="height: calc(100vh - 235px );overflow: auto;
    overflow-x: hidden;width:100%">
                <div class="emptyTable" v-if="!users.length">
                    <i class="el users"></i><br><br>
                    <h5>No user</h5>

                </div>
            <table class="file-list" id="file-table" v-else>
                <tr class="file-list__file" v-for="(user,i) in filtred_users" :key="i">
                    <th >
                        <div>{{user.name}}</div>                                               
                        </th>
                    <th width="300" >
                        <div>{{user.email}}</div>
                        
                    </th>
                    <th width="150">{{user.created_at | onlyDate}}</th>                    
                    <th width="200" class="tableActions">                        
                      <i @click="trash(user)" class="el trash" title="Delete"></i>
                    </th>
                </tr>
            </table>
                </div>
        </main>
            <vs-popup class="holamundo"  title="" :active.sync="popup">
                <form v-on:submit.prevent="onSubmit">
                    <span>Name:</span>
                    <input v-model="user.name" required type="text" class="form-control mb-3">
                    <span>Email:</span>
                    <input v-model="user.email" required type="email" class="form-control mb-3">
                    <span>Password:</span>
                    <input v-model="user.password" required type="password" class="form-control mb-3">
                    <Submit text="Invite" style="float: right;" />
                </form>

            </vs-popup>
  
    </div>
</template>

<script>
import Vue from 'vue'
import excel from 'vue-excel-export'
 
Vue.use(excel)
import { mapGetters, mapActions } from "vuex";
export default {
  props: ['course'],
  data() {
    return {
        search:"",
        popup:false,
        users:[],
        user:{
         email:"",
        name:"",
        password:""
        }
        
    };
  },
  components: {
  },
  computed: {
      filtred_users(){
          let search = this.search.toLowerCase()
          if(this.search != '')
            return this.users.filter(itms =>  ((itms.email.toLowerCase()).includes(search) || (itms.email.toLowerCase()).includes(search) ) );
          return this.users
      }
  },
  filters: {
  onlyDate: function (value) {
    if (!value) return ''
    value = value.toString()
    return value.substring(0, 10)
  },
  },
  methods: {
    ...mapActions(["GetTeamUsers", "InviteUser","DeleteUser"]),
  
      rechercherUser(id){
        let i=0;
       for (i=0;i<this.users.length;i++){
            if(this.users[i].id==id)
               return i;
        }
        return -1;
    },
    async trash(c){    
        let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
        if (!result.isConfirmed)
            return false
        this.$vs.loading({type:"sound"})  
        let res = await this.DeleteUser(c)
        this.$vs.loading.close() 
        if(res.status == 1){
             let pos=this.rechercherUser(c.id);
            this.users.splice(pos,1)
             this.$vs.notify({title:'Success',text:'User deleted Successfully',color:'success'})
        }
        else
         this.$vs.notify({title:'Error',text: res.message,color:'danger'});
    },
    async _getTeamUsers(){ 
        this.$vs.loading({type:"sound"})       
        let res = await this.GetTeamUsers()
        this.$vs.loading.close() 
        this.users = res.data
    },
    async onSubmit(){ 
        this.$vs.loading({type:"sound"})       
        let res = await this.InviteUser(this.user)
        this.$vs.loading.close()
        if(res.status==1){
            this.users.push(res.data)
            this.popup = false
            this.user.email="";
            this.user.name="";
            this.user.password="";
            this.$vs.notify({title:'Success',text:'Team membre Successfully',color:'success'})
        }
        else{
            
            this.$vs.notify({title:'Error',text: res.errors ,color:'danger'})
        }

    }
  },
  beforeCreate(){
      if(window.user.typeUser!="user"){
          this.$router.push("/Upgrade")
      }
  },
   mounted() {  
      this._getTeamUsers()        
  },
};
</script>
<style lang="scss" scoped>

  .usersRoles{
      span{
        display: inline-block;
        padding: 2px 10px;
        border-radius: 11px;
        margin: 2px 2px;
      }
  }

</style>