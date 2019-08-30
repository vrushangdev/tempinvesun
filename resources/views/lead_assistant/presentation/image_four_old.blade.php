@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/presentation/img_four.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageThree',[$id,$proposal_id]) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('imageFive',[$id,$proposal_id]) }}" class="next">Next &raquo;</a>
</center>
@endsection