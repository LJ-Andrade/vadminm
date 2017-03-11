@extends('vadmin.layouts.main')

@section('title', 'Admin | Inicio')
  
@section('content')

    <div class="container">
        <div class="row">
    		<br><br><br>
            <h1>VADmin</h1>
            <h3>Gestor de Contenidos</h3>
            <hr>
            <h5>Bienvenido Invitado </h5>
            <hr>
    		{{-- <a href="vadmin/articles" class="btn btn-info">Artículos</a> --}}
    		<a href="vadmin/images" class="btn btn-info">Imágenes</a>
            {{-- <a href="vadmin/users" class="btn btn-info">Listado de Usuarios</a> --}}
            {{-- <a href="vadmin/categories" class="btn btn-info">Categorias</a> --}}
            {{-- <a href="vadmin/tags" class="btn btn-info">Tags</a> --}}
        </div>
    </div>  

@endsection



