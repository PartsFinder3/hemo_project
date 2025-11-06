<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HospitalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HospitalProfileController extends Controller
{
    // CREATE
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'hospital') {
            return response()->json(['message' => 'Only hospitals can create a profile.'], 403);
        }

        if ($user->hospitalProfile) {
            return response()->json(['message' => 'Hospital profile already exists.'], 409);
        }

        $validator = Validator::make($request->all(), [
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = HospitalProfile::create([
            'user_id' => $user->id,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'website' => $request->website,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Hospital profile created successfully',
            'profile' => $profile,
        ], 201);
    }

    // READ (Show own profile)
    public function show(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'hospital') {
            return response()->json(['message' => 'Only hospitals can view this profile.'], 403);
        }

        $profile = $user->hospitalProfile;

        if (!$profile) {
            return response()->json(['message' => 'Hospital profile not found.'], 404);
        }

        return response()->json([
            'profile' => $profile,
        ], 200);
    }

    // UPDATE
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'hospital') {
            return response()->json(['message' => 'Only hospitals can update this profile.'], 403);
        }

        $profile = $user->hospitalProfile;

        if (!$profile) {
            return response()->json(['message' => 'Hospital profile not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update([
            'contact_email' => $request->contact_email ?? $profile->contact_email,
            'contact_phone' => $request->contact_phone ?? $profile->contact_phone,
            'website' => $request->website ?? $profile->website,
            'description' => $request->description ?? $profile->description,
        ]);

        return response()->json([
            'message' => 'Hospital profile updated successfully',
            'profile' => $profile->fresh(),
        ], 200);
    }

    // DELETE
    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'hospital') {
            return response()->json(['message' => 'Only hospitals can delete this profile.'], 403);
        }

        $profile = $user->hospitalProfile;

        if (!$profile) {
            return response()->json(['message' => 'Hospital profile not found.'], 404);
        }

        $profile->delete();

        return response()->json([
            'message' => 'Hospital profile deleted successfully',
        ], 200);
    }
}