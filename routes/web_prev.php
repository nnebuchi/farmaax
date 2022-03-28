<?php

use App\LandForSale;
use App\MailingList;
use App\Popup;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//Authentication routes
Route::get('/', function () {

    $setCookie = setGuestCookie();
    $data['userIsSubscribed'] = MailingList::where('user_cookie', $setCookie)->first();
    $data['farms'] = DB::select("SELECT * FROM categories WHERE parent>0");
    $data['popup'] = Popup::where('status', 1)->latest()->first();


    /*if (Auth::check()) {
       return redirect('dashboard');
    }*/
    return view('welcome')->with($data);
});

Route::post('subscribe-to-mailings', 'PopupsController@subscribe')->name('registerToMailists');
Route::get('genref', 'GenericController@generateRef');
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes(['verify' => true]);



// Route::post('register', 'UserController@register')->name('userregister');

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



    // Routes for admin popups
    Route::get('pop-ups/delete/{id}',  'PopupsController@destroy')->name('delete-popup');
    Route::get('pop-ups/toggle/{id}',  'PopupsController@toggleStatus')->name('togglePopupStatus');
    Route::resource('pop-us', 'PopUpsController');


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
    Route::post('store-cost-analysis/{id}', 'AdminController@storecostAnalysis')->name('storeCostAnalysis');
    Route::post('update-analysis/{id}', 'AdminController@updatecostAnalysis')->name('updateCostAnalysis');

    Route::get('upload-store-product', 'AdminController@addProduct')->name('add-product');
    Route::post('upload-product', 'AdminController@storeProduct')->name('store-product.store');
    Route::get('edit-product/{id}', 'AdminController@editProduct')->name('edit-product');
    Route::post('update-product/{id}', 'AdminController@updateProduct')->name('update-product');
    Route::get('settings', 'AdminController@settings')->name('settings');
    Route::post('addSettings', 'AdminController@updateSettings')->name('add-settings');

    Route::get('addmilestone/{farmId}', 'AdminController@addMilestone')->name('add-milestone');
    Route::post('storemilestone/{farmId}', 'AdminController@storeMilestone')->name('store-milestone');
    Route::get('editmilestone/{Id}', 'AdminController@editMilestone')->name('edit-milestone');
    Route::post('updatemilestone/{Id}', 'AdminController@updateMilestone')->name('update-milestone');
    Route::get('deletemilestone/{Id}', 'AdminController@deleteMilestone')->name('delete-milestone');
});
//End of Admin routes


// Authenticated Users Routes
Route::group(['middleware' => ['auth']], function () {
    //route for upgrading users account
    Route::get('upgrade-account', 'UsersController@upgrade')->name('upgrade');
    //post for users to pay for account upgrades
    Route::post('account_upgrade_action', 'UsersController@accountUpgradeAction')->name('account_upgrade_action');
    Route::get('consultant_reg_fee', 'PaymentController@consultantRegFee');
    Route::post('pay-for-upgrades', 'PaymentController@upgradeAccount')->name('upgrade.account.payment');
    Route::post('update-account', 'UsersController@storeBankAccountDetails')->name('storeBankAccountDetails');
    Route::get('verify-account-upgrade-payment', 'PaymentController@verifyUpgradeAccountPayment')->name('verify.upgrade.account.payment');

    Route::get('enterprofile', 'UsersController@enterFarManagementProfile');
    Route::get('fund-wallet', 'UsersController@showFundingWalletView')->name('fundWallet');
    Route::post('initialize-wallet-funding', 'PaymentController@initializeWalletFunding')->name('initializeWalletFunding');
    Route::get('verify-wallet-funding', 'PaymentController@verifyWalletFunding')->name('verifyWalletFunding');
    Route::get('pay-for-upgrades', 'UsersController@upgradeAccount')->name('upgrade.account.payment');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('lands', 'Controller@land');
    Route::get('farmaax/upload-a-farm', 'FarmsController@create')->name('uploadFarm');
    Route::resource('realtors', 'RealtorsController');
    Route::get('land/pay/{id}', 'PaymentController@land')->name('landPayment');
    Route::post('landcartpayment/{id}', 'PaymentController@landCartPay');
    Route::get('verify/land-purchase', 'PaymentController@verifyLandPayment')->name('verifyLandPayment');
    Route::post('makeinvestment', 'PaymentController@makeInvestment')->name('makeinvestment');
    Route::post('makeinvestment/{id}', 'PaymentController@makeInvestment')->name('makeinvestment');
    Route::get('farmcart', 'UsersController@getFarmCart')->name('farmcart');
    Route::get('/remove/cart-item/{id}', 'UsersController@removeFromCart')->name('removeFromCart');
    Route::get('/add-land-to-cart/{id}', 'UsersController@addLandToCart')->name('addLandToCart');
    Route::get('/my-lands', 'UsersController@myLands')->name('myLands');
    Route::get('/start-farm', 'FarmsController@farmSetup')->name('farmSetup');
    Route::post('/overall-farm-cost', 'FarmsController@showFarmCost')->name('showFarmCost');
    Route::post('/confirm/start-farm', 'FarmsController@confirmFarmSetup')->name('confirmFarmSetup');
    Route::post('/checkout', 'FarmsController@finalizeFarmSetUp')->name('finalizeFarmSetup');
    Route::get('/pay-for-farm-setup', 'PaymentController@farmSetUpCheckout')->name('farmSetUpCheckout');
    Route::get('/remove-items', function () {
        Session::forget('farmDetails');
        Session::forget('takeToFarmLandCheckout');
        Session::forget('lastDetails');
        return redirect(route('home'));
    })->name('remove-items');
    Route::get('/verifying-farm-setup-payment', 'PaymentController@verifyfarmSetUpCheckout')->name('verifyfarmSetUpPayment');
    Route::get('/pay-for-farm', 'PaymentController@payForFarmFirst')->name('payForFarmFirst');
    Route::get('/verifying-farm-payment', 'PaymentController@verifyPayForFarmFirst')->name('verifyPayForFarmFirst');
    Route::get('confirm-farm-setup-payment',  'FarmsController@showCheckoutFormAfterLandPurchase')->name('continueToCheckOut');
    //route to show lands a user uploaded
    Route::get('/mylands-for-sale', 'UsersController@showMyLandsForSale')->name('myLandsForSale');

    Route::get('/edit-land/{id}', 'LandsController@editLandForSale')->name('edit-land');
    Route::post('/update-land/{id}', 'LandsController@updateLandForSale')->name('update-land');
    Route::get('/delete-land/{id}', 'LandsController@deleteLandForSale')->name('delete-land');
    Route::get('/myfarminvestments', 'UsersController@farmsInvestedIn')->name('farmsInvestedIn');
    Route::post('/check_land_availability', 'FarmsController@checkLandAvailability');
    Route::get('/finalize-setup', 'FarmsController@finalizeFarmSetup')->name('finalizesetup');
    Route::get('/myfarmcart', 'FarmsController@myFarmCart')->name('myfarmcart');

    Route::post('farmsetup-pay', 'PaymentController@initializeFarmSetupPayment');
    Route::get('verify_farmsetup_payment', 'PaymentController@verifyFarmSetUpPayment');
    Route::get('transactions', 'UsersController@myTransactions')->name('mytransactions');
    Route::get('myfarms', 'UsersController@myFarmSetups')->name('myfarmsetups');
    Route::get('mydownlines', 'UsersController@myDownlines')->name('mydownlines');
    Route::get('myearnings', 'UsersController@myEarnings')->name('myearnings');
    Route::post('farmcart-delete/{id}', 'FarmsController@deleteCartfarm')->name('delete-cart-farm');
    Route::post('landcart-delete/{id}', 'LandsController@deleteCartLand')->name('delete-cart-land');
    Route::get('landcart', 'LandsController@landCart')->name('landcart');

    Route::get('store/checkout', 'StoreController@checkout')->name('checkout');
});



//Resourceful Routes
Route::resource('lands', 'LandsController');
Route::resource('farms', 'FarmsController');
Route::view('/about-farmaax', 'site-pages/about')->name('about');

Route::get('about/{pagename}', 'PagesController@pages');
Route::post('pickstates', 'GenericController@getStates');
Route::post('picklgas', 'GenericController@getLgas');
Route::post('picktowns', 'GenericController@getTowns');
// Route::post('/pickstates', 'UserController@getStates');
// Route::post('/picklgas', 'UserController@getLgas');
// Route::post('/picktowns', 'UserController@getTowns');

Route::post('confirminvestment', 'UsersController@confirmInvestment');

Route::post('lgas', 'FarmsController@showLgas');
Route::get('farm-managers', 'FarmsController@assignFarmManager');








// Store Routes

Route::group(['prefix' => 'store'], function () {

    Route::get('/', 'StoreController@index')->name('store');
    Route::get('product/{slug}', 'StoreController@productDetail')->name('product-detail');
    Route::post('add-to-cart', 'StoreController@addCart')->name('add-to-cart');
    Route::get('/viewcart', 'StoreController@viewCart')->name('viewcart');
    Route::get('increase-cart-qty', 'StoreController@increaseCartQty')->name('increase-cart-qty');
    Route::post('add-address', 'StoreController@addAddress')->name('add-address');
    Route::post('remove-from-cart', 'StoreController@removeFromCart')->name('remove-from-cart');
    Route::post('setorderdata', 'StoreController@setOrderData')->name('setorderdata');
    Route::get('confirm-order', 'StoreController@confirmOrder')->name('confirm-order');
    Route::get('payment/debitcard', 'PaymentController@initializeStoreOrderPayment')->name('store.pay.debitcard');
    Route::get('verify_store_payment', 'PaymentController@verifyStoreOrderPayment')->name('verify-store-payment');
    Route::get('payment-success/{ref}', 'StoreController@paymentSuccess')->name('store-payment-success');
    Route::get('receipt/{ref}', 'StoreController@orderReceipt')->name('order-receipt');

    // Route::post('edit-address', 'StoreController@editAddress')->name('edit-address');

});
