<?php

use Illuminate\Support\Facades\Route;

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

/*
 * Admin Links
 */
    Route::get('/', [App\Http\Controllers\IndexPageController::class, 'indexPage'])->name('home');
    Route::get('/signup', [App\Http\Controllers\Admin\UsersController::class, 'signupPackage'])->name('signup');
    Route::get('/packagedetails/{package_id}', [App\Http\Controllers\Admin\UsersController::class, 'packagedetails'])->name('packagedetails');
    Route::post('/personaldetail', [App\Http\Controllers\Admin\UsersController::class, 'personaldetail'])->name('personaldetail');
    Route::get('/personaldetail', [App\Http\Controllers\Admin\UsersController::class, 'personaldetail'])->name('personaldetail');
    Route::post('/storepersonaldetail', [App\Http\Controllers\Admin\UsersController::class, 'storepersonaldetail']);
    Route::post('/storesubscriberdetail', [App\Http\Controllers\Admin\UsersController::class, 'storesubscriberdetail']);
    Route::post('/storepersonaldetailinsession', [App\Http\Controllers\Admin\UsersController::class, 'storepersonaldetailinsession']);
    Route::post('/contect-us-form', [App\Http\Controllers\ContectUsController::class, 'contectUsForm']);

    Route::get('/signup-plan-invoice', [App\Http\Controllers\Admin\UsersController::class, 'signupPlanInvoice']);
    Route::post('/store-transaction', [App\Http\Controllers\Admin\UsersController::class, 'storeTransaction']);
    Route::post('/store-child-users', [App\Http\Controllers\Admin\UsersController::class, 'storeChildUsers']);

    Route::get('/account/verify/{token}',[App\Http\Controllers\Admin\UsersController::class, 'activateAccount'])->name('account.verify');
    Route::get('/activate-account', [App\Http\Controllers\Admin\UsersController::class, 'activateAccount'])->name('activateAccount');
    Route::get('/registrationCompleted', [App\Http\Controllers\Admin\UsersController::class, 'registrationCompleted'])->name('registrationCompleted');
    // Route::get('/loginwelcome', [App\Http\Controllers\Admin\UsersController::class, 'loginwelcome'])->name('loginwelcome');

    Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'redirectToPaymentGateway']);
    Route::post('/payment/response',[App\Http\Controllers\PaymentController::class, 'handlePaymentResponse']);
    Route::get('exchangeRates',[App\Http\Controllers\PaymentController::class, 'exchangeRates']);

    // Route::get('category/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('category');
    // Route::get('tag/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('tag');
    // Route::get('location/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('location');
    // Route::get('author/{slug}', [App\Http\Controllers\ListingController::class, 'authorlisting'])->name('author');
    // Route::get('/author-listings', [App\Http\Controllers\ListingController::class, 'authorHomelisting'])->name('authorHomePage');
    // Route::get('page/{slug}/', [App\Http\Controllers\ListingController::class, 'pagedata'])->name('page');
    // Route::get('region/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('region');

    // Route::post('/addmore', [App\Http\Controllers\ListingController::class, 'addmore']);
    // Route::get('detail/{slug}', [App\Http\Controllers\DetailController::class, 'detailPage'])->name('detail.show');
    // Route::get('newsletter-detail/{slug}', [App\Http\Controllers\DetailController::class, 'newsletterdetailPage'])->name('newsletterdetail');
    // Route::match(['get', 'post'], '/advancefilter{slug?}', [App\Http\Controllers\AdvanceFilterController::class, 'advancefilter'])->name('advancefilter');
    Route::get('/advancefilter/{slug?}', [App\Http\Controllers\AdvanceFilterController::class, 'advancefilter']);
    Route::post('/advancefilter', [App\Http\Controllers\AdvanceFilterController::class, 'advancefilter']);
    Route::get('/reset/password/{token}',[App\Http\Controllers\Admin\UsersController::class, 'resetPassword'])->name('reset.password');
    Route::get('/add/subscriber/detail/{token}',[App\Http\Controllers\Admin\UsersController::class, 'subscriberdetail'])->name('add.subscriber.detail');
    Route::get('download_invoice/{slug}', [App\Http\Controllers\admin\UsersController::class, 'generatePDF']);
    Route::get('send_invoice/{slug}', [App\Http\Controllers\admin\UsersController::class, 'sendPDF']);
    Route::get('fund/download_pdf/{slug}', [App\Http\Controllers\DirectoryController::class, 'downloadAttachedfile']);

    Route::group(['middleware' => ['checksubscriberuser']], function () {

        Route::get('directory-list/{slug?}', [App\Http\Controllers\DirectoryController::class, 'directorylist'])->name('directory.list');
        // Route::post('directory-list/{slug?}', [App\Http\Controllers\DirectoryController::class, 'directorylist'])->name('directory.list');
        // Route::post('directory-filter-list', [App\Http\Controllers\DirectoryController::class, 'directoryFilterlist'])->name('directory.filter.list');
        Route::get('subscriber-fund-detail/{fund_id}', [App\Http\Controllers\DirectoryController::class, 'subscriberFundDetails']);
        Route::get('edit-subscriber-fund-detail/{fund_id}', [App\Http\Controllers\DirectoryController::class, 'subscriberEditFundDetails']);
        Route::post('subscriber-profile/update', [App\Http\Controllers\Admin\UsersController::class, 'updateRecord']);
        Route::get('subscriber-fund-request-list/', [App\Http\Controllers\DirectoryController::class, 'subscriberFundRequestList']);
        Route::get('subscription_detail/', [App\Http\Controllers\DirectoryController::class, 'subscriptionDetail']);
        Route::get('subscription_profile/', [App\Http\Controllers\admin\UsersController::class, 'subscriptionProfile']);
        Route::get('subscriber-fund-list/', [App\Http\Controllers\DirectoryController::class, 'subscriberFundList'])->name('fund.list');
        Route::get('view-directory-detail/{company_id}', [App\Http\Controllers\DirectoryController::class, 'viewDirectoryDetail'])->name('view.directory.detail');
        Route::get('edit-directory-detail/{company_id}', [App\Http\Controllers\DirectoryController::class, 'editDirectoryDetail'])->name('edit.directory.detail');
        Route::post('/addmorefund', [App\Http\Controllers\DirectoryController::class, 'addmorefund']);
        Route::post('company/update', [App\Http\Controllers\DirectoryController::class, 'updatecompany']);
        Route::get('fund/add', [App\Http\Controllers\DirectoryController::class, 'addfund'])->name(('fund.add'));
        Route::post('fund/store', [App\Http\Controllers\DirectoryController::class, 'fundstore']);
        Route::post('fund/update', [App\Http\Controllers\DirectoryController::class, 'fundupdate']);
        Route::post('fund/convertCurrency', [App\Http\Controllers\DirectoryController::class, 'convertCurrency']);
        // Route::get('fund/download_pdf/{slug}', [App\Http\Controllers\DirectoryController::class, 'generatePDF']);
        // Route::get('fund/download_pdf/{slug}', [App\Http\Controllers\DirectoryController::class, 'downloadAttachedfile']);
        // Route::get('download_invoice/{slug}', [App\Http\Controllers\admin\UsersController::class, 'generatePDF']);
        // Route::get('send_invoice/{slug}', [App\Http\Controllers\admin\UsersController::class, 'sendPDF']);

        Route::get('category/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('category');
        Route::get('tag/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('tag');
        Route::get('location/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('location');
        Route::get('author/{slug}', [App\Http\Controllers\ListingController::class, 'authorlisting'])->name('author');
        Route::get('/author-listings', [App\Http\Controllers\ListingController::class, 'authorHomelisting'])->name('authorHomePage');
        Route::get('page/{slug}/', [App\Http\Controllers\ListingController::class, 'pagedata'])->name('page');
        Route::get('region/{slug}/{filter?}', [App\Http\Controllers\ListingController::class, 'categorylisting'])->name('region');
        Route::get('detail/{slug}', [App\Http\Controllers\DetailController::class, 'detailPage'])->name('detail.show');
        Route::get('newsletter-detail/{slug}', [App\Http\Controllers\DetailController::class, 'newsletterdetailPage'])->name('newsletterdetail');
        Route::post('/addmore', [App\Http\Controllers\ListingController::class, 'addmore']);


    });
    Route::get('/login', [App\Http\Controllers\Admin\UsersController::class, 'getFrontUserLogin']); // subscriber
    Route::post('/login', [App\Http\Controllers\Admin\UsersController::class, 'checkUserFront']);
    Route::prefix('/admin')->group(function () {

    // Route::get('/loginwelcome', [App\Http\Controllers\Admin\UsersController::class, 'loginwelcome']);
    Route::get('/login', [App\Http\Controllers\Admin\UsersController::class, 'getUserLogin']); // non suscriber
    Route::post('/login', [App\Http\Controllers\Admin\UsersController::class, 'checkUser']);
    Route::get('/forgot-password', [App\Http\Controllers\Admin\UsersController::class, 'forgotPassword']);
    Route::post('/verify-your-email', [App\Http\Controllers\Admin\UsersController::class, 'verifyEmail']);
    Route::post('/forgot-email-code', [App\Http\Controllers\Admin\UsersController::class, 'emailcode']);
    Route::get('/logout', [App\Http\Controllers\Admin\UsersController::class, 'getLogout']);
    Route::post('/set-new-password', [App\Http\Controllers\Admin\UsersController::class, 'setNewPassword']);

    Route::group(['middleware' => ['checkuser']], function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomePageController::class, 'getHomePage']);

        /*
        * Access User Privilegses
        */
        Route::group(['middleware' => ['user_privs:3,4,5,6']], function() {
            Route::get('/users/add-user', [App\Http\Controllers\Admin\UsersController::class, 'getUserRegistration'])->middleware('user_privs:3');
            Route::post('/users/add-user', [App\Http\Controllers\Admin\UsersController::class, 'addUser'])->middleware('user_privs:3');
            Route::get('/users/all-users', [App\Http\Controllers\Admin\UsersController::class, 'getUserList'])->middleware('user_privs:6')->name('admin.users.all-users');
            Route::get('delete_user', [App\Http\Controllers\Admin\UsersController::class, 'deleteRecord'])->middleware('user_privs:4');
            Route::post('/users/update-user', [App\Http\Controllers\Admin\UsersController::class, 'updateRecord']);
            Route::get('/users/edit-user/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'editUser'])->middleware('user_privs:5')->name('admin.users.edit-user');
            Route::get('/users/edit-privileges', [App\Http\Controllers\Admin\UsersController::class, 'editPrivileges'])->middleware('user_privs:30')->name('admin.users.edit-privileges');
            Route::post('/users/update-user-plan', [App\Http\Controllers\Admin\UsersController::class, 'updatePlan']);

            Route::post('/users/update-user-privilege', [App\Http\Controllers\Admin\UsersController::class, 'updatePrivileges'])->middleware('user_privs:29');
        });



        // category routes
        Route::get('/add-category', [App\Http\Controllers\CategoryController::class, 'addCategory']);
        Route::post('/store-category', [App\Http\Controllers\CategoryController::class, 'storeCategory']);
        Route::post('/update-category', [App\Http\Controllers\CategoryController::class, 'updateCategory']);
        Route::get('/list-categories', [App\Http\Controllers\CategoryController::class, 'listCategory']);
        Route::get('/edit-category/{cat_id}', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('admin.edit-category');
        Route::post('/delete_category', [App\Http\Controllers\CategoryController::class, 'deleteRecord']);

        // tags routes
        Route::get('/add-tag', [App\Http\Controllers\TagController::class, 'addTag']);
        Route::post('/store-tag', [App\Http\Controllers\TagController::class, 'storeTag']);
        Route::post('/update-tag', [App\Http\Controllers\TagController::class, 'updateTag']);
        Route::get('/list-tag', [App\Http\Controllers\TagController::class, 'listTag']);
        Route::get('/edit-tag/{tag_id}', [App\Http\Controllers\TagController::class, 'addTag'])->name('admin.edit-tag');
        Route::post('/delete_tag', [App\Http\Controllers\TagController::class, 'deleteRecord']);


    //Post routes
    Route::get('post/list-post', [App\Http\Controllers\PostController::class, 'listPost'])->name('admin.post.list-post');
    Route::get('post/add-post', [App\Http\Controllers\PostController::class, 'addPost']);
    Route::post('post/store-post', [App\Http\Controllers\PostController::class, 'storePost']);
    Route::post('post/update-post', [App\Http\Controllers\PostController::class, 'updatePost']);
    Route::get('post/edit-post/{post_id}', [App\Http\Controllers\PostController::class, 'editpost'])->name('admin.post.edit-post');
    Route::post('/delete_post', [App\Http\Controllers\PostController::class, 'deleteRecord']);

    //Page Routes
    Route::get('admin/page/list-pages', [App\Http\Controllers\PageController::class, 'listPages'])
    ->name('admin.page.list-page');
    Route::get('page/add-page', [App\Http\Controllers\PageController::class, 'addPage']);
    Route::post('page/store-page', [App\Http\Controllers\PageController::class, 'storePage']);
    Route::post('page/update-page', [App\Http\Controllers\PageController::class, 'updatePage']);
    Route::get('page/edit-page/{page_id}', [App\Http\Controllers\PageController::class, 'editPage'])->name('admin.page.edit-page');
    Route::post('/delete_page', [App\Http\Controllers\PageController::class, 'deleteRecord']);

    //Madia Library
    Route::get('media/library', [App\Http\Controllers\MediaController::class, 'mediapage']);
    Route::post('media/store-images', [App\Http\Controllers\MediaController::class, 'storeImages']);

    //Menu routes
    Route::get('menu/add-menu', [App\Http\Controllers\MenuController::class, 'addMenu']);
    Route::get('menu/list-menu', [App\Http\Controllers\MenuController::class, 'listMenus']);
    Route::post('menu/store-menu', [App\Http\Controllers\MenuController::class, 'storeMenu']);
    Route::post('menu/update-menu', [App\Http\Controllers\MenuController::class, 'updateMenu']);
    Route::get('menu/edit-menu/{menu_id}', [App\Http\Controllers\MenuController::class, 'editMenu'])->name('admin.menu.edit-menu');
    Route::post('/delete_menu', [App\Http\Controllers\MenuController::class, 'deleteRecord']);

        //Page Routes
        Route::get('page/list-pages', [App\Http\Controllers\PageController::class, 'listPages']);
        Route::get('page/add-page', [App\Http\Controllers\PageController::class, 'addPage']);
        Route::post('page/store-page', [App\Http\Controllers\PageController::class, 'storePage']);
        Route::post('page/update-page', [App\Http\Controllers\PageController::class, 'updatePage']);
        Route::get('page/edit-page/{page_id}', [App\Http\Controllers\PageController::class, 'editPage'])->name('admin.page.edit-page');
        Route::post('/delete_page', [App\Http\Controllers\PageController::class, 'deleteRecord']);

        //Madia Library
        Route::get('media/library', [App\Http\Controllers\MediaController::class, 'mediapage']);
        Route::post('media/delete-image', [App\Http\Controllers\MediaController::class, 'deleteImage']);

        //Menu routes
        Route::get('menu/add-menu', [App\Http\Controllers\MenuController::class, 'addMenu']);
        Route::get('menu/list-menu', [App\Http\Controllers\MenuController::class, 'listMenus']);
        Route::post('menu/store-menu', [App\Http\Controllers\MenuController::class, 'storeMenu']);
        Route::post('menu/update-menu', [App\Http\Controllers\MenuController::class, 'updateMenu']);
        Route::get('menu/edit-menu/{menu_id}', [App\Http\Controllers\MenuController::class, 'editMenu'])->name('admin.menu.edit-menu');
        Route::post('/delete_menu', [App\Http\Controllers\MenuController::class, 'deleteRecord']);

        //Domain routes
        Route::group(['middleware' => ['user_privs:1']], function() {

            Route::get('domain/add-domain', [App\Http\Controllers\DomainController::class, 'addDomain'])->name('admin.domain.add-domain');
            Route::get('domain/list-domain', [App\Http\Controllers\DomainController::class, 'listDomain'])->name('admin.domain.list-domain')->middleware('user_privs:1');
            Route::post('domain/store-domain', [App\Http\Controllers\DomainController::class, 'storeDomain']);
            Route::post('domain/update-domain', [App\Http\Controllers\DomainController::class, 'updateDomain']);
            Route::get('domain/edit-domain/{domain_id}', [App\Http\Controllers\DomainController::class, 'editDomain'])->name('admin.domain.edit-domain');
        });

        //Company routes
        Route::get('company/add-company', [App\Http\Controllers\CompanyController::class, 'addCompany']);
        Route::get('company/list-companies', [App\Http\Controllers\CompanyController::class, 'listCompanies']);
        Route::post('company/store-company', [App\Http\Controllers\CompanyController::class, 'storeCompany']);
        Route::post('company/update-company', [App\Http\Controllers\CompanyController::class, 'updateCompany']);
        Route::get('company/edit-company/{company_id}', [App\Http\Controllers\CompanyController::class, 'editCompany'])->name('admin.company.edit-company');
        Route::post('/delete_company', [App\Http\Controllers\CompanyController::class, 'deleteRecord']);
        Route::get('company/export/companies', [App\Http\Controllers\CompanyController::class, 'export'])->name('export.companies');
        Route::post('company/import/companies',[App\Http\Controllers\CompanyController::class, 'import'])->name('import.companies');

        //Fund routes
        Route::get('fund/add-fund', [App\Http\Controllers\FundController::class, 'addFund']);
        Route::get('fund/list-funds', [App\Http\Controllers\FundController::class, 'listFunds']);
        Route::post('fund/store-fund', [App\Http\Controllers\FundController::class, 'storeFund']);
        Route::post('fund/update-fund', [App\Http\Controllers\FundController::class, 'updateFund']);
        Route::get('fund/edit-fund/{fund_id}', [App\Http\Controllers\FundController::class, 'editFund'])->name('admin.fund.edit-fund');
        Route::post('fund/change-fund-status', [App\Http\Controllers\FundController::class, 'changeStatus']);
        Route::post('/delete_fund', [App\Http\Controllers\FundController::class, 'deleteRecord']);
        Route::get('fund/export/funds', [App\Http\Controllers\FundController::class, 'export'])->name('export.funds');
        Route::post('fund/import/funds',[App\Http\Controllers\FundController::class, 'import'])->name('import.funds');


        //Form routes
        Route::get('form/add-form', [App\Http\Controllers\FormController::class, 'addForm']);
        Route::get('form/list-forms', [App\Http\Controllers\FormController::class, 'listForms']);
        Route::post('form/store-form', [App\Http\Controllers\FormController::class, 'storeForm']);
        Route::post('form/update-form', [App\Http\Controllers\FormController::class, 'updateForm']);
        Route::get('form/edit-form/{form_id}', [App\Http\Controllers\FormController::class, 'editForm'])->name('admin.form.edit-form');
        Route::post('/delete_form', [App\Http\Controllers\FormController::class, 'deleteRecord']);

        //Setting routes
        Route::get('setting/add-setting', [App\Http\Controllers\SettingController::class, 'addSetting']);
        Route::get('setting/filter-setting', [App\Http\Controllers\SettingController::class, 'addFilterSetting']);
        Route::get('setting/edit-filter-setting/{filter_setting_id}', [App\Http\Controllers\SettingController::class, 'addFilterSetting'])->name('admin.setting.edit-filter-setting');
        Route::get('setting/list-filter-setting', [App\Http\Controllers\SettingController::class, 'listFilterSetting']);
        Route::post('setting/store-setting', [App\Http\Controllers\SettingController::class, 'storeSetting']);
        Route::post('setting/store-filter-setting', [App\Http\Controllers\SettingController::class, 'storeFilterSetting']);
        // Route::post('setting/update-form', [App\Http\Controllers\FormController::class, 'updateForm']);
        // Route::get('setting/edit-form/{form_id}', [App\Http\Controllers\FormController::class, 'editForm'])->name('admin.form.edit-form');
        Route::post('/delete_filter_setting', [App\Http\Controllers\SettingController::class, 'deleteRecord']);

        //Packages
        Route::get('package/add-package', [App\Http\Controllers\PackageController::class, 'addPackage']);
        Route::get('package/list-packages', [App\Http\Controllers\PackageController::class, 'listPackages']);
        Route::post('package/store-package', [App\Http\Controllers\PackageController::class, 'storePackage']);
        Route::post('package/update-package', [App\Http\Controllers\PackageController::class, 'updatePackage']);
        Route::get('package/edit-package/{package_id}', [App\Http\Controllers\PackageController::class, 'editPackage'])->name('admin.package.edit-package');
        Route::post('/delete_package', [App\Http\Controllers\PackageController::class, 'deleteRecord']);

        //Deals
        Route::get('deal/add-deal', [App\Http\Controllers\PackageController::class, 'addDeal']);
        Route::get('deal/list-deals', [App\Http\Controllers\PackageController::class, 'listDeals']);
        Route::post('deal/store-deal', [App\Http\Controllers\PackageController::class, 'storeDeals']);
        Route::post('deal/update-deal', [App\Http\Controllers\PackageController::class, 'updateDeal']);
        Route::get('deal/edit-deal/{deal_id}', [App\Http\Controllers\PackageController::class, 'editDeal'])->name('admin.deal.edit-deal');
        Route::post('/delete_deal', [App\Http\Controllers\PackageController::class, 'deleteRecord']);

        //Location route
        Route::get('location/add-location', [App\Http\Controllers\LocationController::class, 'addLocation']);
        Route::get('location/list-locations', [App\Http\Controllers\LocationController::class, 'listLocations']);
        Route::post('location/store-location', [App\Http\Controllers\LocationController::class, 'storelocation']);
        Route::post('location/update-location', [App\Http\Controllers\LocationController::class, 'updatelocation']);
        Route::get('location/edit-location/{location_id}', [App\Http\Controllers\LocationController::class, 'editlocation'])->name('admin.location.edit-location');
        Route::post('/delete_location', [App\Http\Controllers\LocationController::class, 'deleteRecord']);

        //Location route
        Route::get('subscriber/list-subscriber', [App\Http\Controllers\SubscriberController::class, 'listSubscriber']);
        Route::get('subscriber/add-subscriber', [App\Http\Controllers\SubscriberController::class, 'addSubscriber']);
        Route::post('subscriber/change-subscriber-payment-status', [App\Http\Controllers\SubscriberController::class, 'changeStatus']);

        //ads route
        Route::get('ads/add-ads', [App\Http\Controllers\AdsController::class, 'addAds']);
        Route::get('ads/list-ads', [App\Http\Controllers\AdsController::class, 'listAds']);
        Route::post('ads/store-ads', [App\Http\Controllers\AdsController::class, 'storeads']);
        Route::post('ads/update-ads', [App\Http\Controllers\AdsController::class, 'updateads']);
        Route::get('ads/edit-ads/{ads_id}', [App\Http\Controllers\AdsController::class, 'editads'])->name('admin.ads.edit-ads');
        Route::post('/delete_ads', [App\Http\Controllers\AdsController::class, 'deleteRecord']);

    });
});
