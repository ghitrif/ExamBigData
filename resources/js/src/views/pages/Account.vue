<template>
<vs-row style="">
    <vs-col vs-w="12" >
     </vs-col>
    <vs-col vs-w="12" class="CourseEdit" > 
        
        <div class="CourseMenu">
            <div style="margin-top:100px"  :class="['mm smallFont', {folderFilter:tab=='Account'}]"  @click="tab='Account'"> <i class="el home" ></i>  Account</div>
            <div  :class="['mm smallFont', {folderFilter:tab=='Password'}]"  @click="tab='Password'"><i class="el lock" ></i>  Password</div>
            <div  :class="['mm smallFont', {folderFilter:tab=='Membership'}]"  @click="tab='Membership'"><i class="el layers"></i> Membership</div>
            <div  :class="['mm smallFont', {folderFilter:tab=='smtp'}]"  @click="tab='smtp'"><i class="el email"></i> SMTP Email Settings</div>
        </div>
        <div class="CourseEditContent" style="margin:0px"  >  

            <vs-row v-if="profile" >                
                <vs-col vs-w="12" >
  
                    <div v-if="tab == 'smtp'" class="acc_tab" > 
                       <WhitelabelSMTPSettingsEmail :brand="true"   />
                    </div>

                    <div v-if="tab == 'Account'" class="acc_tab"> 
                      <h3 class="mb-4">Account Settings</h3>
                      <div>
                        <form ref="AccountSettings" v-on:submit.prevent="AccountSettings('AccountSettings')" >
                            <label>Name</label>                
                            <input required name="name" v-model="profile.name" type="text" class="form-control mb-3" >
                            <label>Email</label>                
                            <input disabled v-model="profile.email" type="text" class="form-control mb-3" >
                            <label>Bio</label>          
                            <textarea name="bio" v-model="profile.bio" style="height:200px" class="form-control mb-3"></textarea>
                            <div>
                              <button class="actions">Save</button>
                            </div>
                        </form>
                      </div>
                    </div>

                     <div v-if="tab == 'Membership'" class="acc_tab"> 
                        <h3 class="mb-4">Membership</h3>
                        <div class="Membership">
                          <li v-for="membership,i in profile.membership" :key="i"> 

                            <i class="el check-circle"></i>
                            <span>{{membership.name}}</span>
                          </li>

                        </div>
                   </div>

                   <div v-if="tab == 'Password'" class="acc_tab"> 
                        <div>
                          <form ref="PasswordSettings" v-on:submit.prevent="AccountSettings('PasswordSettings')" >
                              <label>Password</label>                
                              <input required  v-model="info.password" type="text" name="password"  class="form-control mb-3"/>  
                              <label>New Password</label>                
                              <input required  v-model="info.newPassword"   type="password" name="NewPassword"  class="form-control mb-3" >
                              <label>Confirm Password</label>                
                              <input required  v-model="info.confPassword"  type="password" name="Cpassword" class="form-control mb-3" >
                              <div>
                                <button class="actions">Save</button>
                              </div>
                          </form>

                        </div>
                   </div>
                </vs-col>
            </vs-row >

        </div>
    </vs-col> 
</vs-row>
</template>
<script>
import WhitelabelSMTPSettingsEmail from "../components/whitelabel/WhitelabelSMTPSettingsEmail.vue"
import { mapGetters, mapActions } from "vuex";
export default {
  data() {

    return {
      tab:'Account',
      profile:false,
      info:{
        password:"",
        newPassword:"",
        confPassword:"",
      }
    };
  },
  components: {
    WhitelabelSMTPSettingsEmail
  },
  computed: {
  
  },

  methods: {  
    ...mapActions(["UpdatePRofile", "GetProfile"]),
    async GetProfile_(){
      this.$vs.loading({type:"sound"})
      let res = await this.GetProfile()
      this.$vs.loading.close()
      this.profile = res.data
    },
    async AccountSettings(form){
      if(form=="AccountSettings")
      {
       let info={
          name:this.profile.name,
          bio:this.profile.bio,
          type:form,
        }
        let res = await this.UpdatePRofile(info)
        if(res.status==1)
         this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
       
     
      }
      if(form=="PasswordSettings")
      {
        if(this.info.newPassword.length<6)
        {
          this.$vs.notify({title:'warning',text:'The new password must be at least 6 characters. ',color:'warning'})
          return false;
        }
         if(this.info.newPassword!=this.info.confPassword)
        {
          this.$vs.notify({title:'warning',text:'password is not confirmed ',color:'warning'})
          return false;
        }
        let info={
          email:this.profile.email,
          name:this.profile.name,
          bio:this.profile.bio,
          password:this.info.password,
          newPassword:this.info.newPassword,
          type:form,
        }
        let res = await this.UpdatePRofile(info)
         if(res.status==1)
         this.$vs.notify({title:'Success',text:'Saved successfully',color:'success'})
        else
         this.$vs.notify({title:'warning',text:'the password is invalid ',color:'warning'})
      }
    }    
   
  },
  mounted() {
       this.GetProfile_();
    
  },
};
</script>
<style lang="scss" scoped>
.Account{
  .actions{
    padding: 15px 55px !important;
  }
  height: calc(100vh - 100px);
  .imageProfil{
    text-align: center;
    img{
      height: 120px;
      width: 120px;
      border-radius: 50%;
    }
  }
  .tabsProfile{
    li{
      display: inline-block;
      width: 100%;
      height: 45px;
      line-height: 45px;
      list-style: none;
      border-bottom: 1px solid #00000038;
      &:hover{
        cursor: pointer;
      }
      i{
        margin-right: 10px;
        font-size: 20px;
      }
    }
  }

  .Membership{
    margin-top: 30px;
    li{
      list-style: none;
      height: 50px;
      span{
        font-weight: bold;
      }
      i{
        color: rgb(var(--vs-success));
        font-size: 22px;
        margin-right: 10px;
      }
    }
  }
}
.acc_tab{
  background: #fff;
    padding: 30px;
    border-radius: 20px;
    padding-bottom: 50px;
    max-width: 700px;
}
</style>