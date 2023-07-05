<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\AdminHomeController;
use App\Http\Controllers\Backend\QuanLySachController;
use App\Http\Controllers\Backend\QLSVController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\QLMTController;
use App\Http\Controllers\Backend\ThongKeController;

use App\Http\Controllers\Fontend\HomeController;
use App\Http\Controllers\Fontend\SearchController;
use App\Http\Controllers\Fontend\BookController;
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
// BACKEND
Route::prefix('admin')->middleware(['auth', 'verifyAdmin'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'home']);
    Route::prefix('ql-sach')->group(function () {
        Route::get('/', [QuanLySachController::class, 'danhsach']);
        Route::get('/danhsach', [QuanLySachController::class, 'index'])->name('sach.index');
        Route::get('/chitietsach/{id}', [QuanLySachController::class, 'detail'])->name('sach.detail');
        Route::get('/them', [QuanLySachController::class, 'create'])->name('sach.create');
        Route::get('/delete', [QuanLySachController::class, 'deleteMulti'])->name('sach.deleteMulti');
        Route::post('/delete_act', [QuanLySachController::class, 'deleteMulti_act'])->name('sach.deleteMulti_act');
        Route::post('/them', [QuanLySachController::class, 'store'])->name('sach.store');
        Route::post('/search', [QuanLySachController::class, 'store'])->name('sach.search');
        Route::get('/{id}/edit', [QuanLySachController::class, 'edit'])->name('sach.edit');
        Route::patch('/{id}', [QuanLySachController::class, 'update'])->name('sach.update');
        Route::delete('/{id}', [QuanLySachController::class, 'delete'])->name('sach.delete');
        Route::get('/restore/{id?}', [QuanLySachController::class, 'restore'])->name('sach.restore');
        Route::post('/restore', [QuanLySachController::class, 'restore_multi'])->name('sach.restore_multi');
        Route::delete('/destroy/{id?}', [QuanLySachController::class, 'destroy'])->name('sach.destroy');
        Route::post('/destroy', [QuanLySachController::class, 'destroy_multi'])->name('sach.destroy_multi');
    });
    Route::prefix('ql-sv')->group(function () {
        Route::get('/', [QLSVController::class, 'danhsach']);
        Route::get('/danhsach', [QLSVController::class, 'index'])->name('sv.index');
        Route::get('/chitietsv/{id}', [QLSVController::class, 'detail'])->name('sv.detail');
        Route::get('/them', [QLSVController::class, 'create'])->name('sv.create');
        Route::post('/them', [QLSVController::class, 'store'])->name('sv.store');
        Route::get('/{id}/edit', [QLSVController::class, 'edit'])->name('sv.edit');
        Route::patch('/{id}', [QLSVController::class, 'update'])->name('sv.update');
        Route::delete('/{id}', [QLSVController::class, 'delete'])->name('sv.delete');
        Route::get('/delete', [QLSVController::class, 'deleteMulti'])->name('sv.deleteMulti');
        Route::post('/delete_act', [QLSVController::class, 'deleteMulti_act'])->name('sv.deleteMulti_act');
        Route::get('/restore/{id?}', [QLSVController::class, 'restore'])->name('sv.restore');
        Route::get('/restore', [QLSVController::class, 'restore_multi'])->name('sv.restore_multi');
        Route::get('/destroy/{id?}', [QLSVController::class, 'destroy'])->name('sv.destroy');
        Route::get('/destroy', [QLSVController::class, 'destroy_multi'])->name('sv.destroy_multi');
        Route::post('/import', [QLSVController::class, 'import'])->name('sv.import');
    });
    Route::name('mt.')->prefix('ql-mt')->group(function () {
        Route::get('/ds-dk-online', [QLMTController::class, 'listLendBookOnline'])->name('list_online');
        Route::get('/lended/{id?}', [QLMTController::class, 'lended'])->name('lended');
        Route::get('/muon-sach', [QLMTController::class, 'lend_book'])->name('lend_book');
        Route::post('/muon-sach', [QLMTController::class, 'lend_book'])->name('lending_book');
        Route::get('/returned/{id?}', [QLMTController::class, 'returned'])->name('returned');
        Route::get('/renewal/{id?}', [QLMTController::class, 'renewal'])->name('renewal');
        Route::post('/renewal/{id?}', [QLMTController::class, 'renewal']);
        Route::get('/vi-pham/{id?}', [QLMTController::class, 'violate'])->name('violate');
        Route::post('/vi-pham/{id?}', [QLMTController::class, 'violate']);
        Route::get('/ds-muon', [QLMTController::class, 'list_lending'])->name('list_lending');
        Route::get('/ds-qua-han-va-vi-pham', [QLMTController::class, 'list_outofdate'])->name('list_outofdate');
        Route::get('/tra-sach', [QLMTController::class, 'return_book'])->name('return_book');
        Route::post('/tra-sach', [QLMTController::class, 'return_book']);
        Route::get('/giai-quyet/{id?}', [QLMTController::class, 'solved'])->name('solved');
        Route::get('/da-mat/{id?}', [QLMTController::class, 'losed'])->name('losed');
        Route::get('/hoan-sach/{id?}', [QLMTController::class, 'refunded'])->name('refunded');
        Route::get('/export-qua-han-va-vi-pham', [QLMTController::class, 'exportOutOfDate'])->name('exportOutOfDate');
        Route::get('/sua-thong-tin', [QLMTController::class, 'update'])->name('update');
        Route::post('/sua-thong-tin', [QLMTController::class, 'update'])->name('update');
    });
    Route::prefix('permission')->group(function () {
        //role
        Route::get('/role', [PermissionController::class, 'role'])->name('permission.role');
        Route::post('/role', [PermissionController::class, 'createRole'])->name('permission.create_role');
        Route::get('/role-update/{id?}', [PermissionController::class, 'formUpdateRole'])->name('permission.form_update_role');
        Route::post('/role-update', [PermissionController::class, 'updateRole'])->name('permission.update_role');
        Route::get('/role-update-permissions/{name?}', [PermissionController::class, 'roleUpdatePermissions'])->name('permission.role_update_permissions');
        Route::post('/role-update-permissions', [PermissionController::class, 'roleUpdatePermissionsPost'])->name('permission.role_update_permissions_post');
        Route::get('/role/{id?}', [PermissionController::class, 'deleteRole'])->name('permission.delete_role');
        // permissions
        Route::get('/permissions', [PermissionController::class, 'permissions'])->name('permission.permissions');
        Route::post('/permissions', [PermissionController::class, 'createPermissions'])->name('permission.create_permissions');
        Route::get('/permissions-update/{id?}', [PermissionController::class, 'formUpdatePermissions'])->name('permission.form_update_permissions');
        Route::post('/permissions-update', [PermissionController::class, 'updatePermissions'])->name('permission.update_permissions');
        Route::get('/permissions-update-permissions/{name?}', [PermissionController::class, 'permissionsUpdateRole'])->name('permission.permissions_update_role');
        Route::post('/permissions-update-permissions', [PermissionController::class, 'permissionsUpdateRolePost'])->name('permission.permissions_update_role_post');
        Route::get('/permissions/{id?}', [PermissionController::class, 'deletePermissions'])->name('permission.delete_permissions');

        Route::get('/supply-role-and-permissions', [PermissionController::class, 'supply_role_and_permissions'])->name('permission.supply_role_and_permissions');
        Route::get('/supply-role/{id?}', [PermissionController::class, 'supply_role'])->name('permission.supply_role');
        Route::post('/supply-role', [PermissionController::class, 'supply_role_post'])->name('permission.supply_role_post');
        Route::get('/supply-permissions/{id?}', [PermissionController::class, 'supply_permissions'])->name('permission.supply_permissions');
        Route::post('/supply-permissions', [PermissionController::class, 'supply_permissions_post'])->name('permission.supply_permissions_post');
    });
    Route::name('thongke.')->prefix('thong-ke')->group(function () {
        Route::get('/', [ThongKeController::class, 'index'])->name('index');
        Route::get('/ket-qua-bieu-do', [ThongKeController::class, 'result']);
        Route::get('/ket-qua-table', [ThongKeController::class, 'result']);
    });
});

// USER
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/change-password', [UserController::class, 'change_password'])->name('change_password')->middleware('auth');

// FONTEND
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/sach-de-cu', [HomeController::class, 'recommend'])->name('recommend');

// FONTEND-SEARCH
Route::name('search.')->prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'searchName'])->name('ten');
    Route::get('/tracuu', [SearchController::class, 'search'])->name('tracuu');
    // Route::post('/tracuu', [SearchController::class, 'search']);
    Route::get('/nganh/{id?}', [SearchController::class, 'searchMajors'])->name('nganh');
    Route::get('/danhmuc/{id?}', [SearchController::class, 'searchCategory'])->name('danhmuc');
});

Route::name('book.')->prefix('book')->group(function () {
    Route::get('/detail/{id?}/{comment?}', [BookController::class, 'detail'])->name('detail');
    Route::get('/save/{id?}', [BookController::class, 'save'])->name('save');
    Route::get('/unsave/{id?}', [BookController::class, 'unsave'])->name('unsave');
    Route::get('/saving', [BookController::class, 'saving'])->name('saving');
    Route::get('/list-save', [BookController::class, 'listSave'])->name('listSave');
    Route::get('/register-lend-book/{id?}', [BookController::class, 'registerLend'])->name('registerLend');
    Route::get('/unregister-lend-book/{id?}', [BookController::class, 'unregisterLend'])->name('unregisterLend');
    Route::post('/lend-book', [BookController::class, 'lend'])->name('lend');
    Route::get('/list-lend-book', [BookController::class, 'listLendBook'])->name('listLendBook');
    Route::get('/lending-book', [BookController::class, 'lending'])->name('lending');
    Route::post('/comment/{id}', [BookController::class, 'comment'])->name('comment');
    Route::post('/comment-update/{id}-{idcm}', [BookController::class, 'commentUpdate'])->name('commentUpdate');
    Route::get('/comment-delete/{id}-{idcm}', [BookController::class, 'commentDelete'])->name('commentDelete');
});

//  làm chức sang book saving
