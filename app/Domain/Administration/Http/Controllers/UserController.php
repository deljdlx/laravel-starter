<?php

namespace App\Domain\Administration\Http\Controllers;

use App\Domain\Administration\Http\Requests\StoreUserRequest;
use App\Domain\Administration\Http\Requests\UpdateUserRequest;
use App\Domain\Identity\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users with pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->integer('per_page', 10);
        $perPage = min(max($perPage, 1), 100); // Between 1 and 100

        $users = User::with('roles')->paginate($perPage);

        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ],
        ]);
    }

    /**
     * Search users by name or email.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->string('q', '')->toString();
        $perPage = $request->integer('per_page', 10);
        $perPage = min(max($perPage, 1), 100); // Between 1 and 100

        $users = User::with('roles')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->paginate($perPage);

        return response()->json([
            'users' => $users->items(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ],
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        /** @var string $password */
        $password = $request->password;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        if ($request->has('roles')) {
            /** @var array<string> $roles */
            $roles = $request->roles;
            $user->syncRoles($roles);
        }

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user->load('roles'),
        ], 201);
    }

    /**
     * Display the specified user view.
     */
    public function showView(User $user): View
    {
        $user->load('roles', 'permissions');

        return view('users.show', compact('user'));
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
            /** @var string $password */
            $password = $request->password;
            $data['password'] = Hash::make($password);
        }

        $user->update($data);

        if ($request->has('roles')) {
            /** @var array<string> $roles */
            $roles = $request->roles;
            $user->syncRoles($roles);
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
