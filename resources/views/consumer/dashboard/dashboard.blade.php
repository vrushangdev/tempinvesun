@extends('layouts.consumer')
@section('title','Consumer | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark m-b-30">
        <div class="container">
            <div class="row p-b-60 p-t-60">

                <div class="col-md-6 text-white p-b-30">
                    <div class="media">
                        <div class="avatar avatar mr-3">
                            <img src="assets/img/users/user-2.jpg" class="rounded-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h1>{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}</h1>
                            <p class="opacity-75">
                                {{ Auth::user()->address1 }}
                                @if(Auth::user()->address2 != '')
                                    , {{ Auth::user()->address2 }}, {{ $getCity->name }}, {{ $getCountry->name }}
                                @endif
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container pull-up">
        <div class="row">
            <div class="col-lg-4 order-1 order-lg-0 m-b-30">
                <div class="card m-b-30">

                    <div class="list-group list  list-group-flush">

                        <div class="list-group-item p-all-15 h6 ">
                            <i class="mdi  mdi-18px mdi-email"></i> {{ Auth::user()->email }}</a>
                        </div>
                        <div class="list-group-item p-all-15 h6 ">
                            <i class="mdi  mdi-18px mdi-cellphone-iphone"></i> {{ Auth::user()->mobile }} </a>
                        </div>
                        <div class="list-group-item p-all-15 h6 ">
                            <i class="mdi  mdi-18px mdi-solar-power"></i> {{ intval($getUserPreview->suggest_system_size,0) }} kWp</a>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header">

                        <div class="card-title">
                            <div class="avatar mr-2 avatar-xs">
                                <div class="avatar-title bg-success rounded-circle">
                                    <i class="mdi mdi-credit-card mdi-18px"></i>
                                </div>
                            </div>
                            Payment
                        </div>
                    </div>
                    <div class="list-group list  list-group-flush">

                        <div class="list-group-item p-all-15 h6 text-muted ">
                            <a href="javascript:void(0);" class="btn btn-primary">Pay Now</a>                            
                            <a href="javascript:void(0);" class="btn btn-info">Apply For Loan</a>                            
                        </div>

                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header">

                        <div class="card-title">
                            <div class="avatar mr-2 avatar-xs">
                                <div class="avatar-title bg-primary rounded-circle">
                                    <i class="mdi mdi-timelapse mdi-18px"></i>
                                </div>
                            </div>
                            Support Executive

                        </div>
                    </div>
                    <div class="list-group list  list-group-flush">
                        @if(!is_null($getLeadRequest->lead_assistant))
                            <div class="list-group-item p-all-15 h6 text-muted ">
                                <i class="mdi mdi-account"></i>
                                {{ $getLeadRequest->lead_assistant->name }}
                            </div>

                            <div class="list-group-item p-all-15 h6 text-muted ">
                                <i class="mdi mdi-cellphone-iphone"></i>
                                    {{ $getLeadRequest->lead_assistant->mobile }}
                            </div>
                        @else
                            <div class="list-group-item p-all-15 h6 text-muted ">
                                <i class="mdi mdi-map-marker"></i>
                                    Not Yet Assigned
                            </div>
                        @endif


                    </div>
                </div>
            </div>

            <div class="col-lg-8 m-b-30">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Timeline</div>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                          
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            @if(Auth::user()->account_registation != '')
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-check-all"></i>
                                                </div>
                                            @else
                                                <div class="avatar-title bg-grey rounded-circle">
                                                    <i class="mdi mdi-alert-circle-outline"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Account Registration</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">{{ Auth::user()->account_registation ? date('d M Y',strtotime(Auth::user()->account_registation)) : "" }}</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            @if(Auth::user()->site_visit != '')
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-check-all"></i>
                                                </div>
                                            @else
                                                <div class="avatar-title bg-grey rounded-circle">
                                                    <i class="mdi mdi-alert-circle-outline"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Site Visit Confirmed</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">{{ Auth::user()->site_visit ? date('d M Y',strtotime(Auth::user()->site_visit)) : "" }}</div>
                                </div>

                            </div>
                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            @if($getLeadRequest->is_attend == 1)
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-check-all"></i>
                                                </div>
                                            @else
                                                <div class="avatar-title bg-grey rounded-circle">
                                                    <i class="mdi mdi-alert-circle-outline"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Proposal Recieved</h6>
                                    </div>
                                    @if($getLeadRequest->is_attend == 1)
                                        <div class="ml-auto col-auto text-muted">{{ $getLeadRequest->proposal_recieved ? date('d M Y',strtotime($getLeadRequest->proposal_recieved)) : "" }}</div>
                                    @endif

                                </div>

                            </div>

                             <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-grey rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Order Confirmed</h6>
                                    </div>
                                    <!-- <div class="ml-auto col-auto text-muted">July 20, 2018</div> -->

                                </div>

                            </div>

                             <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-grey rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Government Permission Applied</h6>
                                    </div>
                                    <!-- <div class="ml-auto col-auto text-muted">July 20, 2018</div> -->

                                </div>

                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-grey rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Permission Approved</h6>
                                    </div>
                                    <!-- <div class="ml-auto col-auto text-muted">July 20, 2018</div> -->

                                </div>

                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-grey rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Plan Installation</h6>
                                    </div>
                                    <!-- <div class="ml-auto col-auto text-muted">July 20, 2018</div> -->

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
