<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\CategoryApiController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('categories', CategoryApiController::class);

Route::post('/login', function() {
    $validator = validator(request()->all(), [
        "email" => "required",
        "password" => "required",
    ]);

    if($validator->fails()) {
        return response($validator->errors()->all(), 400);
    }

    $user = User::where("email", request()->email)->first();
    if($user) {
        if(password_verify(request()->password, $user->password)) {
            return $user->createToken("browser")->plainTextToken;
        }
    }

    return response(["msg" => "Incorrect email or password"], 401);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
