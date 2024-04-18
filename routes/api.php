<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // roters fssp module
    Route::get('/', [\App\Http\Controllers\Fssp\ReestrController::class, 'index']);
    Route::post('/reestr-import', [\App\Http\Controllers\Fssp\ReestrController::class, 'reestrImport']);
    Route::post('/reestr-add', [\App\Http\Controllers\Fssp\ReestrController::class, 'store']);
    Route::get('/reestr-export', [\App\Http\Controllers\Fssp\ReestrController::class, 'reestrExport']);
    Route::get('/reestr/delete', [\App\Http\Controllers\Fssp\ReestrController::class, 'delete']);
    Route::post('/search-reestrs', [\App\Http\Controllers\Fssp\ReestrController::class, 'searchReestrs']);
    Route::get('/reestr', [\App\Http\Controllers\Fssp\ReestrController::class, 'index']);
    Route::get('/search-the-reestr', [\App\Http\Controllers\Fssp\ReestrController::class, 'searchTheReestr']);
    Route::get('/download-file/{id}', [\App\Http\Controllers\Gospochta\FileController::class, 'download']);
    Route::post('/get-mail', [\App\Http\Controllers\Gospochta\GetMailController::class, 'getMail']);

    // router gospochta
    Route::get('/senders', [\App\Http\Controllers\Gospochta\SendersController::class, 'index']);
    Route::get('/sender/{id}', [\App\Http\Controllers\Gospochta\SendersController::class, 'show']);
    Route::get('/sender/{sender}/message/{message}', [\App\Http\Controllers\Gospochta\MessagesController::class, 'index']);
    Route::get('/sender/{sender}/message/{message}', [\App\Http\Controllers\Gospochta\MessagesController::class, 'index']);
    Route::post('/download-report-time', [\App\Http\Controllers\Gospochta\DownloadReportController::class, 'downloadReportTime']);
    Route::post('/download-report-doc', [\App\Http\Controllers\Gospochta\DownloadReportController::class, 'downloadReportDoc']);
    Route::get('/report-docs', [\App\Http\Controllers\Gospochta\ReportDocsController::class, 'getDocs']);

    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'getAllUsers']);
    Route::get('/user/{email}', [\App\Http\Controllers\Admin\UserController::class, 'getUser']);
    Route::get('/user/{messeges}', [\App\Http\Controllers\Admin\UserController::class, 'getUser']);
    Route::get('/get-balans', [\App\Http\Controllers\BalansController::class, 'getBalans']);
});

Route::get('/regions', [\App\Http\Controllers\RegionsController::class, 'getRegions']);

// roters fssp module
Route::get('/docs', [\App\Http\Controllers\Fssp\DocsController::class, 'getDocs']);
Route::get('/search-by-ip', [\App\Http\Controllers\Fssp\FsspController::class, 'searchByIp']);
Route::get('/search-by-inn', [\App\Http\Controllers\Fssp\FsspController::class, 'searchByInn']);
Route::get('/search-by-id', [\App\Http\Controllers\Fssp\FsspController::class, 'searchById']);
Route::get('/search-by-fl', [\App\Http\Controllers\Fssp\FsspController::class, 'searchByFl']);
Route::get('/search-by-ul', [\App\Http\Controllers\Fssp\FsspController::class, 'searchByUl']);
