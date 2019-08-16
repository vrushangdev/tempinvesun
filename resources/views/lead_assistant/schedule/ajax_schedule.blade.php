<table class="table table-hover">
    <input type="hidden" name="week" value="{{ $week }}">
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