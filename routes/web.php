<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LocationController;
use App\Models\Car;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('cars', CarController::class);
Route::resource('location', LocationController::class);

Route::get('location-create/{id}', function ($id) {
    $car = Car::find($id);
    return view('locations.create', ['car' => $car]);
})->name('louer');

Route::get('list-locations', function () {
    Gate::allowIf(auth()->user());
    $locations = Location::with('car')->where('user_id', auth()->user()->id)->paginate(10);
    return view('locations.show', compact('locations'));
})->name('list-locations');

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('users', function () {
    Gate::allowIf(auth()->user());
    $users = User::paginate(10);
    return view('userlist', compact('users'));
})->name('users');

Route::get('listlocate/{id}', function ($id) {
    Gate::allowIf(auth()->user() && auth()->user()->role == 1);
    $user = User::with('location')->find($id);
    return view('locatelist', ['user' => $user]);
})->name('listlocate');

Route::get('userslocate', function(){
    Gate::allowIf(auth()->user() && auth()->user()->role == 1);
    $users = User::has('location')->paginate(10);
    return view('userlocate', compact('users'));
})->name('userslocate');

Route::get('giverole/{id}', function($id){
    Gate::allowIf(auth()->user());
    $user = User::findOrFail($id);

    if($user->role == 0)
    {
        $user->role = 1;
        $user->update();
    }
    else
    {
        $user->role = 0;
        $user->update();
    }

    return redirect()->back();
})->name('role');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
