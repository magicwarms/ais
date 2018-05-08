<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdminModel extends Authenticatable {

	use Notifiable;

	protected $table = 'user_admin';
	protected $fillable = [
        'name', 'email', 'status_admin','password','level','last_login'
    ];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	    'password', 'remember_token',
	];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login',
    ];

	public $timestamps = false;
	
	public static function get_new(){
		$menu = new UserAdminModel();
		$menu->name = '';
		$menu->email = '';
		$menu->status_admin = '';
		$menu->password = '';
		$menu->level = '';
		return $menu;
	}
}
