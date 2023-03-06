<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubcategoriesController;
use App\Http\Controllers\Admin\Ready\ReadyServicesController;
use App\Http\Controllers\Admin\Ready\ReadyOrdersController;
use App\Http\Controllers\Admin\OrdersController;

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

Route::get('/add-new-row/{count_value}/{category_id}', [OrdersController::class, 'addNewRow']);
Route::get('/subcategories/{category_id}', [OrdersController::class, 'getSubcategories']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('Login', [\App\Http\Controllers\frontController::class, 'login']);
Route::get('forget-password', [\App\Http\Controllers\frontController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [\App\Http\Controllers\frontController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}/{email}', [\App\Http\Controllers\frontController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [\App\Http\Controllers\frontController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['admin']], function () {

    Route::get('Setting', [\App\Http\Controllers\frontController::class, 'Setting'])->name('profile');

    Route::get('/', function () {
        return view('Admin.index');
    })->name('dashboard.index');
    Route::get('logout', [\App\Http\Controllers\frontController::class, 'logout']);

    Route::get('Dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('Admin_setting', [AdminController::class, 'index'])->name('admins.index');
    Route::get('Admin_datatable', [AdminController::class, 'datatable'])->name('Admin.datatable.data');
    Route::get('delete-Admin', [AdminController::class, 'destroy']);
    Route::post('store-Admin', [AdminController::class, 'store']);
    Route::get('Admin-edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('update-Admin', [AdminController::class, 'update']);
    Route::get('/add-button-Admin', function () {
        return view('Admin/Admin/button');
    });



     Route::group(['prefix' => 'users', 'as' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('.index');
        Route::get('/datatable', [UserController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [UserController::class, 'create'])->name('.create');
        Route::post('/store', [UserController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('.update');
        Route::get('delete', [UserController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [UserController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [UserController::class, 'table_buttons'])->name('.table_buttons');
    });


    Route::group(['prefix' => 'cities', 'as' => 'cities'], function () {
        Route::get('/', [CitiesController::class, 'index'])->name('.index');
        Route::get('/datatable', [CitiesController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [CitiesController::class, 'create'])->name('.create');
        Route::post('/store', [CitiesController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [CitiesController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [CitiesController::class, 'update'])->name('.update');
        Route::get('delete', [CitiesController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [CitiesController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [CitiesController::class, 'table_buttons'])->name('.table_buttons');
    });

    //cars
    Route::group(['prefix' => 'cars', 'as' => 'cars'], function () {
        Route::get('/', [CarsController::class, 'index'])->name('.index');
        Route::get('/datatable', [CarsController::class, 'datatable'])->name('.datatable');
        Route::get('/create', [CarsController::class, 'create'])->name('.create');
        Route::post('/store', [CarsController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [CarsController::class, 'edit'])->name('.edit');
        Route::post('/update/{id}', [CarsController::class, 'update'])->name('.update');
        Route::get('delete', [CarsController::class, 'destroy'])->name('.delete');
        Route::post('/change_active', [CarsController::class, 'changeActive'])->name('.change_active');
        Route::get('/add-button', [CarsController::class, 'table_buttons'])->name('.table_buttons');
    });

        //categories
        Route::group(['prefix' => 'categories', 'as' => 'categories'], function () {
            Route::get('/', [CategoriesController::class, 'index'])->name('.index');
            Route::get('/datatable', [CategoriesController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [CategoriesController::class, 'create'])->name('.create');
            Route::post('/store', [CategoriesController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('.edit');
            Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('.update');
            Route::get('delete', [CategoriesController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [CategoriesController::class, 'changeActive'])->name('.change_active');
            Route::get('/add-button', [CategoriesController::class, 'table_buttons'])->name('.table_buttons');
        });

        //subcategories
        Route::group(['prefix' => 'subs', 'as' => 'subs'], function () {
            Route::get('/', [SubcategoriesController::class, 'index'])->name('.index');
            Route::get('/datatable', [SubcategoriesController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [SubcategoriesController::class, 'create'])->name('.create');
            Route::post('/store', [SubcategoriesController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [SubcategoriesController::class, 'edit'])->name('.edit');
            Route::post('/update/{id}', [SubcategoriesController::class, 'update'])->name('.update');
            Route::get('delete', [SubcategoriesController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [SubcategoriesController::class, 'changeActive'])->name('.change_active');
            Route::get('/add-button', [SubcategoriesController::class, 'table_buttons'])->name('.table_buttons');
        });

         //orders
         Route::group(['prefix' => 'orders', 'as' => 'orders'], function () {
            Route::get('/', [OrdersController::class, 'index'])->name('.index');
            Route::get('/datatable', [OrdersController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [OrdersController::class, 'create'])->name('.create');
            Route::post('/store', [OrdersController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('.edit');
            Route::post('/update/{id}', [OrdersController::class, 'update'])->name('.update');
            Route::get('delete', [OrdersController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [OrdersController::class, 'changeActive'])->name('.change_active');
            Route::get('/add-button', [OrdersController::class, 'table_buttons'])->name('.table_buttons');
            Route::get('filter', [OrdersController::class, 'filter'])->name('.filter');

        });

    Route::group(['prefix' => 'ready'], function () {
        Route::group(['prefix' => 'ready_services', 'as' => 'ready_services'], function () {
            Route::get('/', [ReadyServicesController::class, 'index'])->name('.index');
            Route::get('/datatable', [ReadyServicesController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [ReadyServicesController::class, 'create'])->name('.create');
            Route::post('/store', [ReadyServicesController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [ReadyServicesController::class, 'edit'])->name('.edit');
            Route::post('/update/{id}', [ReadyServicesController::class, 'update'])->name('.update');
            Route::get('delete', [ReadyServicesController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [ReadyServicesController::class, 'changeActive'])->name('.change_active');
            Route::post('/change_is_checked', [ReadyServicesController::class, 'changeIsChecked'])->name('.change_is_checked');
            Route::get('/add-button', [ReadyServicesController::class, 'table_buttons'])->name('.table_buttons');
        });
        Route::group(['prefix' => 'ready_orders', 'as' => 'ready_orders'], function () {
            Route::get('/', [ReadyOrdersController::class, 'index'])->name('.index');
            Route::get('/datatable', [ReadyOrdersController::class, 'datatable'])->name('.datatable');
            Route::get('/create', [ReadyOrdersController::class, 'create'])->name('.create');
            Route::post('/store', [ReadyOrdersController::class, 'store'])->name('.store');
            Route::get('/show/{id}', [ReadyOrdersController::class, 'show'])->name('.show');
            Route::post('/update/{id}', [ReadyOrdersController::class, 'update'])->name('.update');
            Route::get('delete', [ReadyOrdersController::class, 'destroy'])->name('.delete');
            Route::post('/change_active', [ReadyOrdersController::class, 'changeActive'])->name('.change_active');
            Route::post('/change_is_checked', [ReadyOrdersController::class, 'changeIsChecked'])->name('.change_is_checked');
            Route::get('/add-button', [ReadyOrdersController::class, 'table_buttons'])->name('.table_buttons');
        });
    });

});

Route::get('lang/{lang}', function ($lang) {

    if (session()->has('lang')) {
        session()->forget('lang');
    }
    if ($lang == 'en') {
        session()->put('lang', 'en');
    } else {
        session()->put('lang', 'ar');
    }


    return back();
});

Route::get('nearest', function () {
    $providers = \App\Models\Provider::active()
        ->online()
        ->select('providers.*', DB::raw('
                              6371 * ACOS(
                                  LEAST(
                                    1.0,
                                    COS(RADIANS(lat))
                                    * COS(RADIANS(' . '31.1' . '))
                                    * COS(RADIANS(lng - ' . '30.2' . '))
                                    + SIN(RADIANS(lat))
                                    * SIN(RADIANS(' . '31.1' . '))
                                  )
                                ) as distance'))
        ->having("distance", "<", 30)
        ->orderBy("distance", 'asc')
        ->get();
    return ($providers);

});


Route::get('/sendNotification', function () {
    dd(send(['eKEVjzBlSl6BYvWnmbkVRp:APA91bFvccfkGc9V6g-LjPnntgxAETiAI-OS-vjmdvsOoes5YBIKA1lhB1VQIRxlxw80q10EsBNTAP7B6KfGseA8sJB6JHU2_NidoFTeezg5c_OmS5UEdSdipUhDMt1HLqyd6pflZjTk']
        , 'test', 'test message', 'order', null, null));
    return 'notification sent';
});
