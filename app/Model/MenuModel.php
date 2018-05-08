<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model {
    
	protected $table = 'menu_admin';
	protected $fillable = [
        'name', 'icon', 'function', 'parent', 'status'
    ];
    public $timestamps = false;
    
}
