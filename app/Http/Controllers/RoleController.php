<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;

class RoleController extends Controller
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

  
    public function index()
    {
        $Roles =  Role::where("level", "<", 4)->get();
        return response()->json(['data'                => $Roles,
                                 'status'              => 1], 200);
    }

}
