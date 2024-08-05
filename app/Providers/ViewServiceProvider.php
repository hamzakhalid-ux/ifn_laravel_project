<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...

        View::composer(
            [
                'components/admin/left_navigation'
            ],
            \App\Composers\LeftPanelDataComposer::class
        );

        View::composer(
            [
                'components/admin/category',
                'components/admin/categorylist',
                'components/admin/addpost',
                'components/admin/editpost',
                'components/admin/addmenu',
                'components/admin/editmenu',
                'components/admin/addFilterSetting',
                'components/admin/addsetting',
                // 'components/index/categorylistingnewstemplate',

            ],
            \App\Composers\CaregoryDataComposer::class
        );
        View::composer(
            [
                'components/admin/taglist',
                'components/admin/addpost',
                'components/admin/editpost',
                'components/admin/addmenu',
                'components/admin/editmenu',
                'components/admin/addFilterSetting',
                // 'components/index/categorylistingnewstemplate',

            ],
            \App\Composers\TagListDataComposer::class
        );

        View::composer(
            [
                'components/admin/addtag'
            ],
            \App\Composers\EditTagDataComposer::class
        );

        View::composer(
            [
                'components/admin/postlist',
                'components/admin/addmenu',
                'components/admin/editmenu',
                'components/admin/addsetting',

            ],
            \App\Composers\PostListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editpost'
            ],
            \App\Composers\EditPostDataComposer::class
        );

        View::composer(
            [
                'components/admin/addpage',
                'components/admin/editpage',
                'components/admin/pageslist',
                'components/admin/addmenu',
                'components/admin/editmenu',

            ],
            \App\Composers\PageListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editpage'
            ],
            \App\Composers\EditPageDataComposer::class
        );

        View::composer(
            [
                'components/admin/menulist',
                'components/admin/editmenu',
                'components/admin/addmenu',
                'components/admin/addsetting',

            ],
            \App\Composers\MenuListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editmenu'
            ],
            \App\Composers\EditMenuDataComposer::class
        );
        View::composer(
            [
                'components/admin/add_user',
                'components/admin/edit_user',
                'components/admin/add_subscriber',
            ],
            \App\Composers\UserDataComposer::class
        );

        View::composer(
            [
                'components/admin/imagelisting'
            ],
            \App\Composers\LibraryDataComposer::class
        );

        View::composer(
            [
                'components/admin/user_list'
            ],
            \App\Composers\UserListDataComposer::class
        );
        View::composer(
            [
                'components/admin/edit_user'
            ],
            \App\Composers\EditUserDataComposer::class
        );
        View::composer(
            [
                'components/admin/edit_privilege'
            ],
            \App\Composers\EditUserPrevDataComposer::class
        );

        View::composer(
            [
                'components/admin/domain_list'
            ],
            \App\Composers\DomianListDataComposer::class
        );

        View::composer(
            [
                'components/admin/edit_domain'
            ],
            \App\Composers\EditDomainDataComposer::class
        );

        View::composer(
            [
                'components/admin/dashboard'
            ],
            \App\Composers\DashboardDataComposer::class
        );

        View::composer(
            [
                'components/admin/addcompany',
                'components/admin/editcompany',
                'components/admin/addfund',
                'components/admin/editfund',
                'components/index/edit_directory_detail',
                'components/index/directory_fund_add',
                'components/index/updatefund',
                'components/index/directorylist',
                'components/index/subscriber_fund_list',
                'components/index/advance_filter',
                'components/admin/personal_details',
                'components/admin/subscriber_details',
                'components/admin/add_user',
                'components/admin/edit_user',
                'components/index/subscriber_profile',

            ],
            \App\Composers\CountriesListDataComposer::class
        );
        View::composer(
            [
                'components/index/advance_filter',
            ],
            \App\Composers\AdvanceSearchDataComposer::class
        );

        View::composer(
            [
                'components/admin/addcompany',
                'components/admin/editcompany',
                'components/index/edit_directory_detail'

            ],
            \App\Composers\LangListDataComposer::class
        );

        View::composer(
            [
                'components/admin/addcompany',
                'components/admin/editcompany',
                'components/admin/addfund',
                'components/admin/editfund',
                'components/index/edit_directory_detail'

            ],
            \App\Composers\CurrencyListDataComposer::class
        );

        View::composer(
            [
                'components/admin/addcompany',
                'components/admin/editcompany',
                'components/index/edit_directory_detail'
            ],
            \App\Composers\TimezoneListDataComposer::class
        );

        View::composer(
            [
                'components/admin/listcompanies',
                'components/admin/addfund',
                'components/admin/editfund',
                'components/index/directorylist',
                'components/index/directory_fund_add',
                'components/index/updatefund',
            ],
            \App\Composers\CompanyListDataComposer::class
        );
        View::composer(
            [
                'components/index/charts'
            ],
            \App\Composers\ChartsListDataComposer::class
        );


        View::composer(
            [
                'components/admin/editcompany',
                'components/index/view_directory_detail',
                'components/index/edit_directory_detail',
                'components/index/footer',
            ],
            \App\Composers\EditCompanyDataComposer::class
        );

        View::composer(
            [
                'components/admin/listfunds',
                'components/index/subscriber_fund_list',
                'components/index/subscriber_fund_request_list',
            ],
            \App\Composers\FundListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editfund'
            ],
            \App\Composers\EditFundDataComposer::class
        );

        View::composer(
            [
                'components/admin/addform',
                'components/admin/editform',
            ],
            \App\Composers\FormFieldsDataComposer::class
        );

        View::composer(
            [
                'components/admin/listforms'
            ],
            \App\Composers\FormListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editform',
            ],
            \App\Composers\EditFormDataComposer::class
        );

        View::composer(
            [
                'components/admin/addsetting',
                'components/index/navbar',
                'components/index/footer',
                'components/index/topbar',
                'components/index/partial',
                'components/index/middle',
                'components/index/lastsession',
                'components/index/bottom',
                'components/index/bottom2',
                'components/index/partner',
                'components/index/adssession',
                'components/index/adssession2',
                'components/index/adssession3',
            ],
            \App\Composers\EditSettingDataComposer::class
        );


        View::composer(
            [
                'components/admin/listpackages',
                'components/admin/adddeals',
                'components/admin/editdeal',
                'components/admin/add_subscriber',
                'components/admin/signup_package',

            ],
            \App\Composers\PackageListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editpackage',
            ],
            \App\Composers\EditPackageDataComposer::class
        );

        View::composer(
            [
                'components/admin/listdeals',
            ],
            \App\Composers\DealsListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editdeal',
                // 'components/admin/package_details',
            ],
            \App\Composers\EditDealDataComposer::class
        );

        View::composer(
            [
                'components/admin/addFilterSetting',
            ],
            \App\Composers\EditFilterSettingDataComposer::class
        );

        View::composer(
            [
                'components/admin/addlocation',
                'components/admin/listlocation',
                'components/admin/editlocation',
                'components/admin/addpost',
                'components/admin/editpost',
                'components/admin/addmenu',
                'components/admin/editmenu',
                'components/admin/addFilterSetting',
            ],
            \App\Composers\LocationsDataComposer::class
        );

        View::composer(
            [
                'components/admin/listfiltersetting',
            ],
            \App\Composers\ListFilterSettingDataComposer::class
        );

        View::composer(
            [
                'components/admin/editlocation',
            ],
            \App\Composers\EditLocationDataComposer::class
        );

        View::composer(
            [
                'components/index/categorylisting',
            ],
            \App\Composers\CategoryListingDataComposer::class
        );

        View::composer(
            [
                'components/index/detail_page',
            ],
            \App\Composers\DetailPageDataComposer::class
        );
        View::composer(
            [
                'components/index/authorcategorylisting',
            ],
            \App\Composers\AuthorCategoryListingDataComposer::class
        );
        // View::composer(
        //     [
        //         'components/index/author_home_listing',
        //     ],
        //     \App\Composers\AuthorHomeListingDataComposer::class
        // );

        View::composer(
            [
                'components/admin/subscriberlisting',
            ],
            \App\Composers\SubscriberListDataComposer::class
        );

        View::composer(
            [
                'components/admin/listads',
            ],
            \App\Composers\AdsListDataComposer::class
        );

        View::composer(
            [
                'components/admin/editads',
            ],
            \App\Composers\EditAdsDataComposer::class
        );

        View::composer(
            [
                'components/index/newsletter_detail_page',
            ],
            \App\Composers\NewsLetterDetailPageDataComposer::class
        );
        View::composer(
            [
                'components/index/directorylist',
            ],
            \App\Composers\CompanyPreFIlterDataComposer::class
        );
        View::composer(
            [
                'components/index/author_home_listing',
            ],
            \App\Composers\AuthorListingDataComposer::class
        );
        View::composer(
            [
                'components/index/topbar',
            ],
            \App\Composers\SubscriberDataComposer::class
        );
    }
}
