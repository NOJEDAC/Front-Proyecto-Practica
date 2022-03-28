@extends('layouts.app')

@section('title', 'Crear Usuarios')

@section('content')

@if(count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>


@endif
<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8"><h1>@yield('title')</h1></div>

</div>
	{!! Form::open(['route' => 'clienteStore', 'method' => 'POST', 'files' => true]) !!}
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('firstName', 'Nombre') !!}
				{!! Form::text('firstName',null,['class' =>'form-control', 'placeholder' => 'Nombre', 'required']) !!}
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('lastName', 'Apellido') !!}
				{!! Form::text('lastName',null,['class' =>'form-control', 'placeholder' => 'Apellido', 'required']) !!}
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-6">
		    <div class="form-group">
				{!! Form::label('identityDocument', 'Documento de Identidad') !!}
				{!! Form::text('identityDocument',null,['class' =>'form-control', 'placeholder' => '46780390', 'required']) !!}
			</div>
		</div>
	</div>
    <br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-3">
		    <div class="form-group">
				{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
		<div class="col-md-3">
		    <div class="form-group">
				 <a class="btn btn-danger" href="{{ route('clienteIndex') }}"><i class="fa fa-btn fa-bank"></i>Cancel</a>
			</div>
		</div>
	</div>

	{!! Form::close() !!}

@endsection
