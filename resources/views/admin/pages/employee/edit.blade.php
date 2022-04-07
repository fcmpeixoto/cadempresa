@extends('layouts.app')

@section('title', "Editar Funcionário {$rsEmployee->name}")

@section('content_header')
    <h1>Editar Funcionário {{ $rsEmployee->name }}</h1>
@stop

@section('content')

    <nav aria-label="breadcrumb" class="m-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><a href="#">Dashboard</a></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('employee.index') }}">Listar Funcionário</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $rsEmployee->name }}</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-body">
            <form action="{{ route('employee.update', $rsEmployee->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @include('admin.includes.alerts')
                            <div class="card">
                                <div class="card-header">Cadastro da Funcionário</div>

                                @include('admin.pages.employee._partials.form')
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
