<?php

namespace App\Http\Controllers\Leadassistant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresentationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('lead_assistant');
    }

    public function imageOne($id){

    	return view('lead_assistant.presentation.image_one',compact('id'));
    }

    public function imageTwo($id){
    	
    	return view('lead_assistant.presentation.image_two',compact('id'));	
    }

    public function imageThree($id){
    	
    	return view('lead_assistant.presentation.image_three',compact('id'));
    }

    public function imageFour($id){
    	return view('lead_assistant.presentation.image_four',compact('id'));
    }

    public function imageFive($id){
    	return view('lead_assistant.presentation.image_five',compact('id'));
    }

    public function imageSix($id){
    	return view('lead_assistant.presentation.image_six',compact('id'));
    }

    public function formOne($id){
    	return view('lead_assistant.presentation.form_one',compact('id'));
    }

    public function formTwo($id){
    	return view('lead_assistant.presentation.form_two',compact('id'));
    }

    public function formThree($id){
    	return view('lead_assistant.presentation.form_three',compact('id'));
    }


}
