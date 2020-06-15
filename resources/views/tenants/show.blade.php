@extends('tenants.layouts.main')

@section('content')

<h1>Detalhes da empresa <b>{{ $tenant->name }}</b></h1>

<ul>
    <li><strong>Nome:</strong> {{ $tenant->name }}</li>
    <li><strong>Domínio:</strong> {{ $tenant->domain }}</li>
    <li><strong>Database:</strong> {{ $tenant->db_database }}</li>
    <li><strong>Host:</strong> {{ $tenant->db_hostname }}</li>
    <li><strong>Usuário:</strong> {{ $tenant->db_username }}</li>
    <li><strong>Senha:</strong></li>
</ul>

<hr>

<form action="{{ route('tenant.destroy', $tenant->id) }}" method="post">
    @csrf

    <input type="hidden" name="_method" value="DELETE">

    <button type="submit" class="btn btn-danger">Deletar Empresa: {{ $tenant->name }}</button>
</form>


@endsection