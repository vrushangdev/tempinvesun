@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/img/summery.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageNine',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('imageEleven',[$id,$proposal_id]) }}" class="next">Next &raquo;</a>
</center>
@endsection