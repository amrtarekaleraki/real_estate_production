<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\RedirectIfAuthenticated;

/////////////////// admin ////////////////////
use App\Http\Controllers\Admin\AdminController;
/////////////////// Subscriber ////////////////////
use App\Http\Controllers\Subscriber\SubscriberController;
use App\Http\Controllers\Subscriber\SubscriberOwnerController;
use App\Http\Controllers\Subscriber\SubscriberBuildingController;
use App\Http\Controllers\Subscriber\SubscriberReportsController;


/////////////////// Backend ////////////////////
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OwnerController;
use App\Http\Controllers\Backend\BuildingController;
use App\Http\Controllers\Backend\ReportsController;
use App\Http\Controllers\Backend\RoleController;

//////////////// Home //////////////////////////////////////
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::middleware(RedirectIfAuthenticated::class)->get('/', function () {
    return view('auth.login');
});

Route::redirect('/register', '/');







////////////// Admin Routes /////////////////////
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/switcher',[AdminController::class,'AdminSwitcher'])->name('admin.switcher');
    Route::get('/fetch-buildings/{categoryId}', [AdminController::class, 'fetchBuildingsByCategory'])->name('fetch.buildings.by.category');
    Route::get('/admin/logout',[AdminController::class,'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});


////////////// Subscriber Routes /////////////////////
Route::middleware(['auth','role:subscriber'])->group(function(){
    Route::get('/subscriber/dashboard',[SubscriberController::class,'SubscriberDashboard'])->name('subscriber.dashboard');
    Route::get('/subscriber/switcher',[SubscriberController::class,'SubscriberSwitcher'])->name('subscriber.switcher');
    Route::get('/subscriber/fetch-buildings/{categoryId}', [SubscriberController::class, 'fetchBuildingsByCategory'])->name('subscriber.fetch.buildings.by.category');
    Route::get('/subscriber/logout',[SubscriberController::class,'SubscriberDestroy'])->name('subscriber.logout');
    Route::get('/subscriber/profile',[SubscriberController::class,'SubscriberProfile'])->name('subscriber.profile');
    Route::post('/subscriber/profile/store',[SubscriberController::class,'SubscriberProfileStore'])->name('subscriber.profile.store');
    Route::get('/subscriber/change/password',[SubscriberController::class,'SubscriberChangePassword'])->name('subscriber.change.password');
    Route::post('/subscriber/update/password', [SubscriberController::class, 'SubscriberUpdatePassword'])->name('subscriber.update.password');
});




//////////admin login //////
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);



/////////subscriber login //////
Route::get('/subscriber/login', [SubscriberController::class, 'SubscriberLogin'])->name('subscriber.login')->middleware(RedirectIfAuthenticated::class);


//////////inactive page //////
Route::get('/inactive/page', [AdminController::class, 'InActivePage'])->name('inactive-page');

Route::get('/inactive/subscriber', [AdminController::class, 'InActiveSubscriber'])->name('inactive-subscriber');




/////// start Admin middleware ////////////////////////////////////
Route::middleware(['auth','role:admin'])->group(function () {


    //////////////// Add Category /////////////////////////
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');

    });


    ////////////////Admin Add Subscribers /////////////////////////
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/all-subscriber',[AdminController::class,'AllSubscriber'])->name('admin.all.subscriber');
        Route::get('/admin/add-subscriber',[AdminController::class,'AddSubscriber'])->name('admin.add.subscriber');
        Route::post('/admin/store-subscriber',[AdminController::class,'StoreSubscriber'])->name('admin.store.subscriber');
        Route::get('/edit/subscriber/{id}','EditSubscriber')->name('admin.edit.subscriber');
        Route::post('/update/subscriber','UpdateSubscriber')->name('admin.update.subscriber');
        Route::get('/delete/subscriber/{id}','DeleteSubscriber')->name('admin.delete.subscriber');
        Route::get('/subscriber/inactive/{id}','SubscriberInactive')->name('subscriber.inactive');
        Route::get('/subscriber/active/{id}','SubscriberActive')->name('subscriber.active');
    });


    ////////////////Admin Add Owner /////////////////////////
    Route::controller(OwnerController::class)->group(function(){
        Route::get('/admin/all-owner','AllOwner')->name('admin.all.owner');
        Route::get('/admin/all-tenant','AllTenant')->name('admin.all.tenant');
        Route::get('/admin/all-only-owner','AllOnlyOwner')->name('admin.all.only.owners');
        Route::get('/admin/add-owner','AddOwner')->name('admin.add.owner');
        Route::post('/admin/store-owner','StoreOwner')->name('admin.store.owner');
        Route::get('/edit/owner/{id}','EditOwner')->name('admin.edit.owner');
        Route::post('/update/owner','UpdateOwner')->name('admin.update.owner');
        Route::get('/delete/owner/{id}','DeleteOwner')->name('admin.delete.owner');
        Route::get('/owner/inactive/{id}','OwnerInactive')->name('admin.owner.inactive');
        Route::get('/owner/active/{id}','OwnerActive')->name('admin.owner.active');
    });


    ///////// Building All Route ///////////////////////////
    Route::controller(BuildingController::class)->group(function(){
        Route::get('/all/building' , 'AllBuilding')->name('all.building');
        Route::get('/all/building/sort/{id}' , 'SortByCategory')->name('all.sort');
        Route::get('/building/sort/rent' , 'SortByRent')->name('sort.rent');
        Route::get('/building/sort/buy' , 'SortByBuy')->name('sort.buy');
        Route::get('/add/building' , 'AddBuilding')->name('add.building');
        Route::post('/store/building' , 'StoreBuilding')->name('store.building');
        Route::get('/show/building/{id}' , 'ShowBuilding')->name('show.building');
        Route::get('/edit/building/{id}' , 'EditBuilding')->name('edit.building');
        Route::post('/update/building' , 'UpdateBuilding')->name('update.building');
        Route::post('/update/building/multiimage' , 'UpdateBuildingMultiimage')->name('update.building.multiimage');
        Route::get('/building/multiimg/delete/{id}' , 'MulitImageDelelte')->name('building.multiimg.delete');
        Route::post('/update/building/multivideo' , 'UpdateBuildingMultiVideo')->name('update.building.multivideo');
        Route::get('/building/multivideo/delete/{id}' , 'MultiVideoDelelte')->name('building.multivideo.delete');
        Route::get('/building/history/delete/{id}' , 'HistoryDelelte')->name('building.history.delete');
        Route::get('/delete/building/{id}' , 'BuildingDelete')->name('delete.building');
    });




    ///////// permisions All Route ///////////////////////////
    Route::controller(RoleController::class)->group(function(){

        Route::get('/all/roles' , 'AllRoles')->name('all.roles');
        Route::get('/add/roles' , 'AddRoles')->name('add.roles');
        Route::post('/store/roles' , 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}' , 'EditRoles')->name('edit.roles');
        Route::post('/update/roles' , 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}' , 'DeleteRoles')->name('delete.roles');

        Route::get('/all/permisions' , 'AllPermission')->name('all.permisions');
        Route::get('/add/permission' , 'AddPermission')->name('add.permission');
        Route::post('/store/permission' , 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}' , 'EditPermission')->name('edit.permission');
        Route::post('/update/permission' , 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');


        // add role permission
        Route::get('/add/roles/permission' , 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission' , 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}' , 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}' , 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}' , 'AdminRolesDelete')->name('admin.delete.roles');

    });


    // Add Admin All Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/admin' , 'AllAdmin')->name('all.admin');
        Route::get('/add/admin' , 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store' , 'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/role/{id}' , 'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/user/update/{id}' , 'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/role/{id}' , 'DeleteAdminRole')->name('delete.admin.role');
        Route::get('/admin/inactive/{id}','AdminInactive')->name('admin.inactive');
        Route::get('/admin/active/{id}','AdminActive')->name('admin.active');
    });


    //  Settings All Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/settings' , 'AllSettings')->name('all.settings');
        Route::get('/edit/settings/{id}' , 'EditSettings')->name('edit.settings');
        Route::post('/update/settings' , 'SettingsUpdate')->name('settings.update');
        Route::post('/notification/read', 'markAsRead')->name('notification.read');
        Route::post('/notification/read-all', 'markAllAsRead')->name('notification.read.all');

        Route::post('/notification/switcher/read', 'markswitcherAsRead')->name('notification.switcher.read');
        Route::post('/notification/switcher/read-all', 'markswitcherAllAsRead')->name('notification.switcher.read.all');
    });


    ////////////////pdf /////////////////////////
    Route::controller(AdminController::class)->group(function(){
        Route::get('export/building/pdf', 'viewPdf')->name('export.building.pdf');
        Route::get('export/subscribers/pdf', 'subscribersPdf')->name('export.subscribers.pdf');

        Route::get('export/building/excel', 'viewExcel')->name('export.building.excel');

    });


    //////////////// reports  /////////////////////////
    Route::controller(ReportsController::class)->group(function(){
        Route::get('admin/all/reports', 'AllReport')->name('all.report');
    });





});














//////////////////////////////////////////////////// subscriber /////////////////////////////////////////////////////////////////////////////////////////

/////// start subscriber middleware ////////////////////////////////////
Route::middleware(['auth','role:subscriber'])->group(function () {


    ////////////////subscriber Add Owner /////////////////////////
    Route::controller(SubscriberOwnerController::class)->group(function(){
        Route::get('/subscriber/all-owner','AllOwner')->name('subscriber.all.owner');
        Route::get('/subscriber/all-tenant','AllTenant')->name('subscriber.all.tenant');
        Route::get('/subscriber/only-owner','OnlyOwner')->name('subscriber.only.owner');
        Route::get('/subscriber/add-owner','AddOwner')->name('subscriber.add.owner');
        Route::post('/subscriber/store-owner','StoreOwner')->name('subscriber.store.owner');
        Route::get('/subscriber/edit/owner/{id}','EditOwner')->name('subscriber.edit.owner');
        Route::post('/subscriber/update/owner','UpdateOwner')->name('subscriber.update.owner');
        Route::get('/subscriber/delete/owner/{id}','DeleteOwner')->name('subscriber.delete.owner');
        Route::get('/subscriber/owner/inactive/{id}','OwnerInactive')->name('subscriber.owner.inactive');
        Route::get('/subscriber/owner/active/{id}','OwnerActive')->name('subscriber.owner.active');
    });



        ///////// Building All Route ///////////////////////////
        Route::controller(SubscriberBuildingController::class)->group(function(){
            Route::get('/subscriber/all/building' , 'AllBuilding')->name('subscriber.all.building');
            Route::get('/subscriber/all/building/sort/{id}' , 'SortByCategory')->name('subscriber.all.sort');
            Route::get('/subscriber/building/sort/rent' , 'SortByRent')->name('subscriber.sort.rent');
            Route::get('/subscriber/building/sort/buy' , 'SortByBuy')->name('subscriber.sort.buy');
            Route::get('/subscriber/add/building' , 'AddBuilding')->name('subscriber.add.building');
            Route::post('/subscriber/store/building' , 'StoreBuilding')->name('subscriber.store.building');
            Route::get('/subscriber/show/building/{id}' , 'ShowBuilding')->name('subscriber.show.building');
            Route::get('/subscriber/edit/building/{id}' , 'EditBuilding')->name('subscriber.edit.building');
            Route::post('/subscriber/update/building' , 'UpdateBuilding')->name('subscriber.update.building');
            Route::post('/subscriber/update/building/multiimage' , 'UpdateBuildingMultiimage')->name('subscriber.update.building.multiimage');
            Route::get('/subscriber/building/multiimg/delete/{id}' , 'MulitImageDelelte')->name('subscriber.building.multiimg.delete');
            Route::post('/subscriber/update/building/multivideo' , 'UpdateBuildingMultiVideo')->name('subscriber.update.building.multivideo');
            Route::get('/subscriber/building/multivideo/delete/{id}' , 'MultiVideoDelelte')->name('subscriber.building.multivideo.delete');
            Route::get('/subscriber/building/history/delete/{id}' , 'HistoryDelelte')->name('subscriber.building.history.delete');
            Route::get('/subscriber/delete/building/{id}' , 'BuildingDelete')->name('subscriber.delete.building');
        });


        ////////////////pdf /////////////////////////
        Route::controller(SubscriberController::class)->group(function(){
            Route::get('export/subscribers/building/pdf', 'subscriberBuildingsPdf')->name('export.subscribers.building.pdf');
            Route::get('export/subscribers/owners/pdf', 'subscriberOwnerPdf')->name('export.subscribers.owners.pdf');

            Route::get('export/subscribers/building/excel', 'viewExcel')->name('export.subscribers.building.excel');

        });


        //////////////// subscriber reports  /////////////////////////
        Route::controller(SubscriberReportsController::class)->group(function(){
            Route::get('subscriber/all/reports', 'AllReport')->name('subscriber.all.report');
        });


        ///////  Settings All Route
        Route::controller(SubscriberController::class)->group(function(){
            Route::get('subscriber/all/settings' , 'AllSettings')->name('subscriber.all.settings');
            Route::get('subscriber/add/settings' , 'AddSettings')->name('subscriber.add.settings');
            Route::post('subscriber/store/settings' , 'StoreSettings')->name('subscriber.store.settings');
            Route::get('subscriber/edit/settings/{id}' , 'EditSettings')->name('subscriber.edit.settings');
            Route::post('subscriber/update/settings' , 'SettingsUpdate')->name('subscriber.settings.update');
        });



});




















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

require __DIR__.'/auth.php';
