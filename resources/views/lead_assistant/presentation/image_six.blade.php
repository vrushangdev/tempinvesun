@extends('layouts.presentation')
@section('title','Lead Assistant Dashboard | Invesun')
@section('content')

<div id="page">
	<img src="{{ asset('img/presentation/img_six.jpg') }}">                
</div>
<br>
<center>
	<a href="{{ route('imageFive',$id) }}" class="previous">&laquo; Previous</a>
	<a href="{{ route('formOne',$id) }}" class="next">Next &raquo;</a>
</center>
@endsection