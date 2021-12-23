<?php

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
// Route::get('/', function () {
//     return view('auth/login');
// });

use App\Http\Controllers\FormController;
use App\Http\Controllers\InternMemberController;
use App\Http\Controllers\SubmitDocumentController;
use FontLib\Table\Type\name;

Route::get('/', ['middleware' => 'guest', function () {
    return view('auth/login');
}]);

Auth::routes();


//เเบบฟอร์มหน้าสมัครฝึกงาน
Route::get('register', [FormController::class, 'index']);
Route::post('register/store', [FormController::class, 'store'])->name('register.save');



//หน้าผู้ดูเเลระบบ
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'home'], function () {
        Route::resource('dashboard', 'HomeController');
    });

    Route::group(['prefix' => 'manage'], function () {
        Route::resource('internship', 'InternMemberController');

        Route::get('viewIntern/{id}', 'InternMemberController@view');

        Route::get('viewUploadFileIntern/{id}', 'InternMemberController@viewUploadFile');
        Route::post('UploadFileIntern/store', [SubmitDocumentController::class, 'store'])->name('UploadFileIntern.save');


        Route::get('internship/resume/{id}', 'InternMemberController@resume');

        Route::get('approved', [InternMemberController::class, 'approved'])->name('allApproved');
        Route::get('intern_success', [InternMemberController::class, 'internSuccess'])->name('internSuccessfull');



        Route::resource('customer', 'CustomersController');
        Route::get('editCus/{id}', 'CustomersController@editCus');
        Route::get('delCus/{id}', 'CustomersController@delCus');
    });
});
