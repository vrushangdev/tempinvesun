
<table class="table table-hover">
    <thead>
    <tr>
        <th style="text-align: center">Morning</th>
        <th style="text-align: center">Afternoon</th>
        <th style="text-align: center">Evening</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center">
                @if(isset($leadAssistantArray['leave_data']) && isset($leadAssistantArray['leave_data'][0]))
                    @if(isset($leadAssistantArray['data']) && in_array(1,$leadAssistantArray['data'])) 
                        Assigned
                    @else 
                        <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $leadAssistantArray['lead_assistant_id']}}-1"> 
                    @endif
                @else
                    N/A
                @endif
            </td>
            <td style="text-align: center">
                @if(isset($leadAssistantArray['leave_data']) && isset($leadAssistantArray['leave_data'][1]))
                    @if(isset($leadAssistantArray['data']) && in_array(2,$leadAssistantArray['data'])) 
                        Assigned 
                    @else 
                        <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $leadAssistantArray['lead_assistant_id']}}-2"> 
                    @endif
                @else 
                     N/A
                @endif
            </td>
            <td style="text-align: center">
                @if(isset($leadAssistantArray['leave_data']) && isset($leadAssistantArray['leave_data'][2]))
                    @if(isset($leadAssistantArray['data']) && in_array(3,$leadAssistantArray['data'])) 
                        Assigned 
                    @else 
                        <input type="checkbox" class="checkbox" name="lead_assistant" value="{{ $leadAssistantArray['lead_assistant_id']}}-3"> 
                    @endif
                @else
                    N/A
                @endif
            </td>
        </tr>
    </tbody>
</table>