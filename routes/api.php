<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;


/***********************
 * ROTAS DE USUÁRIOS
 **********************
 */

 Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $token = $user->createToken('app')->plainTextToken;

    return response()->json(['token' => $token]);
});


Route::prefix('users')->group(function () {

    Route::post('/', [UserController::class, 'store']);  
        Route::get('/', [UserController::class, 'index']);      
        Route::get('/{id}', [UserController::class, 'show']);    
        Route::put('/{id}', [UserController::class, 'update']);  
        Route::delete('/{id}', [UserController::class, 'destroy']); 
    });



/**
 * =========================
 * ROTAS DE ENDEREÇOS
 * =========================
 */

Route::prefix('addresses')->group(function () {
    Route::get('/', [AddressController::class, 'index']);    
    Route::post('/', [AddressController::class, 'store']);   
});


/**
 * =========================
 * ROTAS DE PERFIS E ENDEREÇOS
 * =========================
 */


Route::prefix('profiles')->group(function () {
    Route::get('/', [ProfileController::class, 'index']);    
    Route::post('/', [ProfileController::class, 'store']);   
    Route::delete('/{id}', [ProfileController::class, 'destroy']);  
});


