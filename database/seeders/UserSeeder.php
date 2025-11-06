<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // here we get the data form modal by using where and first funciton
        $patientRole = UserRole::where('role_name', 'patient')->first();
        $doctorRole = UserRole::where('role_name', 'doctor')->first();
        $hospitalRole = UserRole::where('role_name', 'hospital')->first();
        $ngoRole = UserRole::where('role_name', 'ngo')->first();
        $adminRole = UserRole::where('role_name', 'admin')->first();

        // here we create a user in user table
        // 1. Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@hemo.com',
            'password' => bcrypt('admin123'),
            'phone' => '03001234567',
            'role_id' => $adminRole->id,
            'country' => 'Pakistan',
            'city' => 'Lahore',
            'is_verified' => true,
            'status' => true,
        ]);

        // 2. Hospital
        $hospitalUser = User::create([
            'name' => 'Mayo Hospital',
            'email' => 'mayo@hospital.com',
            'password' => bcrypt('hospital123'),
            'phone' => '0421111111',
            'role_id' => $hospitalRole->id,
            'country' => 'Pakistan',
            'city' => 'Lahore',
            'is_verified' => true,
            'status' => true,
        ]);

        // 3. Doctor
        $doctorUser = User::create([
            'name' => 'Dr. Ahmed Khan',
            'email' => 'ahmed@doctor.com',
            'password' => bcrypt('doctor123'),
            'phone' => '03331234567',
            'role_id' => $doctorRole->id,
            'gender' => 'male',
            'is_verified' => true,
            'status' => true,
        ]);

        // 4. NGO
        $ngoUser = User::create([
            'name' => 'Thalassemia Foundation',
            'email' => 'contact@ngo.org',
            'password' => bcrypt('ngo123'),
            'phone' => '02134567890',
            'role_id' => $ngoRole->id,
            'is_verified' => true,
            'status' => true,
        ]);

        // here we add user data byusing for loop instead of writing multiples times as we do above
        // 5. Patients
        for ($i = 1; $i <= 6; $i++) {
            User::create([
                'name' => "Patient $i",
                'email' => "patient$i@hemo.com",
                'password' => bcrypt('patient123'),
                'phone' => "0300" . rand(1000000, 9999999),
                'role_id' => $patientRole->id,
                'gender' => $i % 2 == 0 ? 'female' : 'male',
                'is_verified' => true,
                'status' => true,
            ]);
        }
    }
}