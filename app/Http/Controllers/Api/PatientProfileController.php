<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PatientProfileController extends Controller
{
    /**
     * Create a new patient profile (for the authenticated user)
     */
    public function store(Request $request)
    {
        // Ensure only authenticated users can create
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $user = Auth::user();

        // Optional: Restrict to patient role only
        if ($user->role->role_name !== 'patient') {
            return response()->json(['message' => 'Only patients can create a profile.'], 403);
        }

        // Check if profile already exists
        if ($user->patientProfile) {
            return response()->json(['message' => 'Patient profile already exists.'], 409);
        }

        $validator = Validator::make($request->all(), [
            'disorder_type' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'hospitals_id' => 'nullable|exists:hospital_profiles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = PatientProfile::create([
            'user_id' => $user->id,
            'disorder_type' => $request->disorder_type,
            'severity' => $request->severity,
            'date_of_birth' => $request->date_of_birth,
            'medical_history' => $request->medical_history,
            'hospitals_id' => $request->hospitals_id,
        ]);

        return response()->json([
            'message' => 'Patient profile created successfully',
            'profile' => $profile->load('hospital'), // Optional: load hospital details if needed
        ], 201);
    }


    public function show(Request $request)
    {
        $user = Auth::user();

        // Optional: Restrict to patient role
        if ($user->role->role_name !== 'patient') {
            return response()->json(['message' => 'Only patients can view this profile.'], 403);
        }

        $profile = $user->patientProfile;

        if (!$profile) {
            return response()->json(['message' => 'Patient profile not found.'], 404);
        }

        return response()->json([
            'profile' => $profile->load('hospital'), // Loads hospital details if linked
        ], 200);
    }

    /**
     * Update the authenticated user's patient profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'patient') {
            return response()->json(['message' => 'Only patients can update this profile.'], 403);
        }

        $profile = $user->patientProfile;

        if (!$profile) {
            return response()->json(['message' => 'Patient profile not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'disorder_type' => 'nullable|string|max:255',
            'severity' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'hospitals_id' => 'nullable|exists:hospital_profiles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update([
            'disorder_type' => $request->disorder_type ?? $profile->disorder_type,
            'severity' => $request->severity ?? $profile->severity,
            'date_of_birth' => $request->date_of_birth ?? $profile->date_of_birth,
            'medical_history' => $request->medical_history ?? $profile->medical_history,
            'hospitals_id' => $request->hospitals_id ?? $profile->hospitals_id,
        ]);

        return response()->json([
            'message' => 'Patient profile updated successfully',
            'profile' => $profile->fresh()->load('hospital'),
        ], 200);
    }

    /**
     * Delete the authenticated user's patient profile
     */
    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'patient') {
            return response()->json(['message' => 'Only patients can delete this profile.'], 403);
        }

        $profile = $user->patientProfile;

        if (!$profile) {
            return response()->json(['message' => 'Patient profile not found.'], 404);
        }

        $profile->delete();

        return response()->json([
            'message' => 'Patient profile deleted successfully',
        ], 200);
    }
}