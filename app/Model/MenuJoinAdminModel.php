<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuJoinAdminModel extends Model {
	
    protected $table = 'menu_join_admin';
	protected $fillable = [
        'user_admin_id', 'menu_admin_id'
    ];
    public $timestamps = false;
}
