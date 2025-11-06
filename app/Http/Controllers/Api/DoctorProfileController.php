<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    /**
     * Create a new doctor profile
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'doctor') {
            return response()->json(['message' => 'Only doctors can create a profile.'], 403);
        }

        if ($user->doctorProfile) {
            return response()->json(['message' => 'Doctor profile already exists.'], 409);
        }

        $validator = Validator::make($request->all(), [
            'date_of_birth' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'hospital_id' => 'nullable|exists:hospital_profiles,id',
            'license_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = DoctorProfile::create([
            'user_id' => $user->id,
            'date_of_birth' => $request->date_of_birth,
            'specialization' => $request->specialization,
            'qualifications' => $request->qualifications,
            'experience_years' => $request->experience_years,
            'hospital_id' => $request->hospital_id,
            'license_number' => $request->license_number,
        ]);

        return response()->json([
            'message' => 'Doctor profile created successfully',
            'profile' => $profile->load('hospital'),
        ], 201);
    }

    /**
     * Show own doctor profile
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'doctor') {
            return response()->json(['message' => 'Only doctors can view this profile.'], 403);
        }

        $profile = $user->doctorProfile;

        if (!$profile) {
            return response()->json(['message' => 'Doctor profile not found.'], 404);
        }

        return response()->json([
            'profile' => $profile->load('hospital'),
        ], 200);
    }

    /**
     * Update own doctor profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'doctor') {
            return response()->json(['message' => 'Only doctors can update this profile.'], 403);
        }

        $profile = $user->doctorProfile;

        if (!$profile) {
            return response()->json(['message' => 'Doctor profile not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'date_of_birth' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'hospital_id' => 'nullable|exists:hospital_profiles,id',
            'license_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update([
            'date_of_birth' => $request->date_of_birth ?? $profile->date_of_birth,
            'specialization' => $request->specialization ?? $profile->specialization,
            'qualifications' => $request->qualifications ?? $profile->qualifications,
            'experience_years' => $request->experience_years ?? $profile->experience_years,
            'hospital_id' => $request->hospital_id ?? $profile->hospital_id,
            'license_number' => $request->license_number ?? $profile->license_number,
        ]);

        return response()->json([
            'message' => 'Doctor profile updated successfully',
            'profile' => $profile->fresh()->load('hospital'),
        ], 200);
    }

    /**
     * Delete own doctor profile
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'doctor') {
            return response()->json(['message' => 'Only doctors can delete this profile.'], 403);
        }

        $profile = $user->doctorProfile;

        if (!$profile) {
            return response()->json(['message' => 'Doctor profile not found.'], 404);
        }

        $profile->delete();

        return response()->json([
            'message' => 'Doctor profile deleted successfully',
        ], 200);
    }
}