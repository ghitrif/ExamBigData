<template>
    <div class="courseSettings rightP_" >
        <div style="height:45px"> 
            <vs-input style="max-width:300px; float:right" icon="search" v-model="search" placeholder="Search" /> 
            <span style="margin: 0px;margin-right: 10px;height: 38px;" class="actions addFolder"  @click="create" >
                <i class="el plus"> </i> Add New User
            </span>
            <export-excel class="EXportExcel" :data="filtred_users"> <i class="el  download-cloud" ></i> Export Users </export-excel>      
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
                    <h5>No Users</h5>
                    <p>You have not create any user yet</p>

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
                      <i @click="edit(user)" class="el edit-3" title="Edit"></i>
                      <i @click="trash(user)" class="el trash" title="Delete"></i>
                    </th>
                </tr>
            </table>
                </div>
        </main>
    

    <vs-popup class="holamundo"  :title="popup_title" :active.sync="IsCreate">
      <form v-on:submit.prevent="submit">
        <small style="color:red" v-if="errors.hasOwnProperty('name')">{{ errors['name'][0] }}</small> 
        <vs-input required class="inputx" placeholder="Name" v-model="user.name"/>

        <small style="color:red" v-if="errors.hasOwnProperty('email')">{{ errors['email'][0] }}</small> 
        <vs-input required class="inputx" placeholder="Email" v-model="user.email"/>  

        <small style="color:red" v-if="errors.hasOwnProperty('password')">{{ errors['password'][0] }}</small> 
        <vs-input required  class="inputx" placeholder="Password" v-model="user.password"/>

        <fieldset class="vfieldset">
            <legend class="vlegend">Roles</legend>
            <small style="color:red" v-if="errors.hasOwnProperty('roles')">{{ errors['roles'][0] }}</small>
            <div v-for="(role, i) in roles" :key="i">
                <input :value="role.id" v-model="user.roles" type="checkbox"> <b class="ml-3">{{role.name}}</b>
            </div>
        </fieldset>
        <Submit style="float: right;" />
      </form>
    </vs-popup> 
        <vs-popup class="holamundo"  :title="popup_title" :active.sync="IsEdit">
      <form v-on:submit.prevent="update">
        <small style="color:red" v-if="errors.hasOwnProperty('name')">{{ errors['name'][0] }}</small> 
        <vs-input required class="inputx" placeholder="Name" v-model="UpdateUser.name"/>

        <small style="color:red" v-if="errors.hasOwnProperty('email')">{{ errors['email'][0] }}</small> 
        <vs-input required class="inputx" type="email" placeholder="Email" v-model="UpdateUser.email"/>  

        <small style="color:red" v-if="errors.hasOwnProperty('password')">{{ errors['password'][0] }}</small> 
        <vs-input required  class="inputx" placeholder="Password" v-model="UpdateUser.password"/>
         
        <fieldset class="vfieldset" v-if="IsEdit">
            <legend class="vlegend">Roles</legend>
            <small style="color:red" v-if="errors.hasOwnProperty('roles')">{{ errors['roles'][0] }}</small>
            <div v-for="(role, i) in roles" :key="i" >
                   <!-- <input  :value="role.id"    type="checkbox" v-if="testRole(role.id)=='1'" checked />  
                   <input  :value="role.id"      type="checkbox" v-if="testRole(role.id)=='0'"  />   -->
                  <input  :value="role.id" v-model="UpdateUser.roles"  :name="role.name" type="checkbox"   />  
                  <label :for="role.name"><b class="ml-3">{{role.name}}</b></label> 
            </div>
        </fieldset>
        <Submit style="float: right;" />
      </form>
    </vs-popup>
    </div>
</template>

<script>
import Vue from 'vue'
import excel from 'vue-excel-export'
 
Vue.use(excel)
import { mapGetters, mapActions } from "vuex";
import { object } from '@amcharts/amcharts4/core';
export default {
  props: ['course'],
  data() {
    return {
        indexUpdate:-1,
        search:"",
        UpdateUser:{
          id:"",
          email:"",
          name:"",
          roles:[],
          password:""
        },
        IsEdit:false,
        IsCreate:false,
        popup_title:"Add New User",
        users:[],
        errors:[],
        user:{
            id:0,
            name:"",
            email:"",
            password:"",
            roles:[],
            
            
        }
    };
  },
    filters: {
        onlyDate: function (value) {
        if (!value) return ''
        value = value.toString()
        return value.substring(0, 10)+" "+value.substring(11, 19)
  },
  },
  components: {
  },
  computed: {
      filtred_users(){
          let res = this.users;
          if(this.search!="")
           res=res.filter(user =>  ((user.email.toLowerCase()).includes(this.search) || (user.name.toLowerCase()).includes(this.search) ) );

          return res
      },

  },
  methods: {
    ...mapActions(["CreateUser","DeleteUser", "getUser", "getUsers","EditUser"]),
    async update(){
        
        this.errors = []
        if(!this.UpdateUser.roles.length){
            this.errors = {roles:["Please select at least one role"]}
            return false
        }
        this.$vs.loading({type:"sound"})  
        let res = await this.EditUser(this.UpdateUser) 
        this.$vs.loading.close() 
        if(res.status != 1){
            this.errors = res.errors
            return true
        }        
        this.users[this.indexUpdate].name=this.UpdateUser.name;
        this.users[this.indexUpdate].email=this.UpdateUser.email;
        this.users[this.indexUpdate].roles=[];
        let i;
         this.UpdateUser.roles.forEach(element => {
             let rol = {
                id: element,
             }
             this.users[this.indexUpdate].roles.push(rol);
         });
         console.log( this.users[this.indexUpdate].roles)
        this.$vs.notify({title:'Success',text:'User Update Successfully',color:'success'})
        this.IsEdit=false;
        this.indexUpdate=-1;
        this.UpdateUser.id="";
        this.UpdateUser.name="";
        this.UpdateUser.email="";
        this.UpdateUser.roles=[];
    },
    testRole: function(id){   
        
        let i=0;
        for (i=0;i<this.UpdateUser.roles.length;i++){
            if(this.UpdateUser.roles[i].id==id)
                        return true;
        }
        return false;   
    },
    rechercherUser(id){
        let i=0;
       for (i=0;i<this.users.length;i++){
            if(this.users[i].id==id)
               return i;
        }
        return -1;
    },
    async create()
    {
        this.popup_title = "Add New User"
        this.IsCreate=true
        
    },
    
    async edit(user){
        this.errors = []
        let pos=this.rechercherUser(user.id);
        this.popup_title = "Edit User"
        this.indexUpdate=pos;
        this.UpdateUser.id="";
        this.UpdateUser.name="";
        this.UpdateUser.email="";
        this.UpdateUser.roles=[];
        this.UpdateUser.password="";
        this.IsEdit=true
        this.UpdateUser.id=user.id;
        this.UpdateUser.name=user.name;
        this.UpdateUser.email=user.email;
        let i=0;
        for(i=0;i<user.roles.length;i++)
           this.UpdateUser.roles.push(user.roles[i].id);

    },
    async trash(c){    
        let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
        if (!result.isConfirmed)
            return false
        this.$vs.loading({type:"sound"})  
        let res = await this.DeleteUser(c)
        this.$vs.loading.close() 
        let pos=this.rechercherUser(c.id);
      this.$vs.notify({title:'Success',text:'User deleted Successfully',color:'success'})
        if(res.status == 1){
            this.users.splice(pos,1)
        }
    },
    async submit(){
        this.errors = []
        if(!this.user.roles.length){
            this.errors = {roles:["Please select at least one role"]}
            return false
        }
        this.$vs.loading({type:"sound"})  
        let res = await this.CreateUser(this.user) 
        this.$vs.loading.close() 
        if(res.status != 1){
            this.errors = res.errors
            return true
        }        
        this.popupUser=false
        // let roles=[];
        // let i;
        // for(i=0;i<res.roles.length;i++)
        //    roles.push({"id": res.roles[i]});
        // let user = {
        //     "email" : res.user.email,
        //     "created_at" : res.user.created_at,
        //     "created_by" : res.user.created_by,
        //     "image" : res.user.image,
        //     "name" : res.user.name,
        //     "roles" : roles
        // }
        // this.users.push(user)
        this.user ={
                    id:0,
                    name:"",
                    email:"",
                    password:"",
                    roles:[]
                }
        this.load_users();
        this.$vs.notify({title:'Success',text:'User Created Successfully',color:'success'})
        this.IsCreate=false;
    },
    async load_users(){ 
        this.$vs.loading({type:"sound"})       
        let res = await this.getUsers()
        this.$vs.loading.close() 
        this.users = res.users
        this.roles = res.roles
    }
  },
   mounted() {  
       this.load_users()    
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