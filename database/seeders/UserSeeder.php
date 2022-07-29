<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
           [
            'id' => '1' ,  
            'name' => 'Administrador Root',
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('admin1234'),
            'nivel' => 1,
           ])->assignRole('Administrador General');

    }
}
