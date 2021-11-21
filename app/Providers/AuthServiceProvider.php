<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\PermissionGatePolicyAccess;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Define Permission
        $permissionGatePolicy=new PermissionGatePolicyAccess();
        $permissionGatePolicy->setGatePolicyAccess();

        Gate::define('list-article', function($user){ 
            return $user->checkPermissionAccess(config('permissions.access.list-article'));
         });
    }
  
    
}
