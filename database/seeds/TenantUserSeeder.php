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
            'password'  => bcrypt('12345678'),
        ]);
    }
}
