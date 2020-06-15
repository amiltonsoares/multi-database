<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\TenantCreated;
use App\Events\Tenant\TenantDatabaseCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreUpdateTenantFormRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    private $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->tenant->latest()->paginate();
        return view('tenants.index', ['tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenantFormRequest $request)
    {
        $tenant = $this->tenant->create($request->all());

        if ($request->has('create_database'))
            event(new TenantCreated($tenant));
        else
            event(new TenantDatabaseCreated($tenant));

        return redirect()
            ->route('tenant.index')
            ->withSuccess('Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show($domain)
    {
        $tenant = $this->tenant->where('domain', $domain)->first();
        if (!$tenant)
            return redirect()->back();

        return view('tenants.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit($domain)
    {
        $tenant = $this->tenant->where('domain', $domain)->first();

        if (!$tenant)
            return redirect()->back();

        return view('tenants.edit', ['tenant' => $tenant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenantFormRequest $request, $id)
    {
        if (!$tenant = $this->tenant->find($id))
            return redirect()->back()->withInput();

        $tenant->update($request->all());

        return redirect()
            ->route('tenant.index')
            ->withSuccess('Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = $this->tenant->find($id))
            return redirect()->back();

        $tenant->delete();

        return redirect()
            ->route('tenant.index')
            ->withSuccess('Deletado com sucesso!');
    }
}
