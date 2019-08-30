@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/img/13-13.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageTwelve',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('verifyPresentation',[$id,$proposal_id]) }}" class="next">Verify Presentation &raquo;</a>
</center>
@endsection