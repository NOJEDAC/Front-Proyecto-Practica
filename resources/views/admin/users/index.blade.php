@extends('layouts.app')
@section('title','Listado Clientes')

@section('content')

<div class="container">

    {!! Form::model(Request::All() ,['route' => 'clienteIndex', 'method' => 'GET']) !!}
    <div class="row">
		<div class="col-md-8"><h1>@yield('title')</h1></div>

</div>
    <p class="navbar-text navbar-right">
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-large btn-success" href="{{route('clienteNuevo')}}" title="Eliminar"  role="button"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
                </div>
                <div class="col-md-3">
                    {!! Form::text('value',null ,['class' =>'form-control', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-default']) !!}</span>
                    </div>
                </div>
            </div>
    </p>
    {{Form::close()}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Opciones</th>
                </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($cliente->items() as $user)

                    <td>{{$user->identityDocument}}</td>
                    <td>{{$user->firstName}}</td>
                    <td>{{$user->lastName}}</td>
                    <td>
                        <a class="btn btn-success" href="{{route('clienteEdit',$user->id)}}" title="Editar usuario" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-danger" href="{{route('clienteDelete', $user->id)}}" title="Eliminar" onclick="return confirm('Quiere borrar el usuario?')" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
            </tr>
                @endforeach
        </tbody>
    </table>
    {{ $cliente->appends(Request::all())->links() }}
</div>
@endsection
