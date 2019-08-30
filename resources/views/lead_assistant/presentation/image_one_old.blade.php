@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('pdf') }}/{{ $imageName }}">                
</div>
<br>
<center>
	<a href="{{ route('imageTwo',[$id,$proposalId]) }}" class="next">Next &raquo;</a>
</center>
@endsection