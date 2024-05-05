<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoListController;
use App\Http\Controllers\StreamerListController;
use App\Http\Controllers\LiveListController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\DailyRankVideo;
use Illuminate\Support\Facades\DB;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


Route::get('/', [HomeController::class, 'index']);

Route::get('/liveList', [LiveListController::class, 'getLiveList']);

// TEST, 아프리카 동적생성페이지 크롤링불가로 보류.
// Route::get('/getAfricaVodList', function () {
//     $vrd = new VideoListController;
//     $vrd->getAfricaVodList();
// })->name('getAfricaVodList');

