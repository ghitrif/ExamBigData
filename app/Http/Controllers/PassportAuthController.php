<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Whitelabel;
use Validator;
use Illuminate\Support\Facades\Storage;
use Notification;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassportAuthController extends Controller
{


    public function index(Request $request){
        $roles = auth()->user()->roles;
        $roles_ = [];
        foreach($roles as $role){
            $roles_[] = ['id'=>$role->id, 'name'=>$role->name, "status"=>1];
        }
        return response()->json(['data'=>["name"=> auth()->user()->name,
                                          "email"=>auth()->user()->email,
                                          "image"=>auth()->user()->image,
                                          "bio"=>auth()->user()->bio,
                                          "membership"=>$roles_], "status"=>1], 200); 
    }

    public function register(Request $request)
    {
        return false;
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => "/imgs/user.png",
            'password' => bcrypt($request->password)
        ]);
 
        $token = $user()->createToken('LaravelAuthApp')->accessToken; 
        return response()->json(['token' => $token], 200);
    }
    /** 
     * 
     * @urlParam  id required The ID of the post.
     * @return \Illuminate\Http\Response 
     */ 
    public function store(Request $request){
        
        $user = auth()->user();
        if($request->type=="PasswordSettings")
        {
            $this->validate($request, [
              'newPassword' => 'required|min:6', 
            ]);
        //    if(Hash::check($user->password, request()->input("password")))
          //     return response()->json(['errore'=>"password invalid", "status"=>-1], 200);
          $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (!auth()->attempt($data))
          return response()->json(['errore'=>"password invalid","status"=>-1], 200);
        $user->password = bcrypt(request()->input("newPassword")); 
        }
        
        else if($request->type=="AccountSettings")
        {
            $user->name=$request->name;
            $user->bio=$request->bio;
        }
        $user->save();
        
        return response()->json(["status"=>1], 200); 
    }


   

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required', 
        ]);
        //if validator fails
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user =  auth()->user();
            $parent_user = auth()->user();
            if($user()->type=="team")
                $parent_user= User::find($user()->created_by);

            return response()->json(['token'      => $token,
                                     "role"        => $parent_user()->roles()->max("level"),
                                     'user'       => array("name"     => $user()->name,
                                                            "email"    => $user()->email,
                                                            "image"    => $user()->image,
                                                            "team"     => $user()->team )], 200); 
        } else {
            return response()->json(['message' => 'Wrong login name or password', 'status' => -1], 200);
        }
    }

    public function reset_password(Request $request){
        $this->validate($request, [
            'email' => 'required',
        ]);
        $user = User::where ('email', $request->email)->first();
	    if ( !$user ){
             return response()->json(['message' => 'Email not found', "status" => -1], 200); 
        }
        $token = Str::random(60);
	    DB::table('password_resets')->insert([
	        'email' => $request->email,
	        'token' => $token, 
	        'created_at' => Carbon::now()
      ]);
      $whitelabel =  Whitelabel::getWhitelabel($request);

      $this->dispatch((new resetPassword($user, $whitelabel ,$token))->onQueue('mails'));
      return response()->json(['message' => "", "status" => 1], 200);

    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|min:6', 
            'newPassword' => 'required|min:6', 
            'confirmPassword' => 'required|same:newPassword', 
       ]);
       if ($validator->fails()) { 
           return response()->json(['errors'=>$validator->errors(), "status"=>-1], 401);            
       }
       $user = auth()->user();
       $user()->password = bcrypt(request()->input("newPassword")); 
        $user()->save();
        return response()->json(['success'=>[], "status"=>1], 200); 
   }


   public function changer_password(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'password' => 'required|string|max:50|min:6',
           'ConfirmPassword' => 'required|same:password',
           'email' => 'required|email',
           'token' => 'required',

       ]);
       if ($validator->fails()) {
           $message = "All fields are required"; 		        
           return response()->json(['message' => $validator->errors(), "status" => -1], 200); 
       }

       
       if($request->password != $request->ConfirmPassword){
           $message = "Password and confirmation password does not match";
           return response()->json(['message' => $message, "status" => -1], 200); 

       }
       
       $password = $request->password;
       $tokenData = DB::table('password_resets')
       ->where('token', $request->token)
       ->where("email", $request->email)->first();
       if(!$tokenData)
           return response()->json(['message' => "Invalid token request", "status" => -1], 200); 


       $user = User::where('email', $tokenData->email)->first();
       if ( !$user )
           return response()->json(['message' => "Invalid user request", "status" => -1], 200); 


       $user()->password = Hash::make($password);
       $user()->update(); 
       DB::table('password_resets')->where('email', $user()->email)->delete();
       return response()->json(['message' => "", "status" => 1], 200); 
   }



   public function updateImage(Request $request){
  
      
   }
 

}
