<?php

namespace App\Http\Controllers;

use App\Models\AppVersion;
use App\Models\Category;
use App\Models\City;
use App\Models\Ngo;
use App\Models\NgoCity;
use App\Models\Post;
use App\Models\UploadCertificate;
use App\Models\User;
use App\Models\UserAppliedPost;
use App\Models\UserCategory;
use App\Models\UserToken;
use App\Models\XApi;
use Auth;
use File;
use Hash;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Mail;
use Request;
use Response;
use Route;


class ApisController extends GlobalController
{   
    use SendsPasswordResetEmails;
    
    public function __construct() {
        //API log code.
        $headers = apache_request_headers();
         
        //API log code.
        //X-Api check code.
        if (isset($headers['X-Api-Key']) && $headers['X-Api-Key'] != '') {
            if (isset($headers['device-type']) && $headers['device-type'] != '') {
                if(!XApi::checkXAPI($headers['X-Api-Key'],$headers['device-type'])){
                    echo json_encode(array('status'=>500,'message'=>'Invalid X-API'));exit;
                }
            } else {
                echo json_encode(array('status'=>500,'message'=>'Device type not found'));exit;
            }
        } else {
           echo json_encode(array('status'=>500,'message'=>'X-API key not found'));exit; 
        }

        if (isset($headers['device-token']) && isset($headers['version'])) {
            $updateVersion = UserToken::where('Device_Token',$headers['device-token'])->update(['Version' => $headers['version']]);
        }

        if (isset($headers['device-type']) && isset($headers['version'])) {
            $getUserAppVersion = AppVersion::where('platform',$headers['device-type'])->where('version',$headers['version'])->first();
            if (!empty($getUserAppVersion->expireddate)) {
                if ($getUserAppVersion->expireddate < date('Y-m-d H:i:s')) {
                    //CHECK IF THE USER VERSION IS EXPIRED OR NOT
                    $res['status'] = "700";
                    $res['message'] = "App Version Expired";
                    echo json_encode($res);
                    exit;
                } 
            } 
        }        
    }

    public function Append($log_file, $value)
    {   
        File::append($log_file, $value . "\r\n");
    }

    public function LogInput(){

        $log_file = storage_path() . '/logs/api' . date('Ymd') . '.log';
        $headers = apache_request_headers();

        $this->Append($log_file,'----------------' . debug_backtrace()[1]['function'] . ' --------------');
        $this->Append($log_file,'Request Info : ');
        $this->Append($log_file,'Date: ' . date('Y-m-d H:i:s') . '    IP: ' .  Request::ip());
        $this->Append($log_file,'User-Agent: ' .  Request::header('User-Agent'));
        $this->Append($log_file,'URL: ' .  Request::url());
        $this->Append($log_file,'Input Parameters: ' .  json_encode(Input::all()));
        $this->Append($log_file,'Headers Parameters: ' .  json_encode($headers));
        $this->Append($log_file,'-----------');
        return;
    }

    public function LogOutput($output){

        $log_file = storage_path() . '/logs/api' . date('Ymd') . '.log';
        $this->Append($log_file, 'Output: ');
        $this->Append($log_file,$output);
        $this->Append($log_file,'--------------------END------------------------');
        $this->Append($log_file,'');
        return;
    }

    public function nulltoblank($data) {

        return !$data ? $data = "" : $data;
    }

    //GENERATE DEVICE TOKEN
    public function generateDeviceToken(){
        
        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!isset($headers['device-type']) && $headers['device-type'])
            $errors_array['device-type'] = 'Please pass device type';

        if(count($errors_array) == 0){
            $user = new User;
            $token = $user->generateToken($headers);
            $response['device-token'] = $token;

            $this->LogOutput(Response::json(array('status'=>200,'data' => $response)));
            return Response::json(array('status'=>200,'data' => $response),200);

        } else {
            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500);
        }
    }

    public function checkAppVersion(){

        $headers = apache_request_headers();
        if (isset($headers['device-type']) && $headers['device-type'] && isset($headers['version']) && $headers['version']) {
            $getUserAppVersion = AppVersion::where('platform',$headers['device-type'])->orderBy('id','DESC')->first();

            $a = str_replace(".", "",$getUserAppVersion['version']);
            $b = str_replace(".", "",$headers['version']);

            if($a > $b){
                //CHECK IF THE NEW VERSION LAUNCHED
                $response['status'] = "600";
                $response['message'] = "New App Version Launched";
            }elseif($a == $b){
                $response['status'] = "200";
                $response['message'] = "User's application up to date";
            } else {
                $response['status'] = "500";
                $response['message'] = "This application's version is not in our records!";
            }
            echo json_encode($response);
            exit();
        }else{
            $response['status'] = "500";
            $response['message'] = "Provide all parameters";
            echo json_encode($response);
            exit();
        }
    }

    public function updateFcmToken(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();

        if (!isset($headers['device-token']) || $headers['device-token'] == "")
            $errors_array['device-token'] = 'Please enter device token';
        if (!isset($headers['fcm-token']) || $headers['fcm-token'] == "")
            $errors_array['fcm-token'] = 'Please enter fcm token';

        if(count($errors_array) == 0){

            $updateToken = UserToken::where('device_token',$headers['device-token'])
                                    ->update(['fcm_token' => $headers['fcm-token']]);

            if($updateToken){

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'FCM token updated!')));
                return Response::json(array('status'=>200,'message' => 'FCM token updated!'));

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'something went wrong!')));
                return Response::json(array('status'=>500,'message' => 'something went wrong!'),500);
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   

    }

    public function cityList(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');

        if(isset($headers['fcm-token']) || $headers['fcm-token'] != "" && isset($headers['device-token']) || $headers['device-token'] != ""){
            $updateToken = UserToken::where('device_token',$headers['device-token'])
                                    ->update(['fcm_token' => $headers['fcm-token']]);
        }

        $cityData = City::where('is_active',1)->where('is_delete',0)->orderBy('priority','asc')->get();

        if(count($cityData) > 0){
            $cityList = array();
            foreach($cityData as $ck => $cv){
                $cityList[$ck]['id'] = $this->nulltoblank($cv->id);
                $cityList[$ck]['name'] = $this->nulltoblank($cv->name);
                $cityList[$ck]['lat'] = $this->nulltoblank($cv->lat);
                $cityList[$ck]['long'] = $this->nulltoblank($cv->lang);
                $cityList[$ck]['location'] = $this->nulltoblank($cv->location);
                $cityList[$ck]['image'] = $cv->image ? $base_path."/uploads/city_image/".$cv->image : "";
            }
             
            $this->LogOutput(Response::json(array('status'=>200,'data' => $cityList)));
            return Response::json(array('status'=>200,'data' => $cityList),200);

        } else {
            $this->LogOutput(Response::json(array('status'=>500,'message' => 'No city data found')));
            return Response::json(array('status'=>500,'message' => 'No city data found'),500);
        }
    } 

    public function categoryList(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');

        $categoryData = Category::where('is_active',1)->where('is_delete',0)->orderBy('priority','asc')->get();

        if(count($categoryData) > 0){
            $category = array();
            foreach($categoryData as $ck => $cv){
                $category[$ck]['id'] = $this->nulltoblank($cv->id);
                $category[$ck]['name'] = $this->nulltoblank($cv->name);
                $category[$ck]['image'] = $cv->image ? $base_path."/uploads/category/".$cv->image : "";
            }
             
            $this->LogOutput(Response::json(array('status'=>200,'data' => $category)));
            return Response::json(array('status'=>200,'data' => $category),200);

        } else {
            $this->LogOutput(Response::json(array('status'=>500,'message' => 'No city data found')));
            return Response::json(array('status'=>500,'message' => 'No city data found'),500);
        }
    }

    public function userSignUp(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();

        if (!Input::has('name') || Input::get('name') == "")
            $errors_array['name'] = 'Please pass name';
        if (!Input::has('mobile') || Input::get('mobile') == "")
            $errors_array['mobile'] = 'Please pass mobile';
        if (!Input::has('city_name') || Input::get('city_name') == "")
            $errors_array['city_name'] = 'Please pass city_name';

        if(count($errors_array) == 0){

            $data = Input::all();

            $checkMobile = User::where('mobile',$data['mobile'])->first();

            if(is_null($checkMobile)){

                $token = mt_rand(100000,999999);

                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->city_name = $data['city_name'];
                $user->otp = $token;
                $user->save();

                if($user){

                    $user_data['user_id'] = $user->id;
                    $user_data['name'] = $data['name'];
                    $user_data['mobile'] = $data['mobile'];
                    $user_data['otp_verified'] = 'false';
                    $findCity = City::where('city',strtolower($data['city_name']))->first();
                    if(!is_null($findCity)){
                        $user_data['city_id'] = $findCity->id;
                    } else {
                        $user_data['city_id'] = "";
                    }
                    $user_data['city_name'] = $data['city_name'];

                    $this->LogOutput(Response::json(array('status'=>200,'data' => $user_data)));
                    return Response::json(array('status'=>200,'data' => $user_data));    

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong!'));    
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Mobile number already in use!')));
                return Response::json(array('status'=>500,'message' => 'Mobile number already in use!'),500);
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function otpVerifiaction(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();

        if (!Input::has('mobile') || Input::get('mobile') == "")
            $errors_array['mobile'] = 'Please pass mobile';
        if (!Input::has('otp') || Input::get('otp') == "")
            $errors_array['otp'] = 'Please pass otp';

        if(count($errors_array) == 0){

            $data = Input::all();

            $checkMobile = User::where('mobile',$data['mobile'])->where('otp',$data['otp'])->first();

            if(!is_null($checkMobile)){

                $user = User::findOrFail($checkMobile->id);
                $user->otp_verified = 1;
                $user->save();

                $app_token = $this->updateUserAppToken($headers,$checkMobile->id);

                if($user){

                    $user_data['user_id'] = $checkMobile->id;
                    $user_data['name'] = $checkMobile->name;
                    $user_data['mobile'] = $checkMobile->mobile;
                    $user_data['otp_verified'] = 'true';
                    $user_data['app_token'] = $app_token;
                    $findCity = City::where('city',strtolower($checkMobile->city_name))->first();
                    if(!is_null($findCity)){
                        $user_data['city_id'] = $findCity->id;
                    } else {
                        $user_data['city_id'] = "";
                    }
                    $user_data['city_name'] = $checkMobile->city_name;

                    $this->LogOutput(Response::json(array('status'=>200,'data' => $user_data)));
                    return Response::json(array('status'=>200,'data' => $user_data));    

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong!'));    
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Invalid Otp!')));
                return Response::json(array('status'=>500,'message' => 'Invalid Otp!'),500);
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function editMobileNumber(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();

        if (!Input::has('old_number') || Input::get('old_number') == "")
            $errors_array['old_number'] = 'Please pass old number';
        if (!Input::has('new_number') || Input::get('new_number') == "")
            $errors_array['new_number'] = 'Please pass new number';
        
        if(count($errors_array) == 0){

            $data = Input::all();

            $token = mt_rand(100000,999999);

            $updateToken = User::where('mobile',$data['old_number'])
                               ->update([
                                    'otp' => $token,
                                    'mobile' => $data['new_number']
                                ]);

           
            //$message = "<#> ".$token." is your OTP. Please enter it and proceed! ".$data['msg_key'];

            //$sms = $this->sendSms($data['new_number'],$message);

            if($updateToken){

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'Number successfully updated!')));
                return Response::json(array('status'=>200,'message' => 'Number successfully updated!'),200); 

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong'),500); 
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)); 
        }
    }

    public function resendOtp(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!Input::has('mobile') || Input::get('mobile') == "")
            $errors_array['mobile'] = 'Please pass mobile';
        
        if(count($errors_array) == 0){

            $data = Input::all();

            $getUserDetail = User::where('mobile',$data['mobile'])->first();

            if(!is_null($getUserDetail)){

                $token = mt_rand(100000,999999);

                $user = User::findOrFail($getUserDetail->id);
                $user->otp = $token;
                $user->save();
                                
                //$sendMsg = $this->updateOtp($getUserDetail->id,$getUserDetail->primary_phone,$data['msg_key']);

                if($user){

                    $this->LogOutput(Response::json(array('status'=>200,'message' => 'Otp Successfully sent!')));
                    return Response::json(array('status'=>200,'message' => 'Otp Successfully sent!'),200); 

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong!'),500); 
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>404,'message' => 'User Not Found!')));
                return Response::json(array('status'=>404,'message' => 'User Not Found!'),404); 
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }
    }

    public function userCategoryLink(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('category_id'))
            $errors_array['category_id'] = 'Please pass category_id';

        if(count($errors_array) == 0){

            $data = Input::all();

            if(isset($data['category_id']) && !is_null($data['category_id'])){
                $deleteCategory = UserCategory::where('user_id',$headers['user-id'])->delete();
                foreach($data['category_id'] as $ck => $cv){
                    $usercat = new UserCategory;
                    $usercat->user_id = $headers['user-id'];
                    $usercat->category_id = $cv; 
                    $usercat->save();
                }

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'User category Linked')));
                return Response::json(array('status'=>200,'message' => 'User category Linked'),200); 

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong!'),500); 
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }

    }

    public function login(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!Input::has('mobile') || Input::get('mobile') == "")
            $errors_array['mobile'] = 'Please pass mobile';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUserMobile = User::where('mobile',$data['mobile'])->first();
            
            if(!is_null($getUserMobile)){

                $token = mt_rand(100000,999999);

                $user = User::findOrFail($getUserMobile->id);
                $user->otp = $token;
                $user->save();

                if($user){

                    $user_data['user_id'] = $getUserMobile->id;
                    $user_data['name'] = $getUserMobile->name;
                    $user_data['mobile'] = $getUserMobile->mobile;
                    $user_data['otp_verified'] = 'true';
                    $findCity = City::where('city',strtolower($getUserMobile->city_name))->first();
                    if(!is_null($findCity)){
                        $user_data['city_id'] = $findCity->id;
                    } else {
                        $user_data['city_id'] = "";
                    }
                    $user_data['city_name'] = $getUserMobile->city_name;

                    $this->LogOutput(Response::json(array('status'=>200,'data' => $user_data)));
                    return Response::json(array('status'=>200,'data' => $user_data));  

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong!'),500);
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Mobile number already in use!')));
                return Response::json(array('status'=>500,'message' => 'Mobile number already in use!'),500);
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }      
    }

    public function userLogout(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();

        if (!isset($headers['user-token']) || $headers['user-token'] == "")
            $errors_array['user-token'] = 'Please enter user token';
        

        if(count($errors_array) == 0){

            $updateToken = UserToken::where('app_token',$headers['user-token'])
                                    ->update(['app_token' => '']);

            if($updateToken){

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'Successfully Logout')));
                return Response::json(array('status'=>200,'message' => 'Successfully Logout'),200);

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'something went wrong!')));
                return Response::json(array('status'=>500,'message' => 'something went wrong!'),500);
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }      
    }

    public function homeScreenPost(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('city_id') || Input::get('city_id') == "")
            $errors_array['city_id'] = 'Please pass city_id';
       
        if(count($errors_array) == 0){

            $data = Input::all();

            $getNgoList = NgoCity::where('city_id',$data['city_id'])->pluck('ngo_id');

            $postData = array();

            $getAllPost = Post::where('is_active',1)->where('is_delete',0)->whereIn('ngo_id',$getNgoList)->get();

            $allPost = array();

            if(!is_null($getAllPost)){
                foreach($getAllPost as $pk => $pv){
                    $allPost[$pk]['id'] = $pv->id;
                    $allPost[$pk]['title'] = $pv->title;
                    $allPost[$pk]['description'] = $pv->description;
                    $allPost[$pk]['date'] = $pv->date;
                    $allPost[$pk]['time'] = $pv->time;
                    $allPost[$pk]['venue'] = $pv->venue;
                    $allPost[$pk]['created_at'] = date('d-m-Y',strtotime($pv->created_at));                
                }
            }

            $getPersonal = UserCategory::where('user_id',$headers['user-id'])->pluck('category_id');

            $getPersonalPost = Post::where('is_active',1)->where('is_delete',0)
                                   ->whereIn('ngo_id',$getNgoList)
                                   ->whereHas('postcategory', function ($query)  use ($getPersonal) {
                                        $query->whereIn('category_id',$getPersonal);
                                    })
                                   ->get();

            $personalPost = array();
            
            if(!is_null($getPersonalPost)){
                foreach($getPersonalPost as $ppk => $ppv){
                    $personalPost[$ppk]['id'] = $ppv->id;
                    $personalPost[$ppk]['title'] = $ppv->title;
                    $personalPost[$ppk]['description'] = $ppv->description;
                    $personalPost[$ppk]['date'] = $ppv->date;
                    $personalPost[$ppk]['time'] = $ppv->time;
                    $personalPost[$ppk]['venue'] = $ppv->venue;
                    $personalPost[$ppk]['created_at'] = date('d-m-Y',strtotime($pv->created_at));                
                }
            } 

            $postData['personal'] = $personalPost;
            $postData['all'] = $allPost;      

            $this->LogOutput(Response::json(array('status'=>200,'data' => $postData)));
            return Response::json(array('status'=>200,'data' => $postData),200);                   

        } else {
            
            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 

        }   
    }

    public function postDetails(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!Input::has('post_id') || Input::get('post_id') == "")
            $errors_array['post_id'] = 'Please pass post_id';
       
        if(count($errors_array) == 0){

            $data = Input::all();

            $getPost = Post::where('id',$data['post_id'])->with(['postcategory' => function($q) { $q->with(['category']); } ,'postimage','ngo'])->first();

            if(!is_null($getPost)){

                $postData['id'] = $getPost->id;
                $postData['name'] = $getPost->title;
                $postData['description'] = $getPost->description;
                $postData['date'] = $getPost->date;
                $postData['time'] = $getPost->time;
                $postData['venue'] = $getPost->venue;
                $postData['ngo_id'] = $getPost->ngo->id;
                $postData['ngo_name'] = $getPost->ngo->name;
                $postData['ngo_contact_person'] = $getPost->ngo->email;
                $postData['ngo_contact_number'] = $getPost->ngo->mobile;
                $postData['ngo_icon'] = $getPost->ngo->logo ? $base_path."/uploads/ngo/".$getPost->ngo->logo : "";
                $postData['created_at'] = date('d-m-Y h:i a',strtotime($getPost->created_at));

                $postcategory = array();

                if(isset($getPost->postcategory) && !is_null($getPost->postcategory)){
                    foreach($getPost->postcategory as $ck => $cv){
                        $cat['id'] = $cv->category->id;
                        $cat['name'] = $cv->category->name;
                        $cat['image'] = $cv->category->image ? $base_path."/uploads/category/".$cv->category->image : "";
                        $postcategory[] = $cat;
                    }
                }

                $postimage = array();

                if(isset($getPost->postimage) && !is_null($getPost->postimage)){
                    foreach($getPost->postimage as $ik => $iv){
                        $postimage[] = $iv->image_name ? $base_path."/uploads/post/".$iv->image_name : "";
                    }
                }

                $postData['postcategory'] = $postcategory;
                $postData['postimage'] = $postimage;

                $this->LogOutput(Response::json(array('status'=>200,'data' => $postData)));
                return Response::json(array('status'=>200,'data' => $postData),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Post not found!')));
                return Response::json(array('status'=>500,'message' => 'Post not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function ngoDetails(){


        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!Input::has('ngo_id') || Input::get('ngo_id') == "")
            $errors_array['ngo_id'] = 'Please pass ngo_id';

         if(count($errors_array) == 0){

            $data = Input::all();

            $getNgo = Ngo::where('id',$data['ngo_id'])->with(['contact','city' => function ($q) { $q->with(['city']); },'category' => function ($q) { $q->with(['category']); }])->first();

            if(!is_null($getNgo)){

                $ngoData = array();

                $ngoData['id'] = $getNgo->id;
                $ngoData['name'] = $getNgo->name;
                $ngoData['description'] = $getNgo->description;
                $ngoData['contact_person'] = $getNgo->email;
                $ngoData['contact_number'] = $getNgo->mobile;
                $ngoData['logo'] = $getNgo->logo ? $base_path."/uploads/ngo/".$getNgo->logo : "";
                $ngoData['email'] = $getNgo->email;
                $ngoData['donation_link'] = $getNgo->donation_link;
                
                $ngocategory = array();

                if(isset($getNgo->category) && !is_null($getNgo->category)){
                    foreach($getNgo->category as $cak => $cav){
                        $cat['id'] = $cav->category->id;
                        $cat['name'] = $cav->category->name;
                        $cat['image'] = $cav->category->image ? $base_path."/uploads/category/".$cav->category->image : "";
                        $ngocategory[] = $cat;
                    }
                }

                $ngocity = array();

                if(isset($getNgo->city) && !is_null($getNgo->city)){
                    foreach($getNgo->city as $cik => $civ){
                        $city['id'] = $civ->city->id;
                        $city['name'] = $civ->city->name;
                        $city['image'] = $civ->city->image ? $base_path."/uploads/city_image/".$civ->city->image : "";
                        $ngocity[] = $city;
                    }
                }

                $ngocontact = array();

                if(isset($getNgo->contact) && !is_null($getNgo->contact)){
                    foreach($getNgo->contact as $cck => $ccv){
                        $ngocontact[] = $ccv->contact_no;
                    }
                }

                $ngoData['ngocategory'] = $ngocategory;
                $ngoData['ngocity'] = $ngocity;
                $ngoData['ngocontact'] = $ngocontact;


                $this->LogOutput(Response::json(array('status'=>200,'data' => $ngoData)));
                return Response::json(array('status'=>200,'data' => $ngoData),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'NGO not found!')));
                return Response::json(array('status'=>500,'message' => 'NGO not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   

    }

    public function editProfile(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUser = User::where('id',$headers['user-id'])->first();

            if(!is_null($getUser)){

                $userData = array();

                $userData['id'] = $getUser->id;
                $userData['name'] = $getUser->name ? $getUser->name : "";
                $userData['email'] = $getUser->email ? $getUser->email : "";
                $userData['mobile'] = $getUser->mobile ? $getUser->mobile : "";
                $userData['city'] = $getUser->city_name ? $getUser->city_name : "";
                $userData['occupation'] = $getUser->occupation ? $getUser->occupation : "";
                $userData['gender'] = $getUser->gender ? $getUser->gender : "";
                $userData['birthdate'] = $getUser->birthdate ? $getUser->birthdate : "";

                
                $this->LogOutput(Response::json(array('status'=>200,'data' => $userData)));
                return Response::json(array('status'=>200,'data' => $userData),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'User not found!')));
                return Response::json(array('status'=>500,'message' => 'User not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    } 

    public function updateProfile(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUser = User::where('id',$headers['user-id'])->first();

            if(!is_null($getUser)){

                $userData = User::findOrFail($headers['user-id']);

                if(isset($data['name']) && $data['name'] != ''){
                    $userData->name = $data['name'];
                }
                if(isset($data['email']) && $data['email'] != ''){
                    $userData->email = $data['email'];
                }
                if(isset($data['mobile']) && $data['mobile'] != ''){
                    $userData->mobile = $data['mobile'];
                }
                if(isset($data['city']) && $data['city'] != ''){
                    $userData->city_name = $data['city'];
                }
                if(isset($data['occupation']) && $data['occupation'] != ''){
                    $userData->occupation = $data['occupation'];
                }
                if(isset($data['gender']) && $data['gender'] != ''){
                    $userData->gender = $data['gender'];
                }
                if(isset($data['birthdate']) && $data['birthdate'] != ''){
                    $userData->birthdate = $data['birthdate'];
                }
                $userData->save();

                if($userData){


                    if(isset($data['mobile']) && $data['mobile'] != '' && $getUser->mobile != $data['mobile']){

                        $token = mt_rand(100000,999999);

                        $user = User::findOrFail($getUser->id);
                        $user->otp_verified = 0;
                        $user->otp = $token;
                        $user->save();

                        $this->LogOutput(Response::json(array('status'=>201,'messages' => 'Otp Successfully sent')));
                        return Response::json(array('status'=>201,'messages' => 'Otp Successfully sent'),201);

                    } else {

                        $this->LogOutput(Response::json(array('status'=>200,'message' => 'User profile updated!')));
                        return Response::json(array('status'=>200,'message' => 'User profile updated!'),200);    
                    }

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong!'),500);    
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'User not found!')));
                return Response::json(array('status'=>500,'message' => 'User not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function getUserIntrest(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUser = UserCategory::where('user_id',$headers['user-id'])->with(['category'])->get();
            
            if(!is_null($getUser)){

                $categoryData = array();

                foreach($getUser as $gk => $gv){
                    if(isset($gv->category) && !is_null($gv->category)){
                        $categoryData[$gk]['id'] = $gv->category->name;
                        $categoryData[$gk]['image'] = $gv->category->image ? $base_path."/uploads/category/".$gv->category->image : "";
                    }
                }

                $this->LogOutput(Response::json(array('status'=>200,'data' => $categoryData)));
                return Response::json(array('status'=>200,'data' => $categoryData),200);  

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'No data found!')));
                return Response::json(array('status'=>500,'message' => 'No data found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function editUserIntrest(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('category_id'))
            $errors_array['category_id'] = 'Please pass category_id';

        if(count($errors_array) == 0){

            $data = Input::all();

            if(isset($data['category_id']) && !is_null($data['category_id'])){
                $deleteCategory = UserCategory::where('user_id',$headers['user-id'])->delete();
                foreach($data['category_id'] as $ck => $cv){
                    $usercat = new UserCategory;
                    $usercat->user_id = $headers['user-id'];
                    $usercat->category_id = $cv; 
                    $usercat->save();
                }

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'User\'s intrest updated!')));
                return Response::json(array('status'=>200,'message' => 'User\'s intrest updated!'),200); 

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong!')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong!'),500); 
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }
    }

    public function checkAdditionalDetails(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUser = User::where('id',$headers['user-id'])->first();

            if(!is_null($getUser)){

                $userData = array();

                if($getUser->email != '' && $getUser->occupation  != '' && $getUser->gender  != '' && $getUser->birthdate  != ''){

                    $this->LogOutput(Response::json(array('status'=>200,'message' => 'Additional details are updated!')));
                    return Response::json(array('status'=>200,'message' => 'Additional details are updated!'),200);        

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Additional details are required')));
                    return Response::json(array('status'=>500,'message' => 'Additional details are required'),500);   
                }   

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'NGO not found!')));
                return Response::json(array('status'=>500,'message' => 'NGO not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function updateAdditionalDetail(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('email') || Input::get('email') == "")
            $errors_array['email'] = 'Please pass email';
        if (!Input::has('occupation') || Input::get('occupation') == "")
            $errors_array['occupation'] = 'Please pass occupation';
        if (!Input::has('gender') || Input::get('gender') == "")
            $errors_array['gender'] = 'Please pass gender';
        if (!Input::has('birthdate') || Input::get('birthdate') == "")
            $errors_array['birthdate'] = 'Please pass birthdate';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getUser = User::where('id',$headers['user-id'])->first();

            if(!is_null($getUser)){

                $userData = User::findOrFail($headers['user-id']);

                if(isset($data['email']) && $data['email'] != ''){
                    $userData->email = $data['email'];
                }
                if(isset($data['occupation']) && $data['occupation'] != ''){
                    $userData->occupation = $data['occupation'];
                }
                if(isset($data['gender']) && $data['gender'] != ''){
                    $userData->gender = $data['gender'];
                }
                if(isset($data['birthdate']) && $data['birthdate'] != ''){
                    $userData->birthdate = $data['birthdate'];
                }
                $userData->save();

                if($userData){


                    $this->LogOutput(Response::json(array('status'=>200,'message' => 'User\'s addtional information updated!')));
                    return Response::json(array('status'=>200,'message' => 'User\'s addtional information updated!'),200);    

                } else {

                    $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong')));
                    return Response::json(array('status'=>500,'message' => 'Something went wrong'),500);    
                }

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'User not found!')));
                return Response::json(array('status'=>500,'message' => 'User not found!'),500);                   
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function appliedPostList(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $getappliedList = UserAppliedPost::where('id',$headers['user-id'])->with(['post'])->get();

            if($getappliedList){

                $postdata = array();

                foreach($getappliedList as $ak => $av){

                    $postdata[$ak]['applied_id'] = $av->id;
                    $postdata[$ak]['post_title'] = $av->post->title;
                    $postdata[$ak]['type'] = $av->type;
                    $postdata[$ak]['status'] = $av->status ? "Attend" : "Deleted";
                    $postdata[$ak]['applied_on'] = date('d-m-Y',strtotime($av->created_at));
                }

                $this->LogOutput(Response::json(array('status'=>200,'data' => $postdata)));
                return Response::json(array('status'=>200,'data' => $postdata),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'No Data found!')));
                return Response::json(array('status'=>500,'message' => 'No Data found!'),500);    
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function appliedForPost(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('post_id') || Input::get('post_id') == "")
            $errors_array['post_id'] = 'Please pass post_id';
        if (!Input::has('type') || Input::get('type') == "")
            $errors_array['type'] = 'Please pass type';

        if(count($errors_array) == 0){

            $data = Input::all();

            $userData = new UserAppliedPost;
            $userData->user_id = $headers['user-id'];
            $userData->post_id = $data['post_id'];
            $userData->type = $data['type'];
            $userData->save();

            if($userData){


                $this->LogOutput(Response::json(array('status'=>200,'message' => 'Successfully Applied for this post')));
                return Response::json(array('status'=>200,'message' => 'Successfully Applied for this post'),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong'),500);    
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function removeApplication(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!Input::has('applied_id') || Input::get('applied_id') == "")
            $errors_array['applied_id'] = 'Please pass applied_id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $userData = UserAppliedPost::findOrFail($data['applied_id']);
            $userData->status = 0;
            $userData->save();

            if($userData){


                $this->LogOutput(Response::json(array('status'=>200,'message' => 'Successfully remove this post')));
                return Response::json(array('status'=>200,'message' => 'Successfully remove this post'),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong'),500);    
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }

    public function uploadImageForCertificate(){

        $this->LogInput();
        $errors_array = array();
        $headers = apache_request_headers();
        $base_path = URL::to('/');
        
        if (!isset($headers['user-id']) || $headers['user-id'] == "")
            $errors_array['user-id'] = 'Please enter user id';
        if (!Input::has('post_id') || Input::get('post_id') == "")
            $errors_array['post_id'] = 'Please pass post_id';

        if(count($errors_array) == 0){

            $data = Input::all();

            $upload = new UploadCertificate;
            $upload->user_id = $headers['user-id'];
            $upload->post_id = $data['post_id'];
            if(isset($data['file'])){
                $fileName = $this->uploadImage($data['file'],'certificate');
                $upload->file = $fileName;         
            }
            $upload->save();

            if($upload){

                $this->LogOutput(Response::json(array('status'=>200,'message' => 'Certificate successfully uploaded')));
                return Response::json(array('status'=>200,'message' => 'Certificate successfully uploaded'),200);    

            } else {

                $this->LogOutput(Response::json(array('status'=>500,'message' => 'Something went wrong')));
                return Response::json(array('status'=>500,'message' => 'Something went wrong'),500);    
            }

        } else {

            $this->LogOutput(Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array)));
            return Response::json(array('status'=>500,'message' => 'errors','errors' => $errors_array),500); 
        }   
    }
}
