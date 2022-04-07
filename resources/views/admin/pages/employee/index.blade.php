@extends('layouts.app')

@section('title', 'Cadastro de Funcionário')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{-- route('system') --}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Funcionário</li>
    </ol>
@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('admin.includes.alerts')
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('employee.create') }}" class="btn btn-primary" type="button">Novo Cadastro</a>
                </div>
                <div class="card">
                    <div class="card-header">Cadastro de Funcionário</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <form action="{{ route('employee.search') }}" method="POST" class="input-group mb-3">
                                @csrf
                                <input type="text" class="form-control" placeholder="Filtrar:"
                                       aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ $filters['filter'] ?? '' }}">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                            </form>

                        </div>
                        <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Empresa</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rsEmployee as $dtEmployee)
                        <tr>
                            <th scope="row">{{ $dtEmployee->companie->name }}</th>
                            <td>{{ $dtEmployee->name }}</td>
                            <td>{{ $dtEmployee->last_name }}</td>
                            <td>{{ $dtEmployee->email }}</td>
                            <td>{{ $dtEmployee->telephone }}</td>
                            <td class="text-center">
                                <a href="{{ route('employee.show', $dtEmployee->id) }}" class="m-2">
                                    <i class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </i>
                                </a>
                                <a href="{{ route('employee.destroy', $dtEmployee->id) }}" class="m-2"
                                   onclick="event.preventDefault();
                                                     document.getElementById('destroy-form').submit();">
                                    <i class="text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </i>
                                </a>
                                <form id="destroy-form" action="{{ route('employee.destroy',$dtEmployee->id) }}" method="POST" class="d-none">
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
                            {!! $rsEmployee->appends($filters)->links() !!}
                        @else
                            {!! $rsEmployee->links() !!}
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

