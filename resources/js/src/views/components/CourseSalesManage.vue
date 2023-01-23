<template>
    <div class="courseSettings" >
        <div style="height:45px"> 
            <vs-input style="max-width:300px; float:right" icon="search" placeholder="Search" />       
        </div>
        <main class="ui__main">
            <table class="file-list" id="file-table">
                <tr class="file-list__header">
                    <th >Name <i class="fa fa-long-arrow-down"></i></th>
                    <th width="200" >Email</th>
                    <th width="120" >Phone</th>
                    <th width="100" >By</th>
                    <th width="100" >Price</th>
                    <th width="100" >Status</th>
                    <th width="150">Date Created</th>
                    <!-- <th width="150">Status</th> -->
                </tr>
            </table>
                <div  style="height: calc(100vh - 180px);overflow: auto;
    overflow-x: hidden;width:100%">
                <div class="emptyTable" v-if="!sales.length">
                    <i class="el shopping-cart"></i><br>
                    <h5>No Sales</h5>
                    <p>You have not sold any course yet</p>
                </div>
            <table v-else class="file-list" id="file-table">
                <tr class="file-list__file" v-for="(sale,i) in sales" :key="i">
                    <th > {{sale.first_name}} {{sale.last_name}} </th>
                    <th width="200" >{{sale.email}}</th>
                    <th width="120" >{{sale.telephone}}</th>
                    <th width="100" >{{sale.getway}}</th>
                    <th width="100" >{{sale.price}}</th>
                    <th width="100" >{{sale.status}}</th>
                    <th width="150">{{sale.created_at}}</th>                    
                    <!-- <th width="150" class="tableActions">                        
                      <!-- <i @click="edit(sale)" class="el edit-3" title="Edit"></i>
                      <i @click="trash(sale, i)" class="el trash" title="Delete"></i> 
                    </th> -->
                </tr>
            </table>
                </div>
        </main>
    </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";
export default {
  props: ['course'],
  data() {
    return {
        popup:false,
        sales:[],
        student:false,
        popup_title:""
    };
  },
  components: {
  },
  computed: {},
  methods: {
    ...mapActions(["getSales"]),
  
    edit(student){
        this.popup_title = "Edit Student"
        this.popup=true
        this.student = student
    },
    async load_sales(){        
        let res = await this.getSales(this.$route.params.id)
        this.sales = res.data
    }
  },
   mounted() {  
    this.load_sales()    
  },
};
</script>