@extends('layouts.app')

@section('title', 'Cadastro de Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{-- route('system') --}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Empresas</li>
    </ol>

    @can('create-employees')
        <h1>Empresas  <a href="{{-- route('system') --}}" class="btn btn-dark">Adicionar</a></h1>
    @endcan

@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('admin.includes.alerts')
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('companie.create') }}" class="btn btn-primary" type="button">Novo Cadastro</a>
                </div>
                <div class="card">
                    <div class="card-header">Cadastro de Empresas</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <form action="{{ route('companie.search') }}" method="POST" class="input-group mb-3">
                                @csrf
                                <input type="text" class="form-control" placeholder="Filtrar:"
                                       aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ $filters['filter'] ?? '' }}">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                            </form>

                        </div>
                        <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Site</th>
                            <th scope="col">E-mail</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rsCompanies as $dtCompanies)
                        <tr>
                            <th scope="row">{{ $dtCompanies->id }}</th>
                            <td><img class="img-thumbnail" style="width: 100px" src="{{ is_null($dtCompanies->logotipo) ? asset('storage/companies/logo/90x90.jpg') : asset('storage/companies/logo/thumbs_'.$dtCompanies->logotipo.'.webp') }}"></td>
                            <td>{{ $dtCompanies->name }}</td>
                            <td>{{ $dtCompanies->address }}</td>
                            <td>{{ $dtCompanies->website }}</td>
                            <td>{{ $dtCompanies->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('companie.show', $dtCompanies->id) }}" class="m-2">
                                    <i class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </i>
                                </a>
                                <a href="{{ route('companie.destroy', $dtCompanies->id) }}" class="m-2"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form').submit();">
                                    <i class="text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </i>
                                </a>
                                <form id="destroy-form" action="{{ route('companie.destroy',$dtCompanies->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">Não há informações de Registros.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    </div>

                    <div class="card-footer">
                        @if (isset($filters))
                            {!! $rsCompanies->appends($filters)->links() !!}
                        @else
                            {!! $rsCompanies->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('pluginsCss')
    @parent

@endsection

@section('pluginsCssManual')
    @parent
@endsection

@section('pluginsScripts')
    @parent
@endsection

@section('pluginsScriptsManual')
    @parent
@endsection

