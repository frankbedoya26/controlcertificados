@extends('adminlte::page')

@section('title', 'Control de certificados')

@section('content_header')
<h1></h1>
@stop

@section('content')
	<div id="app">
		@include('nuevasolicitud.principal')		
	</div>
@stop

@section('js')
	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @include('nuevasolicitud.vue')
@stop