<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
//use App\Models\Menu;
//use App\Models\User;
//use App\Models\MenuUser;
//use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
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
        Inertia::share('flash', function(){
            return [
                'success'=>Session::get('success'),
                'failure'=>Session::get('failure')
            ];

        });
      
        //Inertia::share('menu', function(){
           //$menuPermission=MenuUser::
            //return [
            //    'parentRole'=>$parentRole,
           //     'chileRole'=>$chileRole,
            //];
        //});
    }
}
