@extends('adminlte::auth.login')

@if(env('APP_DEMO',false))
<div class="row mb-2">
    <div class="col-12 callout callout-danger">
        <h6 class="text-bold">Demonstração</h6>
        <p><small>Email: demo@inovesistemas.com.br<br />Senha: 123</small></p>
    </div>
</div>
@endif
