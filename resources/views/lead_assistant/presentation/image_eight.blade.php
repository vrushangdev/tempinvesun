@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/img/order.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageSeven',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('imageTen',[$id,$proposal_id]) }}" class="next">Next &raquo;</a>
</center>
@endsection