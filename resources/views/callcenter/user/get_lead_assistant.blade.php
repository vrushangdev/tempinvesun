
<table class="table table-hover">
    <thead>
    <tr>
        <th>Lead Assistant</th>
        <th style="text-align: center">Morning</th>
        <th style="text-align: center">Afternoon</th>
        <th style="text-align: center">Evening</th>
    </tr>
    </thead>
    <tbody>
        @if(count($leadAssistantArray) > 0)
            @foreach($leadAssistantArray as $lk => $lv)
                <tr>
                    <td>{{ $lv['lead_assistant'] }}</td>
                    <td style="text-align: center">
                        @if(isset($lv['leave_data']) && isset($lv['leave_data'][0]))
                            @if(isset($lv['data']) && in_array(1,$lv['data'])) 
                                Assigned
                            @else 
                                <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $lv['lead_assistant_id']}}-1"> 
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if(isset($lv['leave_data']) && isset($lv['leave_data'][1]))
                            @if(isset($lv['data']) && in_array(2,$lv['data'])) 
                                Assigned 
                            @else 
                                <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $lv['lead_assistant_id']}}-2"> 
                            @endif
                        @else 
                             N/A
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if(isset($lv['leave_data']) && isset($lv['leave_data'][1]))
                            @if(isset($lv['data']) && in_array(3,$lv['data'])) 
                                Assigned 
                            @else 
                                <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $lv['lead_assistant_id']}}-3"> 
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">No Lead Assistant Found</td>
            </tr>
        @endif
    </tbody>
</table>