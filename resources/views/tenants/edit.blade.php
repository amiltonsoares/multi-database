@extends('tenants.layouts.main')

@section('content')

<h1>Detalhes da empresa <b>{{ $tenant->name }}</b></h1>

<form action="{{ route('tenant.update', $tenant->id) }}" method="post">
    <input type="hidden" name="_method" value="PUT">

    @include('tenants._partials.form')
</form>

@endsection