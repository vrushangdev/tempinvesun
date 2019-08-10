@extends('layouts.callcenter')
@section('title','Call Center Agent Dashboard | Invesun')
@section('content')
<section class="admin-content">
    <div class="container p-t-20">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="h6 text-muted ">Unattended Leads</div>
                                    </div>

                                    <div class="col-auto my-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle badge-soft-danger"><i
                                                        class="mdi mdi-heart  "></i></div>

                                        </div>
                                    </div>
                                </div>
                                <h1 class="display-4 fw-600">{{ $unattendList }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="h6 text-muted ">Followup Leads </div>
                                    </div>

                                    <div class="col-auto my-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-soft-primary"><i
                                                        class="mdi mdi-script  "></i></div>

                                        </div>
                                    </div>
                                </div>
                                <h1 class="display-4 fw-600">{{ $callbackList }}</h1>
                            </div>
                        </div>
                        <!--widget card ends-->

                    </div>
                    <div class="col-lg-3">
                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="h6 text-muted "> New Leads</div>
                                    </div>

                                    <div class="col-auto my-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-soft-primary"><i
                                                        class="mdi mdi-script  "></i></div>

                                        </div>
                                    </div>
                                </div>
                                <h1 class="display-4 fw-600">{{ $newLeads }}</h1>
                            </div>
                        </div>
                        <!--widget card ends-->

                    </div>
                    <div class="col-lg-3">
                        <!--widget card begin-->
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="h6 text-muted ">Attended Leads out of Total Leads</div>
                                    </div>

                                    <div class="col-auto my-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-soft-primary"><i
                                                        class="mdi mdi-script  "></i></div>

                                        </div>
                                    </div>
                                </div>
                                <h1 class="display-4 fw-600">{{ $attendList }}/{{ $totalLeads }}</h1>
                            </div>
                        </div>
                        <!--widget card ends-->

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
