<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EnergyDataSet;
use App\Models\GetCallRequest;
use App\Models\Installer;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;


class HomeController extends Controller
{
    
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    
    public function index(Request $request)
    {   
       
        $shared = '';
        $shared_id = '';

        if(count($request)){
            $shared = $request->shared;
            $shared_id = $request->sharing_id;
        }

        return view('front.home.index',compact('shared','shared_id'));
    }

    public function saveGetCallRequest(Request $request){

        $user = new User;
        $user->form_name = $request->name;
        $user->mobile = $request->mobile;
        $user->account_registation = date('d-m-Y');
        if($request->shared_id != '' && $request->shared != ''){
            $user->signup_sharing_by = $request->shared;
            $user->signup_sharing = $request->shared_id;
        }
        $user->save();

        $energy = new EnergyDataSet;
        $energy->user_id = $user->id;
        $energy->plant_size = $request->plant_size;
        $energy->monthly_energy_saving = $request->monthly_energy_saving;
        $energy->save();

        $getRequest = new GetCallRequest;
        $getRequest->user_id = $user->id;
        $getRequest->save();

        return redirect(route('thankYou'))->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Request',
                  'message' => 'Your request successfully submitted. Our customer executive contact you shortly!',
              ],
        ]);
    }

    public function checkUserEmail(Request $request){

        $query = User::query();
        $query->where('email',$request->email);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);
        }
        $getUser = $query->first();

        if(!is_null($getUser)){
            return 'false';
        } else {
            return 'true';
        }
    }

    public function checkUserMobile(Request $request){

        $query = User::query();
        $query->where('mobile',$request->mobile);
        if(isset($request->user_id) && $request->user_id != ''){
            $query->where('id','!=',$request->user_id);
        }
        $getUser = $query->first();

        if(!is_null($getUser)){
            return 'false';
        } else {
            return 'true';
        }
    }

    public function getCityName(Request $request){

        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDbX_JirTlqgj9BO002nMah8CQSD7f4ypI&address=" . $request->zip . "&sensor=true";

        $address_info = file_get_contents($url);
        $json = json_decode($address_info);
        // echo "<pre>";
        // print_r($json);
        // exit;
        $city = "";
        $state = "";
        $country = "";
        if (count($json->results) > 0) {
            //break up the components
            $arrComponents = $json->results[0]->address_components;

            foreach($arrComponents as $index=>$component) {
               
                $type = $component->types[0];

                if ($city == "" && ($type == "sublocality_level_1" || $type == "locality") ) {
                    $city = trim($component->short_name);
                }
                if ($state == "" && $type=="administrative_area_level_1" || $type=="administrative_area_level_2") {
                    $state = trim($component->short_name);
                }
                if ($country == "" && $type=="country") {
                    $country = trim($component->short_name);
                }
                if ($city != "" && $state != "" && $country != "") {
                    //we're done
                    break;
                }
            }
        }

        $arrReturn = array("city"=>$city, "state"=>$state, "country"=>$country);

        return $arrReturn;
    }

    public function getStateList(Request $request){

        $getStateList = State::where('country_id',$request->id)->get();

        $html = '<option value="">Select State</option>';
        if(isset($getStateList) && count($getStateList) > 0){
            foreach($getStateList as $sk => $sv){
                $html .= '<option value="'.$sv->id.'">'.$sv->name.'</option>';
            }
        }

        return $html;
    }

    public function getCityList(Request $request){

        $getCityList = City::where('state_id',$request->id)->get();

        $html = '<option value="">Select City</option>';
        if(isset($getCityList) && count($getCityList) > 0){
            foreach($getCityList as $sk => $sv){
                $html .= '<option value="'.$sv->id.'">'.$sv->name.'</option>';
            }
        }

        return $html;
    }

    public function editPdf(){

        $pdf = new FPDI('l');

        $name = "6.5 KWH";
        $ngo = 'test';

        $pageCount = $pdf->setSourceFile(public_path()."/pdf/invesun.pdf");
        $tpl = $pdf->importPage(6);

        $pdf->AddPage('L');
        $pdf->useTemplate($tpl,10);
        $pdf->SetFont('Helvetica');
        // Use the imported page as the template
        $pdf->SetFontSize('25'); // set font size
        $pdf->SetXY(10, 89); // set the position of the box
        $pdf->Cell(0, -13, $name, 0, -20, 'C');



        //$pdf->Image($imageUrl, 125, 95, 0, '', '', 'http://www.tcpdf.org', '', false, 0);

        $pdf->SetFontSize('10'); // set font size
        $pdf->SetXY(90, 123); // set the position of the box
        $pdf->Cell(0, 25, $ngo, 0, -20, 'C');

        $filename = md5(time()).".pdf";

        $pdf->Output(public_path()."/pdf/".$filename,'F');
    }

    public function termsAndPrivacy(){
        return view('front.home.terms_and_conditions');
    }

    public function privacyPolicy(){
        return view('front.home.privacy_policy');
    }

    public function thankYou(){
        return view('front.home.thankyou');   
    }

    public function sendSms($message,$mobile_no,$otp){

        $authkey = '118632ADgeSTsOyKEv5d6393e1';

        $senderid = 'TFMMSG';

        $message = urlencode($message);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?otp=".$otp."&sender=".$senderid."&message=".$message."&mobile=".$mobile_no."&authkey=".$authkey,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } 

        return "true";
    }

    public function generateUserOtp(Request $request){

        $getRequest = User::where('mobile',$request->email)->first();

        if(!is_null($getRequest)){

            return 'true';

        } else {

            return 'false';
        }
    }

    public function generateOtp(Request $request){

        $getRequest = User::where('mobile',$request->mobile)->first();

        if(!is_null($getRequest)){

            $token = mt_rand(100000,999999);

            $message = "Your verfication otp is ##".$token."##";

            $this->sendSms($message,$getRequest->mobile,$token);

            $updateToken = User::where('id',$getRequest->id)->update(['otp' => $token]);

            return 'true';

        } else {

            return 'false';
        }
    }

    public function installer(){
        return view('front.home.installer');
    }

    public function saveInstaller(Request $request){

        $saveInstaller = new Installer;
        $saveInstaller->company_name = $request->company_name;
        $saveInstaller->owner_name = $request->owner_name;
        $saveInstaller->owner_mobile = $request->owner_mobile;
        $saveInstaller->owner_email = $request->owner_email;
        $saveInstaller->constitation = $request->constitation;
        $saveInstaller->pincode = $request->pincode;
        $saveInstaller->city = $request->city;
        $saveInstaller->state = $request->state;
        $saveInstaller->installation_capacity = $request->installation_capacity;
        $saveInstaller->gst = $request->gst;
        $saveInstaller->save();

        return redirect()->back()->with('messages', [
              [
                  'type' => 'success',
                  'title' => 'Request',
                  'message' => 'Your request successfully submitted. We are contact you shortly!',
              ],
        ]);


    }
}
