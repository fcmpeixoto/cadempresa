@extends('layouts.app')

@section('title', "Editar Empresa {$rsCompanies->name}")

@section('content_header')
    <h1>Editar Empresa {{ $rsCompanies->name }}</h1>
@stop

@section('content')

    <nav aria-label="breadcrumb" class="m-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><a href="#">Dashboard</a></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('companie.index') }}">Listar Empresas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $rsCompanies->name }}</li>
        </ol>
    </nav>

    <div class="card">

        <div class="card-body">
            <form action="{{ route('companie.update', $rsCompanies->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @include('admin.includes.alerts')
                            <div class="card">
                                <div class="card-header">Cadastro da Empresas</div>

                                @include('admin.pages.companies._partials.form')
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
