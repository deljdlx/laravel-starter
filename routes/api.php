<?php
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('/about', function () {
        return response()->json(['
            app' => 'Laravel Starter API',
            'version' => '1.0.0',
            'description' => 'API de démarrage Laravel avec authentification Sanctum',
        ]);
    });

    // ===================================================================================

    Route::post('/register', function (Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Données de validation invalides', 'errors' => $e->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
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
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Données de connexion invalides', 'errors' => $e->errors()], 422);
        }


        $user = User::where('email', $request->email)->first();

        if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        // check if api token already exists for this user, if so delete it
        $user->tokens()->delete();
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
    ->group(function () {
        Route::get('/me', function (Request $request) {
            return $request->user();
        })->name('me');
    });

});


