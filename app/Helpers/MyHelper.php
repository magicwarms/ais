<?php
use App\Model\MenuModel;

if (!function_exists('menu_active')) {
    function menu_active($parent=NULL, $child=NULL, $session=NULL) {
    	$auth = Auth::user()->id;
    	$menu = DB::table('menu_admin')
            ->join('menu_join_admin', 'menu_join_admin.menu_admin_id', '=', 'menu_admin.id')
            ->select('menu_admin.id','menu_admin.name','menu_admin.function','menu_admin.parent','menu_admin.icon');
            if($parent != NULL){
		        $menu->where('menu_admin.parent', 0);
		    }
		    if($child != NULL){
		        $menu->where('menu_admin.parent', '!=', 0);
		    }
		    if($session != NULL){
		        $menu->where('menu_join_admin.user_admin_id', $auth);
		    }
		    $menu->where('menu_admin.status', 1);
            $result = $menu->get();
        return $result;
    }
}
if (!function_exists('get_parent_menu_name')) {
	function get_parent_menu_name($id){
		$get_parent = MenuModel::select('name')->where('id', $id)->first();
	    return $get_parent;
	}
}

if (!function_exists('get_all_row_multiple_menu')){
	function get_all_row_multiple_menu($id){
	    $menu = DB::table('menu_admin')
	    ->join('menu_join_admin', 'menu_join_admin.menu_admin_id', '=', 'menu_admin.id')
	    ->select('menu_admin.name','menu_admin.id')
	    ->where('menu_join_admin.user_admin_id', $id);

	    $menu = $menu->get();
	    return $menu;
	}
}

if (!function_exists('select_all_multiple_menu')){
	function select_all_multiple_menu(){
	    $multiple_menu = MenuModel::select('name','id')->get();
	    return $multiple_menu;
	}
}
