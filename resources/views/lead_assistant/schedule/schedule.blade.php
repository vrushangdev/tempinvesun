@extends('layouts.lead_assistant')
@section('title','Lead Assistant\'s Work Schedule | Invesun')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">  Lead Assistant's Work Schedule</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            <!-- <i class="mdi mdi-checkbox-intermediate"></i> Tables -->
                        </h5>
                         <div class="form-group">
                            <label for="inputRole">Week Number</label>
                            <select class="form-control col-lg-3" name="week_number" id="inputWeekNumber" required>
                                <option value="">Select Week Number</option>
                                @foreach($weekCounter as $key => $value)
                                    <option value="{{ $value['week'] }}" @if($value['week'] == $weekNumber) selected="selected" @endif>{{ $value['string'] }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <form method="post" action="{{ route('saveWorkSchedule') }}">
                            @csrf
                            <div class="schedule">
                                <table class="table table-hover">
                                    <input type="hidden" name="week" value="{{ $weekNumber }}">
                                    <input type="hidden" name="year" value="{{ $year }}">
                                
                                    <thead>
                                    <tr>
                                        <th></th>
                                    @foreach($getWeekDates as $date)
                                        <th>{{ $date['day'] }} <br> {{ $date['date'] }}</th>
                                    @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Morning</td>
                                            @foreach($getWeekDates as $mk => $date)
                                                <td><input type="checkbox" name="data[0][date][{{ $mk }}][date]" value="{{ $date['date'] }}" @if(in_array($date['date'],$morningDate)) checked @endif></td>
                                            @endforeach
                                        </tr>
                                        
                                        <tr>
                                            <td>Afternoon</td>
                                            @foreach($getWeekDates as $ak => $date)
                                                <td><input type="checkbox" name="data[1][date][{{ $ak }}][date]" value="{{ $date['date'] }}" @if(in_array($date['date'],$noonDate)) checked @endif></td>
                                            @endforeach
                                        </tr>
                                        
                                        <tr>
                                            <td>Evening</td>
                                            @foreach($getWeekDates as $ek => $date)
                                                <td><input type="checkbox" name="data[2][date][{{ $ek }}][date]" value="{{ $date['date'] }}" @if(in_array($date['date'],$eveningDate)) checked @endif></td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('change','#inputWeekNumber',function(){
        if($(this).val() != ''){
            $.ajax({
                type: "post",
                url: '{{ route("lead_assistant.getNextScheduleData") }}',
                data:{ week : $(this).val()},
                success:function(data){
                    $('.schedule').html(data);
                }
            });
        }
    });
</script>
@endsection
