<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = \App\Models\Tenant::first();

        $tenant->users()->create([
            'name' => 'luis',
            'email' => 'ljarillo@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
