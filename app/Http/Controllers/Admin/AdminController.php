<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GlobalController;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends GlobalController
{
    
	public function __construct()
    {
    	$this->middleware('admin');
    }

    public function index(){

    	$total_user = User::count();

    	return view('admin.dashboard.dashboard',compact('total_user'));
    }

     public function changePassword(){

    	return view('admin.dashboard.change_password');
    }

    public function updatePassword(Request $request){

    	$this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required'
        ]);

        $user = Admin::where('id', '=', $request->id)->first();

        if(Hash::check($request->old_pass,$user->password)){

            $users = Admin::findOrFail($request->id);
            $users->password = Hash::make($request->new_pass);
            $users->save();

            return redirect(route('admin.dashboard'))->with('messages', [
                  [
                      'type' => 'success',
                      'title' => 'Password',
                      'message' => 'Password Successfully changed',
                  ],
            ]); 

        } else {

            return redirect()->back()->with('messages', [
                  [
                      'type' => 'error',
                      'title' => 'Password',
                      'message' => 'Plese check your current password',
                  ],
              ]); 
        }
    }

}
