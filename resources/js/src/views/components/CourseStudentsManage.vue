<template>
    <div class="courseSettings" >
        <div style="height:45px"> 
            <vs-input style="max-width:300px; float:right" icon="search" placeholder="Search" />
            <span style="margin: 0px;
    margin-right: 10px;
    height: 38px;" class="actions addFolder" @click="add" ><i class="el plus"></i> Add New Student</span>        
        </div>
        <main class="ui__main">
            <table class="file-list" id="file-table">
                <tr class="file-list__header">
                    <th >Name <i class="fa fa-long-arrow-down"></i></th>
                    <th width="300" >Email</th>
                    <th width="150">Created at</th>
                    <th width="150">Actions</th>
                </tr>
            </table>
                <div  style="height: calc(100vh - 180px);overflow: auto;
    overflow-x: hidden;width:100%">
            <table class="file-list" id="file-table">
                <tr class="file-list__file" v-for="(student,i) in students" :key="i">
                    <th >{{student.name}} </th>
                    <th width="300" >{{student.email}}</th>
                    <th width="150">{{student.created_at}}</th>                    
                    <th width="200" class="tableActions">                        
                      <i @click="edit(student)" class="el edit-3" title="Edit"></i>
                      <i @click="trash(student, i)" class="el trash" title="Delete"></i>
                    </th>
                </tr>
            </table>
                </div>
        </main>
    <vs-popup class="holamundo"  :title="popup_title" :active.sync="popup">
      <form v-on:submit.prevent="submit">
        <vs-input required class="inputx" placeholder="Name" v-model="student.name"/>
        <vs-input required class="inputx" placeholder="Email" v-model="student.email"/>        
        <vs-input  class="inputx" placeholder="Password" v-model="student.password"/>
        <Submit style="float: right;" />
      </form>
    </vs-popup>
    </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";
export default {
  props: ['course'],
  data() {
    return {
        popup:false,
        students:[],
        student:false,
        popup_title:""
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["CreateStudent", "DeleteStudent", "getStudent", "getStudents"]),
    add(){
        this.popup=true
        this.popup_title = "Add New Student"
        this.student = {
            name:"",
            email:"",
            id:0,
            password:"",
            course_id:this.course_id
        }
    },
    edit(student){
        this.popup_title = "Edit Student"
        this.popup=true
        this.student = student
    },
    async trash(c, i){
      let result = await this.$Swall.fire({title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'})
      if (!result.isConfirmed)
        return false
      this.$vs.loading({type:"sound"})
      let res = await this.DeleteStudent(c)
      this.$vs.loading.close()
      if(res.status == 1){
        this.students.splice(i,1)
      }
      this.$vs.notify({title:'Success',text:'Deleted Successfully',color:'success'})
    },
    async submit(){        
        this.student.course_id = this.course.id
        this.$vs.loading({type:"sound"})
        let res = await this.CreateStudent(this.student)
        this.$vs.loading.close()          
        this.popup=false
        if(this.student.id == 0)
            this.students.push(res.data)
        
      this.$vs.notify({title:'Success',text:'Saved Successfully',color:'success'})
    },
    async load_students(){    
        this.$vs.loading({type:"sound"})    
        let res = await this.getStudents(this.$route.params.id)
        this.$vs.loading.close()
        this.students = res.data
    }
  },
   mounted() {  
       this.load_students()    
  },
};
</script>