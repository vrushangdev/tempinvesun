<?php

namespace App\Http\Controllers\Techpartner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Ngo;
use App\Models\NgoCategory;
use App\Models\NgoCity;
use App\Models\NgoContact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TechPartnerController extends Controller
{
    public function __construct()
    {
    	$this->middleware('tech_partner');
    }

    public function index(){

    	$total_user = User::count();

    	return view('techpartner.dashboard.dashboard',compact('total_user'));
    }

    public function editProfile(){

    	$id = Auth::guard('ngo')->user()->id;

    	$getCityList = City::where('is_active',1)->where('is_delete',0)->get();

    	$getCategoryList = Category::where('is_active',1)->where('is_delete',0)->get();

    	$getNgoDetails = Ngo::where('id',$id)->with(['contact','city','category'])->first();

    	$ngoCity = array();
    	$ngoCategory = array();

    	if(isset($getNgoDetails->city) && count($getNgoDetails->city)){
    		foreach($getNgoDetails->city as $cityk => $cityv){
    			$ngoCity[] = $cityv->city_id;
    		}
    	}

    	if(isset($getNgoDetails->category) && count($getNgoDetails->category)){
    		foreach($getNgoDetails->category as $catk => $catv){
    			$ngoCategory[] = $catv->category_id;
    		}
    	}

    	return view('ngo.dashboard.edit_profile',compact('getCityList','getCategoryList','getNgoDetails','ngoCity','ngoCategory'));
    }

    public function saveEditedProfile(Request $request){

    	$ngo = Ngo::findOrFail($request->id);
    	$ngo->name = $request->name;
    	$ngo->tag_line = $request->tag_line;
    	$ngo->description = $request->description;
        $ngo->donation_link = $request->donation_link;
        $ngo->mobile = $request->mobile;
        $ngo->email = $request->email;
        if(isset($request->image)){
            $fileName = $this->uploadImage($request->image,'ngo');
            $ngo->logo = $fileName;         
        }
    	$ngo->save();

    	if($ngo){

    		if(isset($request->city) && !is_null($request->city)){
    			$deleteCity = NgoCity::where('ngo_id',$request->id)->delete();
	    		foreach($request->city as $cityk => $cityv){
		    		$ngocity = new NgoCity;
			    	$ngocity->ngo_id = $ngo->id;
			    	$ngocity->city_id = $cityv;
			    	$ngocity->save();
			    }
			}

	    	if(isset($request->conatct_no) && !is_null($request->conatct_no)){
	    		$deleteContact = NgoContact::where('ngo_id',$request->id)->delete();
	    		foreach($request->conatct_no as $conk => $conv){
			    	$ngocontact = new NgoContact;
			    	$ngocontact->ngo_id = $ngo->id;
			    	$ngocontact->contact_no = $conv;
			    	$ngocontact->save();
			    }
			}

	    	if(isset($request->category) && !is_null($request->category)){
	    		$deleteCategory = NgoCategory::where('ngo_id',$request->id)->delete();
	    		foreach($request->category as $catk => $catv){
		    		$ngocategory = new NgoCategory;
			    	$ngocategory->ngo_id = $ngo->id;
			    	$ngocategory->category_id = $catv;
			    	$ngocategory->save();
			    }
			}
		}

    	return redirect(route('ngo.dashboard'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Ngo',
                  'message' => 'Profile updated !',
              ],
        ]); 

    }

    public function changePassword(){

    	return view('ngo.dashboard.change_password');
    }

    public function updatePassword(Request $request){

    	$this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required'
        ]);

        $user = Ngo::where('id', '=', $request->id)->first();

        if(Hash::check($request->old_pass,$user->password)){

            $users = Ngo::findOrFail($request->id);
            $users->password = Hash::make($request->new_pass);
            $users->save();

            return redirect(route('ngo.dashboard'))->with('messages', [
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
