<div class="card m-b-30 leadPopup">
    <div class="card-header">
        <h5 class="m-b-0">
             Assign Lead Assistant
        </h5>
    </div>
    <div class="card-body">
    @if(!is_null($lead_data))
        @foreach($lead_data as $lk => $lv)
            <p>Lead Assistant Name : {{ $lv['name'] }} </p>
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Time Slot</th>
                            <th>Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($lv['appointment_data']))
                            @foreach($lv['appointment_data'] as $ak => $av)
                            <tr>
                                <td>{{ $av['name'] }}</td>
                                <td>{{ $av['count'] }}</td>
                                <td><a href="javscript:void(0);" class="btn btn-primary assign assign_{{ $lv['id'] }}_{{ $av['id'] }}" data-id="{{ $lv['id'] }}" data-value="{{ $av['id'] }}">Assign</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
    </div>
</div>