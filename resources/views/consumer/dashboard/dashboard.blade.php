@extends('layouts.consumer')
@section('title','Consumer | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">Consumer Timeline</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pull-up">
        <div class="row">
            
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                        <div class="timeline">

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Register Inquiry</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 20, 2018</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Call By Center Agent</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 21, 2018</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-warning rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Meeting With Lead Assistant</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 22, 2018</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-warning rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Sign Contract</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 22, 2018</div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-wrapper">
                                    <div class="">
                                        <div class="avatar avatar-sm">
                                            <div class="avatar-title bg-warning rounded-circle">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="m-0">Payment</h6>
                                    </div>
                                    <div class="ml-auto col-auto text-muted">July 22, 2018</div>
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
