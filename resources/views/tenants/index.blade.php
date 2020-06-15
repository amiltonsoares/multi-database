@extends('tenants.layouts.main')

@section('content')

<h1>
    Empresas
    <a href="{{ route('tenant.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-square"></i>
    </a>
</h1>

@include('tenants.includes.alerts')

<ul class="media-list">
    @forelse($tenants as $tenant)
    <li class="media">
        <div class="media-body">
            <span class="text-muted pull-right">
                <small class="text-muted">{{ $tenant->created_at->format('d/m/Y') }}</small>
            </span>
            <strong class="text-success">{{ $tenant->domain }}</strong>
            <p>
                {{ $tenant->name }}
                <br>
                <a href="{{ route('tenant.show', $tenant->domain) }}">Detalhes</a> |
                <a href="{{ route('tenant.edit', $tenant->domain) }}">Editar</a>
            </p>
        </div>
    </li>
    <hr>
    @empty
    <li class="media">
        <p>Nenhum um cliente cadastrado!</p>
    </li>
    @endforelse

    {!! $tenants->links() !!}
</ul>

@endsection