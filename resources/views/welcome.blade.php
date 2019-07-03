@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bill Calculation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Bill Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="" required>

                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <a href="javascript:void(0);" class="btn btn-primary" id="calculate">
                                    {{ __('Estimate My Savings!') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group row show" style="display:none;">
                            <label for="planSize" class="col-md-4 col-form-label text-md-right">{{ __('Solar Plant Size (kW)') }}</label>

                            <div class="col-md-6">
                                <input id="planSize" type="text" class="form-control" name="plan_size" value="" required readonly>

                            </div>
                        </div>

                      <!--   <div class="form-group row">
                            <label for="generation" class="col-md-4 col-form-label text-md-right">{{ __('Energy Generation') }}</label>

                            <div class="col-md-6">
                                <input id="generation" type="text" class="form-control" name="energy" value="" required readonly>

                            </div>
                        </div> -->

                        <div class="form-group row show" style="display:none;">
                            <label for="monthly_energy" class="col-md-4 col-form-label text-md-right">{{ __('Monthly Energy Saving ( Rs )') }}</label>

                            <div class="col-md-6">
                                <input id="monthly_energy" type="text" class="form-control" name="monthly_energy" value="" required readonly>

                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="payback_period" class="col-md-4 col-form-label text-md-right">{{ __('Payback Period') }}</label>

                            <div class="col-md-6">
                                <input id="payback_period" type="text" class="form-control" name="payback_period" value="" required readonly>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="free_energy_generation" class="col-md-4 col-form-label text-md-right">{{ __('Free Energy Generation') }}</label>

                            <div class="col-md-6">
                                <input id="free_energy_generation" type="text" class="form-control" name="free_energy_generation" value="" required readonly>

                            </div>
                        </div> -->

                        <div class="form-group row mb-4 getCall" style="display:none;">
                            <div class="col-md-8 offset-md-4">
                                <a href="javascript:void(0);" class="btn btn-danger" id="getCall">
                                    {{ __('Get a call') }}
                                </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Get a request call</h4>
          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('saveGetCallRequest') }}" novalidate="novalidate">
                @csrf

                <input type="hidden" name="amount" id="modal_amount">
                <input type="hidden" name="plant_size" id="modal_planSize">
                <input type="hidden" name="monthly_energy_saving" id="modal_monthly_energy_saving">

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="" required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                    <div class="col-md-6">
                        <input id="mobile" type="text" class="form-control" name="mobile" value="" required>

                    </div>
                </div>

                <div class="form-group row mb-4 getCall">
                    <div class="col-md-8 offset-md-4">
                        <button ntype="submit" class="btn btn-danger">
                            {{ __('Get a call') }}
                        </button>
                    </div>
                </div>
                        
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click','#calculate',function(){
        var amount = $('#amount').val();
        $('#planSize').val(parseFloat(amount / 750).toFixed(2));
        $('#monthly_energy').val(parseFloat((amount * 75) / 100).toFixed(2));
        $('.show').show();
        $('.getCall').show();
    });

    $(document).on('click','#getCall',function(){
        $('#modal_planSize').val($('#planSize').val());
        $('#modal_monthly_energy_saving').val($('#monthly_energy').val());
        $('#modal_amount').val($('#amount').val());
        $('#myModal').modal('show');
    });
</script>
@endsection
