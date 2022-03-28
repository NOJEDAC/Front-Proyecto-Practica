@extends('layouts.app')


@section('title', 'Modificar Cliente')

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
			{!! Form::open(['route' => ['usersUpdate', $user->id], 'method' => 'PUT']) !!}
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-3">
					<div class="form-group">
						{!! Form::label('firstName', 'Nombre') !!}
						{!! Form::text('firstName',$user->firstName,['class' =>'form-control', 'placeholder' => 'Nombre Cliente', 'required']) !!}
						{!! Form::label('lastName', 'Apellido') !!}
						{!! Form::text('lastName',$user->lastName,['class' =>'form-control', 'placeholder' => 'Apellido Cliente', 'required']) !!}
						{!! Form::label('identityDocument', 'Documento Identidad') !!}
						{!! Form::text('identityDocument',$user->identityDocument,['class' =>'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
					</div>
				</div>

				<div class="col-md-3"></div>
			</div>
            <br>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-3">
				    <div class="form-group">
					{!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
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
