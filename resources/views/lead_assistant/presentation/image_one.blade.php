@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/presentation/img_one.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageTwo',$id) }}" class="next">Next &raquo;</a>
</center>
@endsection