<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Psy\Command\WhereamiCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/pzn', function () {
    return "Hello programmer Zaman Now";
});

Route::redirect('/youtube', '/pzn');

// Route::redirect('/', '/pzn');

Route::fallback(function () {
    return "404 Not Found";
});
Route::view('/hello', 'hello', ['name' => 'programmer zaman now']);


Route::get('/hello-again', function () {
    return view('hello', ['name' => 'programmer zaman now']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'programmer zaman now']);
});

Route::get('/products/{id}', function ($id) {
    return "Product {$id}";
})->name('product.detail');

Route::get('/products/{id}/items/{item}', function ($id, $item) {
    return "Product {$id}, Item {$item}";
})->name('product.item.detail');

Route::get('/categories/{id}', function ($id) {
    return "Category {$id}";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/user/{id?}', function ($id = '404') {
    return "User {$id}";
})->name('user.detail');

Route::get('/conflict/eko', function ($name) {
    return "Conflict eko kurniawan";
});

Route::get('/conflict/{nane}', function ($name) {
    return "Conflict {$name}";
});

Route::get('/produk/{id}', function ($id) {
    $link   = route('product.detail', ['id' => $id]);
    return "link $link";
})->name('produk.detail');

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
})->name('produk.redirect');

Route::get('/Controller/hello/request', [HelloController::class, 'request']);
Route::get('/Controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [HelloController::class, 'helo']);
Route::post('/input/hello', [HelloController::class, 'helo']);

Route::post('/input/hello/first', [HelloController::class, 'heloFirstName']);
Route::post('/input/hello/input', [HelloController::class, 'helloInput']);
Route::post('/input/hello/array', [HelloController::class, 'helloArray']);

Route::post('/input/type', [HelloController::class, 'helloType']);

Route::post('/input/filter/only', [HelloController::class, 'filterOnly']);
Route::post('/input/filter/except', [HelloController::class, 'fileterExcept']);

Route::post('/input/filter/merge', [HelloController::class, 'fileterMerge']);

Route::post('/file/upload', [FileController::class, 'upload']);

Route::get('/response/hello', [ResponseController::class, 'response']);

Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix("/response/type")->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);

Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');

Route::get('/redirect/named', function () {
    return URL::route('redirect-hello', ['name' => 'eko']);
});

Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::middleware(['contoh:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
    Route::get('/group', function () {
        return "GROUP";
    });
});

Route::get('/url/action', function () {
    return url()->action([FormController::class, 'form']);
});

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception("Sample error");
});
Route::get('/error/manual', function () {
    report(new Exception("Sample error"));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new ValidationException("Validation error");
});

Route::get('/error/404', function () {
    abort(404);
});
Route::get('/error/500', function () {
    abort(500);
});
Route::get('/error/403', function () {
    abort(403);
});
