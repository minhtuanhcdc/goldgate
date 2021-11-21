<?php
namespace App\Services;
use Illuminate\Support\Facades\Gate;

class PermissionGatePolicyAccess{
    public function setGatePolicyAccess(){ 
        $this->defindGateCategory();
    }

    public function defindGateCategory(){
        Gate::define('list-category','App\Policies\CategoryPolicy@view');
        Gate::define('create-category','App\Policies\CategoryPolicy@create');
        Gate::define('edit-category','App\Policies\CategoryPolicy@update');
        Gate::define('delete-category','App\Policies\CategoryPolicy@delete');
    }

}