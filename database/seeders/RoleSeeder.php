<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // here we make the rows in user_role table where we have 
        // two fields role name and patient and we enter the data of that here
        $roles = [
            ['role_name' => 'patient', 'status' => true],
            ['role_name' => 'doctor', 'status' => true],
            ['role_name' => 'hospital', 'status' => true],
            ['role_name' => 'ngo', 'status' => true],
            ['role_name' => 'admin', 'status' => true],
        ];

        // by using foreach we store the data in userrole table
        foreach ($roles as $role) {
            UserRole::create($role);
        }
    }
}