<?php

use App\Http\Controllers\MailTestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;

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
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/admin', function () {
    // Lógica para los usuarios con rol admin
})->middleware('checkRole:admin');


Route::resource('payments', PaymentController::class);

/*Rutas de middleware*/
Route::middleware('role:admin')->group(function () {
    Route::resource('pagos', PaymentController::class);
});


// Redirigir a la página de inicio
Route::get('/', function () {
    return redirect()->route('home'); // Redirige a la página de inicio con los botones
});

// Rutas de servicios y pagos
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::post('/payments', [PaymentController::class, 'store'])->middleware('auth')->name('payments.store');


// Ruta para el dashboard (solo accesible si el usuario está autenticado)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');
Route::middleware('role:admin')->group(function () {
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware('role:admin')->group(function () {
    Route::resource('pagos', PaymentController::class);
});


// Rutas de perfil (solo para usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::middleware(['auth'])->group(function () {
    // Crear un pago
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    

    Route::get('/dashboard', [PaymentController::class, 'index'])->name('dashboard');


    // Mostrar pagos (índice)
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');

    // Editar un pago
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    
    // Eliminar un pago
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::middleware('role:admin')->delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/send-test-email', [MailTestController::class, 'sendTestEmail']);

});

});

// Requiere las rutas de autenticación de Laravel
require __DIR__.'/auth.php';
