<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    /**
     * Display a listing of roles (Admin only)
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $roles = UserRole::all();

        return response()->json([
            'roles' => $roles
        ], 200);
    }

    /**
     * Store a new role (Admin only)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|unique:user_roles,role_name|max:50',
            'status' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = UserRole::create([
            'role_name' => $request->role_name,
            'status' => $request->status ?? true,
            'created_by' => $user->id,
        ]);

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role
        ], 201);
    }

    /**
     * Display a single role (Admin only)
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $role = UserRole::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        return response()->json([
            'role' => $role
        ], 200);
    }

    /**
     * Update a role (Admin only)
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $role = UserRole::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'role_name' => 'sometimes|string|unique:user_roles,role_name,' . $id . '|max:50',
            'status' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role->update([
            'role_name' => $request->role_name ?? $role->role_name,
            'status' => $request->filled('status') ? $request->status : $role->status,
            'updated_by' => $user->id,
        ]);

        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role->fresh()
        ], 200);
    }

    /**
     * Delete a role (Admin only) - Soft delete if in use?
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role->role_name !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        $role = UserRole::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        // Optional: Prevent delete if users exist
        if ($role->users()->count() > 0) {
            return response()->json(['message' => 'Cannot delete role. Users are assigned to it.'], 409);
        }

        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ], 200);
    }
}