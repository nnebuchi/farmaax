<?php

use App\LandForSale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


//Authentication routes
Route::get('/', function () {
    $data['farms'] = DB::table('farms')
        ->join('categories', "farms.farm_type", "=", "categories.id")
        // ->join('categories', "farms.farm_category","=","categories.id")
        ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage')
        ->get();
    return view('welcome')->with($data);
});
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});
Auth::routes(['verify' => true]);


//Admin Routes
Route::group(['prefix' => 'dashboard/admin', 'middleware' => 'admin'], function () {


    // Farm actegory routes
    Route::post('storecategory', 'FarmsController@storecategory')->name('store.category');
    Route::get('addcategory', 'FarmsController@addcategory')->name('addcategory');
    Route::get('editcategory/{id}', 'FarmsController@editcategory');
    Route::post('updatecategory/{id}', 'FarmsController@updatecategory')->name('update.category');


    // Farm Type Routes
    Route::post('storefarmtype', 'FarmsController@storefarmtype')->name('store.farmtype');
    Route::get('addfarmtype', 'FarmsController@addfarmtype')->name('addfarmtype');
    Route::get('editfarmtype/{id}', 'FarmsController@editfarmtype');
    Route::post('updatefarmtype/{id}', 'FarmsController@updatefarmtype')->name('update.category');


    //add farm routes
    Route::post('fetchfarmtype/{category_id}', 'FarmsController@fetchFarmType');


    Route::get('/', 'HomeController@index')->name('admin');
    Route::get('users', 'AdminController@users')->name('users');
    Route::get('users/{user}', 'AdminController@findUser')->name('users.show');
    Route::get('lawyers', 'AdminController@lawyers')->name('lawyers');
    Route::get('realtors', 'AdminController@realtors')->name('realtors');
    Route::get('marketers', 'AdminController@marketers')->name('marketers');
    Route::get('farm-managers', 'AdminController@farmManagers')->name('farmManagers');
    Route::get('farms', 'AdminController@farms')->name('farms');
    Route::get('farms/awaiting-approval', 'AdminController@farmsAwaitingApproval')->name('farms.awaiting.approval');
    Route::get('farms/awaiting-approval/{id}', 'AdminController@showFarmsAwaitingApproval')->name('farms.awaiting.approval.show');
    Route::get('farms/assign-farm-to-a-manager/{id}', 'AdminController@assignFarm')->name('assignFarm');
    Route::get('farms/farm-manager/{id}', 'AdminController@showFarmManaged')->name('showFarmManaged');
    Route::get('farms/make-user-a-manager/{user}/{farm}', 'AdminController@makeUserAFarmManager')->name('makeUserAFarmManager');
    Route::get('farms/awaiting-approval/approve/{id}', 'AdminController@approveFarmsAwaitingApproval')->name('farms.awaiting.approval.approve');
    Route::get('lands', 'AdminController@lands')->name('lands');
    Route::get('sell-a-land', 'AdminController@sellLands')->name('sellLands');
    Route::get('sold-lands', 'AdminController@soldLands')->name('soldLands');
    Route::get('available-lands', 'AdminController@availableLands')->name('availableLands');

    Route::get('cost-analysis/{id}', 'AdminController@showCostAnalysisForm')->name('costAnalysis');
    Route::post('cost-analysis', 'AdminController@storecostAnalysis')->name('storeCostAnalysis');
});
//End of Admin routes



// Authenticated Users Routes
Route::group(['middleware' => ['auth']], function () {
    //route for upgrading users account
    Route::get('upgrade-account', 'UsersController@upgrade')->name('upgrade');
    //post for users to pay for account upgrades
    Route::post('pay-for-upgrades', 'PaymentController@upgradeAccount')->name('upgrade.account.payment');
    Route::post('update-account', 'UsersController@storeBankAccountDetails')->name('storeBankAccountDetails');
    Route::get('verify-account-upgrade-payment', 'PaymentController@verifyUpgradeAccountPayment')->name('verify.upgrade.account.payment');
    Route::get('fund-wallet', 'UsersController@showFundingWalletView')->name('fundWallet');
    Route::post('initialize-wallet-funding', 'PaymentController@initializeWalletFunding')->name('initializeWalletFunding');
    Route::get('verify-wallet-funding', 'PaymentController@verifyWalletFunding')->name('verifyWalletFunding');
    Route::get('pay-for-upgrades', 'UsersController@upgradeAccount')->name('upgrade.account.payment');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('lands', 'Controller@land');
    Route::get('farmaax/upload-a-farm', 'FarmsController@create')->name('uploadFarm');
    Route::resource('realtors', 'RealtorsController');
    Route::get('land/pay/{id}', 'PaymentController@land')->name('landPayment');
    Route::get('verify/land-purchase', 'PaymentController@verifyLandPayment')->name('verifyLandPayment');
    Route::post('makeinvestment', 'UsersController@makeInvestment')->name('makeinvestment');
    Route::post('makeinvestment/{id}', 'UsersController@makeInvestment')->name('makeinvestment');
    Route::get('farmcart', 'UsersController@getFarmCart')->name('farmcart');
    Route::get('/remove/cart-item/{id}', 'UsersController@removeFromCart')->name('removeFromCart');
    Route::get('/add-land-to-cart/{id}', 'UsersController@addLandToCart')->name('addLandToCart');
    Route::get('/my-lands', 'UsersController@myLands')->name('myLands');
    Route::get('/start-farm', 'FarmsController@farmSetup')->name('farmSetup');
    Route::post('/confirm/start-farm', 'FarmsController@confirmFarmSetup')->name('confirmFarmSetup');
    //route to show lands a user uploaded
    Route::get('/mylands/for-sale', 'UsersController@showMyLandsForSale')->name('myLandsForSale');
    Route::get('/farms/invested-in', 'UsersController@farmsInvestedIn')->name('farmsInvestedIn');
});


//Resourceful Routes
Route::resource('lands', 'LandsController');
Route::resource('farms', 'FarmsController');
Route::view('/about-farmaax', 'site-pages/about')->name('about');

Route::get('about/{pagename}', 'PagesController@pages');
Route::post('pickstates', 'GenericController@getStates');
Route::post('picklgas', 'GenericController@getLgas');
Route::post('picktowns', 'GenericController@getTowns');
Route::post('/pickstates', 'UserController@getStates');
Route::post('/picklgas', 'UserController@getLgas');
Route::post('/picktowns', 'UserController@getTowns');

Route::post('confirminvestment', 'UsersController@confirmInvestment');
