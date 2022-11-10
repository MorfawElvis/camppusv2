<?php

namespace App\Providers;


use App\Models\SchoolTerm;
use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot():void
    {
        Model::preventLazyLoading(! app()->isProduction());
//        $general_setting = GeneralSetting::first();
//        $current_term   = School_Term::where('term_status', 'opened')->first();
//        View::share([
//            'current_term' => $current_term,
//            'general_setting' => $general_setting
//        ]);
    }
}
