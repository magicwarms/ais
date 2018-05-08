<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\MenuModel;
use DB;

class MenuController extends Controller {
   
	public function index_menu($id=NULL) {
		$parents = MenuModel::where('parent', 0)->pluck('name','id');
		return view('backend.menu_admin', compact('parents'));
	}

    public function show_menu() {
        $menus = MenuModel::all();
        return Datatables::of($menus)
        ->editColumn('parent', function ($model) {
            $parents = $model->parent;
            if($parents == 0) {
                $parent = 'Parent';
            } else {
                $parent_menu = get_parent_menu_name($parents);
                $parent = '<span class="uk-badge uk-badge-primary">'.$parent_menu->name.'</span>';
            }
            return $parent;
        })
        ->editColumn('icon', function ($model) {
            $icons = $model->icon;
            if($model->parent == 0) {
                $icon = '<i class="material-icons md-24">'.$icons.'</i>';
            } else {
                $icon = '<i class="material-icons md-24 uk-text-danger">'.$icons.'</i>';
            }
            return $icon;
        })
        ->editColumn('status', function ($model) {
            $status = $model->status;
            if($status == 1){
                $status = '<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
            } else {
                $status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
            }
            return $status;
        })
        ->editColumn('created_date', function ($model) {
            $created = date('d F Y H:i:s', strtotime($model->created_date));
            return $created;
        })
        ->editColumn('updated_date', function ($model) {
            $updated = $model->updated_date;
            if($updated != null){
              $updated = date('d F Y H:i:s', strtotime($updated));
            } else {
              $updated = '-';
            }
            return $updated;
        })
        ->addColumn('action', function ($model) {
            $action = '
                <a href="#" class="edit_data" data-id="'.$model->id.'"><i class="md-icon material-icons">&#xE254;</i></a>
                <a onclick="delete_data('.$model->id.')" href="#"><i class="md-icon material-icons">&#xE16C;</i>
                </a>
            ';
            return $action;
        })
        ->rawColumns(['status','action','parent','icon'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_menu($menu_id) {
        $menu = MenuModel::findOrFail($menu_id);
        if($menu->status == 1)$status='true'; else $status='';
        $output = array(
            'name'    =>  $menu->name,
            'icon'     =>  $menu->icon,
            'function'     =>  $menu->function,
            'parent'     =>  $menu->parent,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_menu() {
		DB::beginTransaction();
		$this->validate(request(), [
            'name' => 'required|max:25|min:3|unique:menu_admin,name',
            'icon' => 'required|max:20|min:3',
            'function' => 'required|max:65|min:3',
        ]);
	
		if(request('status') == 'on')$status=1; else $status=0;
        if(request('parent') == '')$parent = 0; else $parent = request('parent');
    	MenuModel::create([
    		'name' => request('name'),
    		'icon' => strtolower(request('icon')),
    		'function' => strtolower(request('function')),
    		'parent' => $parent,
    		'status' => $status
    	]);
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Menu Berhasil Ditambahkan']);
	}

	public function delete_menu(){
		DB::beginTransaction();
		try {
			$menu = MenuModel::findOrFail(request('id'));
	        $menu->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Menu Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_menu() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:25|min:3',
            'icon' => 'required|max:20|min:3',
            'function' => 'required|max:65|min:3',
        ]);
        
        if(request('status') == 'on')$status=1; else $status=0;
        if(request('parent') == '')$parent = 0; else $parent = request('parent');
        $menu = MenuModel::findOrFail(request('id'));
        $menu->name = request('name');
        $menu->icon = strtolower(request('icon'));
        $menu->function = strtolower(request('function'));
        $menu->parent = $parent;
        $menu->status = $status;
        $menu->save();

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Menu Berhasil Diperbaharui']);
    }
}
