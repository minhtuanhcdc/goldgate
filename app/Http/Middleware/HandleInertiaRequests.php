<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

use App\Models\Menu;
use App\Models\User;
use App\Models\MenuUser;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
                'menuPermission' => function() use($request){
                    $user = $request->user();
                    if($user){
                        $menuAccess = MenuUser::join('users','users.id','menu_users.id_user')
                        ->join('menus','menus.id','menu_users.id_menu') 
                        ->where('menus.status','!=',0)
                        ->where('users.id','=',$request->user()->id)
                        ->select('menus.id','menus.id_parent','menus.name', 'menus.url')
                        ->orderBy('menus.id','ASC')  
                        ->get();
                        //dd($menuchas);
                        return [
                            'menuAccess' =>$menuAccess,
                        ];
                    }
                  
                }
            
        ]);
    }
}
