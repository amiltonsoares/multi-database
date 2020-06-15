<?php

namespace App\Console\Commands\Tenant;

use App\Models\Tenant;
use App\Tenants\TenantManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrations {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations Tenants';

    protected $tenantManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TenantManager $tenantManager)
    {
        parent::__construct();
        $this->tenantManager = $tenantManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($id = $this->argument('id')) {
            $tenant = Tenant::find($id);
            if ($tenant) {
                $this->execCommand($tenant);
            } else {
                $this->info("ID {$id} not found!");
            }
            return;
        }

        $tenants = Tenant::all();
        foreach ($tenants as $tenant) {
            $this->execCommand($tenant);
        }
    }

    public function execCommand(Tenant $tenant)
    {
        $this->info("Connecting Tenant {$tenant->name}");
        $this->tenantManager->setConnection($tenant);
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';
        $run = Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenants',
        ]);
        if ($run === 0) {
            Artisan::call('db:seed', [
                '--class' => 'TenantUserSeeder',
            ]);
            $this->info("Success Tenant {$tenant->name}");
        }
        $this->info("End Connecting Tenant {$tenant->name}");
        $this->info('---------------------------------------');
    }
}
