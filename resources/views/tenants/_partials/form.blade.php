@include('tenants.includes.alerts')

@csrf

<div class="form-group">
    <input value="{{ $tenant->name ?? old('name') }}" class="form-control" type="text" name="name" placeholder="Nome:">
</div>
<div class="form-group">
    <input value="{{ $tenant->domain ?? old('domain') }}" class="form-control" type="text" name="domain"
        placeholder="Domínio:">
</div>
<div class="form-group">
    <input value="{{ $tenant->db_database ?? old('db_database') }}" class="form-control" type="text" name="db_database"
        placeholder="Database:">
</div>
<div class="form-group">
    <input value="{{ $tenant->db_hostname ?? old('db_hostname') }}" class="form-control" type="text" name="db_hostname"
        placeholder="Host:">
</div>
<div class="form-group">
    <input value="{{ $tenant->db_username ?? old('db_username') }}" class="form-control" type="text" name="db_username"
        placeholder="Usuário:">
</div>
<div class="form-group">
    <input value="{{ $tenant->db_password ?? old('db_password') }}" class="form-control" type="password"
        name="db_password" placeholder="Senha:">
</div>

@if (!isset($tenant))
<div class="form-group">
    <label for="create_database">
        <input type="checkbox" name="create_database" checked>
        Criar banco de dados?
    </label>
</div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>