<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HospitalProfile;
use App\Models\DoctorProfile;
use App\Models\NgoProfile;
use App\Models\PatientProfile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // here we get data from User table and store in variable
        $hospitalUser = User::where('email', 'mayo@hospital.com')->first();
        $doctorUser = User::where('email', 'ahmed@doctor.com')->first();
        $ngoUser = User::where('email', 'contact@ngo.org')->first();
        $patients = User::where('role_id', User::where('email', 'patient1@hemo.com')->first()->role_id)->take(6)->get();

        // here we use the above fetch data and create a row in all ours remaining tables
        // 1. Hospital Profile
        HospitalProfile::create([
            'user_id' => $hospitalUser->id,
            'contact_email' => 'info@mayo.pk',
            'contact_phone' => '0421111111',
            'website' => 'https://mayo.pk',
            'description' => 'Leading blood disorder treatment center in Lahore.',
        ]);

        // 2. Doctor Profile
        DoctorProfile::create([
            'user_id' => $doctorUser->id,
            'date_of_birth' => '1980-05-15',
            'specialization' => 'Hematology',
            'qualifications' => 'MBBS, FCPS',
            'experience_years' => 15,
            'hospital_id' => $hospitalUser->hospitalProfile->id,
            'license_number' => 'MD-98765',
        ]);

        // 3. NGO Profile
        NgoProfile::create([
            'user_id' => $ngoUser->id,
            'registration_no' => 'NGO-2020-001',
            'contact_email' => 'help@ngo.org',
            'description' => 'Support for thalassemia patients across Pakistan.',
        ]);

        // 4. Patient Profiles
        $severities = ['mild', 'moderate', 'severe'];
        foreach ($patients as $index => $patient) {
            PatientProfile::create([
                'user_id' => $patient->id,
                'disorder_type' => 'Thalassemia Major',
                'severity' => $severities[array_rand($severities)],
                'date_of_birth' => now()->subYears(18 + $index)->format('Y-m-d'),
                'medical_history' => "Regular transfusions since age 2.",
                'hospitals_id' => $hospitalUser->hospitalProfile->id,
            ]);
        }
    }
}