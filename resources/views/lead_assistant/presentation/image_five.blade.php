@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/presentation/img_five.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageFour',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('formOne',[$id,$proposal_id]) }}" class="next">Next &raquo;</a>
</center>
@endsection