<style type="text/css">
.error{
    color:red;
}
</style>
<div class="form-group">
    <label for="inputAppoDate">Appointment Date</label>
    <input type="text" class="form-control js-datepicker" id="inputAppoDate" placeholder="Appointment Date" name="appointment_date" value="@if(!is_null($getAssignList) && $getAssignList->lead_assistant_id != '') {{ $getAssignList->date }} @endif" autocomplete="off" required>
</div>
<table class="table">
	<tr>
		<th>Lead Assistant Name</th>
		<th>#</th>
	</tr>
@if(!is_null($findLindAssistant))
	@foreach($findLindAssistant as $fk => $fv)
		<tr>
			<td>{{ $fv->name }}</td>
			<td><input type="radio" name="lead_assistant" value="{{ $fv->id }}" @if(!is_null($getAssignList) && $getAssignList->lead_assistant_id == $fv->id) checked="checked" @endif required></td>
		</tr>
	@endforeach
@endif
</table>