<?php

namespace App\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TenantManager
{
    public function setConnection(Tenant $tenant)
    {
        DB::purge('tenant');

        config()->set('database.connections.tenant.host', $tenant->db_hostname);
        config()->set('database.connections.tenant.database', $tenant->db_database);
        config()->set('database.connections.tenant.username', $tenant->db_username);
        config()->set('database.connections.tenant.password', $tenant->db_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

    public function createDatabase(Tenant $tenant)
    {
        return DB::statement("
            CREATE DATABASE {$tenant->db_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ");
    }

    public function isMainDomain()
    {
        return (request()->getHost() == config('tenant.main_domain'));
    }
}
