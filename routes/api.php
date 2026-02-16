<?php

use App\Domain\Administration\Http\Controllers\UserController;
use App\Domain\Identity\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function (): void {
    Route::get('/about', function () {
        return response()->json([
            'app' => 'Laravel Starter API',
            'version' => '1.0.0',
            'description' => 'API de démarrage Laravel avec authentification Sanctum',
        ]);
    });

    // ===================================================================================

    Route::post('/register', function (Request $request) {
        try {
            $validated = $request::validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Données de validation invalides', 'errors' => $e->errors()], 422);
        }

        /** @var string $password */
        $password = $request->input('password');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user,
            'token' => $token,
        ], 201);
    });

    Route::post('/login', function (Request $request) {

        try {
            $validated = $request::validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Données de connexion invalides', 'errors' => $e->errors()], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        /** @var string $password */
        $password = $request->input('password');

        if ($user === null || ! \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        // check if api token already exists for this user, if so delete it
        $user->tokens()->toBase()->delete();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    });

    // ===================================================================================

    Route::prefix('protected')
        ->name('protected.')
        ->middleware(['auth:sanctum'])
        ->group(function (): void {
            Route::get('/me', function (Request $request) {
                return $request->user();
            })->name('me');
        });

    // ===================================================================================

    // Users API Routes
    Route::prefix('users')->name('users.')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/search', [UserController::class, 'search'])->name('search');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});
