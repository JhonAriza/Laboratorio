<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // administrador
        Role::create([
            'name' => 'Admin_room_911'
        ]);

        // usuario
        Role::create([
            'name' => 'room_911'
        ]);
    }
}
