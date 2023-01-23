<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\User;
use App\Media;
use App\Whitelabel;
use App\Role;
use Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Notifications\ResellerUserCreated;
use Carbon\Carbon;

use Illuminate\Support\Str;
use Jobs\TeamInviteds;

class ResellerController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->user= auth()->user();  
            if($this->user->type=="team")
            $this->user = User::find($this->user->created_by);  
            return $next($request);
        });
    }

    public function TeamUsers(Request $request){
        $users = User::where("created_by","=",  $this->user->id )->where('type',"team")->get();
        return response()->json(['data'     => $users,
                                 'status'   => 1], 200); 

    }

    public function inviteUser(Request $request){
        $validator = \Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email','password' => 'required']);
        if ($validator->fails()) {
          return response()->json(['errors'=>"All fields must be entered", "status" => -1], 200);
        }
        $validator = \Validator::make($request->all(), ['email' => 'unique:users']);
        if ($validator->fails()) {
            return response()->json(['errors'=>"Email already exists", "status" => -1], 200);
          }
        $brand = Whitelabel::getWhitelabel($request);
        $User = new User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt(request()->input("password"));
        $User->invitation = md5($this->user->id.Str::random(60));
        $User->created_by = $this->user->id;
        $User->type = "team";
        $User->save();
        // $this->dispatch((new TeamInvited($User ,$brand,  request()->input("password"), $this->user->name))->onQueue('mails'));

        return response()->json(['data'     => $User,
                                 'status'   => 1], 200); 

    }

    public function index(){

        $users = User::where("created_by","=",  $this->user->id )->where('type',"user")->with('Roles')->get();    
        $roles = $this->user->roles()->whereNotIn('role_id', [0, 1])->get();
        if($this->user->hasRole("admin") && $this->user->id==1){
            $users = User::where('type',"user")->with('Roles')->get();
            $roles = Role::whereNotIn('id', [0, 1])->get();
        }
        return response()->json(['users' => $users, "roles"=>$roles, 'status' => 1], 200); 

    }
    

    public function store(Request $request){

        $validator = \Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email']);
         if ($validator->fails()) {
           return response()->json(['errors'=>$validator->errors(), "status" => -1], 200);
        }
        $rols = $request->roles;

        // if(empty($rols))
        //      return response()->json([
        //             'status' => -1,
        //             'message' => 'roles invalid'
        //         ], 422);
        $input = $request->all(); 
        $input['created_by'] = $this->user->id;
        $_user = new User;
        $validator = \Validator::make($request->all(), [ 'email' => 'required|email|unique:users']);
        if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors(), "status" => -1], 200);
        }
        $_user->fill($request->all());
        $_user->created_by = $this->user->id;
        $_user->image = "/images/user.png";
        $_user->email = $request->email;
        $_user->type = "user";
        $validator = \Validator::make($request->all(), [ 'password' => 'required|min:6']);
        if ($validator->fails()) {
          return response()->json(['errors'=>$validator->errors(), "status" => -1], 200);
        }
        $_user->password = bcrypt(request()->input("password")); 
        $_user->save();
        $max_Level_role =DB::table("roles")->join("role_user","role_user.role_id","=","roles.id")->where("role_user.user_id",$this->user->id)->get()->max("level");
        if(!$max_Level_role)
            return response()->json([
                'status' => -1,
                'errors' => 'user not Roles'
            ], 200);
        $rols = $request->roles;
        $date_limit = Carbon::now()->addDays(30)->format('Y-m-d');
        $date_now = Carbon::now();
        $_user->save();
        foreach ($rols as $rol) {
            $testLevelRole=DB::table("roles")->where("id","=",$rol)->first();
                if(!$testLevelRole)
                return response()->json([
                    'status' => -1,
                    'errors' => 'this role not in Roles'
                ], 200);
            if($testLevelRole->level>$max_Level_role)
            {
                return response()->json([
                    'status' => -1,
                    'errors' => 'level role > level max levels this user'
                ], 200);
            }
            else
            $create = DB::insert('insert into role_user (user_id,role_id,date_start,date_end) values (?,?,?,?)', [$_user->id,$rol,$date_now, $date_limit]);
            
        }
        

        // $Whitelabel =  Whitelabel::getWhitelabel($request); 
        // $_user->notify(new ResellerUserCreated($request->password ,$Whitelabel));   
        return response()->json(['user' => $_user ,"roles"=>$rols, "status" => 1], 200); 
    }
    public function destroy($id){
        
        $user_ = User::where("created_by",  $this->user->id )->where("id","=",$id)->first();
        if($user_){
            $user_->delete();
            return response()->json(['user'                 => [],
                                     'status'               => 1], 200);
        }else{
            if($this->user->id==1){
                $user_=User::where("id","=",$id)->first();
                if($user_)
                   {
                    $user_->delete();
                    return response()->json(['user'                 => [],
                                             'status'               => 1], 200);
                   }
            }
            return response()->json(['user'                 => "User not found",
                                     'status'               => -1], 200);

        }
    }
    public function update(Request $request){
        
        $_user = new User;
        if($request->id){
            $_user = User::where("created_by",  $this->user->id )->where("id",$request->id)->first();
            if($this->user->id==1)
                $_user=User::where("id","=",$request->id)->first();
            if(!$_user)
                return response()->json([
                    'status' => -1,
                    'message' => 'user not found'
                ], 200);
        }else{
            $validator = \Validator::make($request->all(), [ 'email' => 'required|email|unique:users']);
             if ($validator->fails()) {
               return response()->json(['errors'=>$validator->errors(), "status" => -1], 200);
            }
        }
       
        $date_limit = Carbon::now()->addDays(30)->format('Y-m-d');
        $date_now = Carbon::now();
        $_user->name=$request->name;
        $_user->email=$request->email;
        $_user->password=bcrypt($request->password);
        $max_Level_role =DB::table("roles")->join("role_user","role_user.role_id","=","roles.id")->where("role_user.user_id",$this->user->id)->get()->max("level");
        if(!$max_Level_role)
            return response()->json([
                'status' => -1,
                'message' => 'user not Roles'
            ], 200);
        $rols = $request->roles;
        $_user->roles()->detach();
        $_user->save();
        
        foreach ($rols as $rol) {
            $testLevelRole=DB::table("roles")->where("id","=",$rol)->first();
                if(!$testLevelRole)
                return response()->json([
                    'status' => -1,
                    'errors' => 'this role not in Roles'
                ], 200);
            if($testLevelRole->level>$max_Level_role)
            {
                return response()->json([
                    'status' => -1,
                    'errors' => 'level role > level max levels this user'
                ], 200);
            }
            else
            $create = DB::insert('insert into role_user (user_id,role_id,date_start,date_end) values (?,?,?,?)', [$request->id,$rol,$date_now, $date_limit]);
        }
        
        
        $_user->save();
        return response()->json(['user' => $_user , "status" => 1], 200); 
    }
    



    
    

}
