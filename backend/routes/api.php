<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('contacts')->controller(ContactController::class)->group(function () {
//     Route::get('/', 'contacts');
//     Route::get('/{id}', 'getContact');
//     Route::post('/', 'saveContact');
//     Route::delete('/{id}', 'deleteContact');
//     Route::post('/{id}', 'updateContact');
// });

Route::get('contacts', [App\Http\Controllers\ContactController::class, 'contacts']);
Route::get('get_contact/{id}', [App\Http\Controllers\ContactController::class, 'getContact']);
Route::post('save_contact', [App\Http\Controllers\ContactController::class, 'saveContact']);
Route::delete('delete_contact/{id}', [App\Http\Controllers\ContactController::class, 'deleteContact']);
Route::post('update_contact/{id}', [App\Http\Controllers\ContactController::class, 'updateContact']);
