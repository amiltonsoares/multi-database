@extends('tenants.layouts.main')

@section('content')

<h1>Cadastrar nova empresa</h1>

<form action="{{ route('tenant.store') }}" method="post">
    @include('tenants._partials.form')
</form>

@endsection