<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use App\Models\RoleModule;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   	public function __construct()
   	{
   		$this->middleware('admin');
   	}

   	public function roleList(){

   		$roleList = Role::all();

   		return view('admin.role.role_list',compact('roleList'));
   	}

   	public function addRole(){

   		return view('admin.role.add_role');
   	}

   	public function saveRole(Request $request){

   		$request->validate([
	        'name' => 'required',
	    ]);

	    $role = new Role;
	    $role->role = $request->name;
	    $role->save();

	    return redirect(route('roleList'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Role',
                  'message' => 'Role Successfully added.',
              ],
        ]);
   	}	

   	public function editRole($id){

   		$roleDetail = Role::where('id',$id)->first();
   		
   		return view('admin.role.edit_role',compact('roleDetail'));	
   	}

   	public function saveEditedRole(Request $request){

   		$request->validate([
	        'name' => 'required',
	    ]);

	    $role = Role::findOrFail($request->id);
	    $role->role = $request->name;
	    $role->save();

	    return redirect(route('roleList'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Role',
                  'message' => 'Role Successfully Updated.',
              ],
        ]);
   	}

   	public function deleteRole($id){

   		$deleterole = Role::where('id',$id)->delete();

    	if($deleterole){

    		return redirect(route('roleList'))->with('messages', [
                [
	                'type' => 'success',
	                'title' => 'Role',
	                'message' => 'Role Successfully Deleted.',
                ],
        	]); 	
    	}
   	}

}
