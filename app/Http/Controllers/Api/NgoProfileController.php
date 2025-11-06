<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NgoProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NgoProfileController extends Controller
{
    // CREATE
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'ngo') {
            return response()->json(['message' => 'Only NGOs can create a profile.'], 403);
        }

        if ($user->ngoProfile) {
            return response()->json(['message' => 'NGO profile already exists.'], 409);
        }

        $validator = Validator::make($request->all(), [
            'registration_no' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = NgoProfile::create([
            'user_id' => $user->id,
            'registration_no' => $request->registration_no,
            'contact_email' => $request->contact_email,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'NGO profile created successfully',
            'profile' => $profile,
        ], 201);
    }

    // READ (Show own profile)
    public function show(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'ngo') {
            return response()->json(['message' => 'Only NGOs can view this profile.'], 403);
        }

        $profile = $user->ngoProfile;

        if (!$profile) {
            return response()->json(['message' => 'NGO profile not found.'], 404);
        }

        return response()->json([
            'profile' => $profile,
        ], 200);
    }

    // UPDATE
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'ngo') {
            return response()->json(['message' => 'Only NGOs can update this profile.'], 403);
        }

        $profile = $user->ngoProfile;

        if (!$profile) {
            return response()->json(['message' => 'NGO profile not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'registration_no' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile->update([
            'registration_no' => $request->registration_no ?? $profile->registration_no,
            'contact_email' => $request->contact_email ?? $profile->contact_email,
            'description' => $request->description ?? $profile->description,
        ]);

        return response()->json([
            'message' => 'NGO profile updated successfully',
            'profile' => $profile->fresh(),
        ], 200);
    }

    // DELETE
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'ngo') {
            return response()->json(['message' => 'Only NGOs can delete this profile.'], 403);
        }

        $profile = $user->ngoProfile;

        if (!$profile) {
            return response()->json(['message' => 'NGO profile not found.'], 404);
        }

        $profile->delete();

        return response()->json([
            'message' => 'NGO profile deleted successfully',
        ], 200);
    }
}