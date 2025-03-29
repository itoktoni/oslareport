<?php

use App\Http\Controllers\Core\GroupsController;
use App\Http\Controllers\Core\UserController;
use App\Http\Controllers\Core\WebhookController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::post('login', [UserController::class, 'postLoginApi'])->name('postLoginApi');
Route::post('deploy', [WebhookController::class, 'deploy'])->name('deploy');

Route::middleware(['auth:sanctum'])->group(function () {});

Route::get('groups', [GroupsController::class, 'getData']);