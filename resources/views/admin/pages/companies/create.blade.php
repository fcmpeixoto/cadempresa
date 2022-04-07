@extends('layouts.app')

@section('title', 'Cadastrar Nova Empresa')


@section('content_header')
    <h1>Cadastrar Nova Empresa</h1>
@stop
@section('pluginsCss')
    @parent
@endsection
@section('content')

    <nav aria-label="breadcrumb" class="m-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><a href="#">Dashboard</a></a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('companie.index') }}">Listar Empresas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrando nova Empresa</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('companie.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @include('admin.includes.alerts')
                            <div class="card">
                                <div class="card-header">Nova Empresas</div>

                                @include('admin.pages.companies._partials.form')
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
