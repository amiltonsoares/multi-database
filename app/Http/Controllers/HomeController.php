<?php

namespace App\Http\Controllers;

use App\Tenants\TenantManager;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $tenantManager = app(TenantManager::class);

        if ($tenantManager->isMainDomain())
            return redirect()->route('tenant.index');
        else
            return view('home');
    }
}
