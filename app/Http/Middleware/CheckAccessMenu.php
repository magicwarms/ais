<?php

namespace App\Http\Middleware;

use Closure;

use App\Model\MenuModel;
use App\Model\MenuJoinAdminModel;

class CheckAccessMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $url = strtolower(\Request::segment(1));
        $auth_id = \Auth::user()->id;

        $find_menu_id = MenuModel::select('id')->where('function', $url)->first();
        if($find_menu_id != ''){
            $find_menu = MenuJoinAdminModel::where('menu_admin_id', $find_menu_id->id)->where('user_admin_id', $auth_id)->first();
            if(empty($find_menu)) {
                return redirect()->back()->with('warning','Kamu tidak diperbolehkan akses menu tersebut.');
            }
        }

        return $next($request);
    }
}
