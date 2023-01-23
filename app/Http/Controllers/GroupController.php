<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;

class GroupController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = $this->user->groups; 
        foreach($groups as $group){
            $group->user = $group->user;
            $group->prospects = $group->prospects()->count();
        }
        return response()->json([
            'status' => 1,
            'data' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);
        
        $input = $request->all();     
        $input['user_id'] = $this->user->id;         
        $group =  Group::create($input);
        $group->save();
        $group->prospects = $group->prospects()->count();
        $group->user = $group->user;
        return response()->json([
            'status' => 1,
            'data' => $group
        ], 200);
    }

    /**
     * update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = $this->user->groups()->find($id);
        if(!$group)
            return response()->json(['message'=>"Not found", "status"=> -1], 200); 

        $group->fill($request->all());
        $group->save();

        $group->prospects = $group->prospects()->count();
        $group->user = $group->user;

        return response()->json(['data'=>$group, "status"=>1], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->user->groups()->find($id);
        if(!$group)
            return response()->json(['message'=>"Not found", "status"=> -1], 200);
        $group->prospects = $group->prospects()->count();
        $group->user = $group->user;
        return response()->json(['data'=>$group, "status"=>1], 200);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = $this->user->groups()->find($id);
        if(!$group)
            return response()->json(['message'=>"Not found", "status"=> -1], 200);
        $group->delete();
        return response()->json(['data'=>[], "status"=>1], 200);
    }
}
