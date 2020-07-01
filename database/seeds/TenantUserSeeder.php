<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Suporte',
            'email'     => 'suporte@inovesistemas.com.br',
            'password'  => bcrypt('123'),
        ]);
        if (env('APP_DEMO', false)) {
            User::create([
                'name'      => 'Demonstração',
                'email'     => 'demo@inovesistemas.com.br',
                'password'  => bcrypt('123'),
            ]);
            $this->call(ContactSeeder::class);
        }
    }
}
