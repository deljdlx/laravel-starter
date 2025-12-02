<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(): JsonResponse
    {
        $users = User::with('roles')->get();

        return response()->json([
            'users' => $users,
            'count' => $users->count(),
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user->load('roles'),
        ], 201);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'user' => $user->load('roles'),
        ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'message' => 'Utilisateur modifié avec succès',
            'user' => $user->load('roles'),
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès',
        ]);
    }
}
