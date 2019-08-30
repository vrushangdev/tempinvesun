@extends('layouts.presentation_new')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')
<section class="gradient-01">
    <div class="container ">
        <div class="row m-h-100 ">
            <div class="col-md-12 col-lg-12 m-auto">
            	<div class="avatar">
                    <a href="{{ route('imageEight',[$id,$proposal_id]) }}" class="previous">
    			        <div class="avatar avatar-title bg-success rounded-circle slider-btn-left">
    			        	<i class="mdi mdi-arrow-left-thick"></i>
    			        </div>
                    </a>
			    </div>
			    <div class="avatar right">
			    	<a href="{{ route('imageEleven',[$id,$proposal_id]) }}" class="next">
				        <div class="avatar avatar-title bg-success rounded-circle slider-btn-right">
				        	<i class="mdi mdi-arrow-right-thick"></i>
				        </div>
				    </a>
			    </div>
                <div class="bg-white rounded shadow-lg">
                    <div class=" padding-box-2 p-all-25">
                        <div class="">
                           	<img src="{{ asset('pdf') }}/{{ $imageName }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection