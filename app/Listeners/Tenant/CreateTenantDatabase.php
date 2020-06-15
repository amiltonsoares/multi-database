<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantCreated;
use App\Events\Tenant\TenantDatabaseCreated;
use App\Tenants\TenantManager;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateTenantDatabase
{

    protected $tenantManager;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    /**
     * Handle the event.
     *
     * @param  TenantCreated  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        $tenant = $event->tenant();

        if (!$this->tenantManager->createDatabase($tenant)){
            throw new Exception('Error create database');
        }

        // run migrations
        event(new TenantDatabaseCreated($tenant));
    }
}
