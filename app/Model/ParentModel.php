<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable {
   
	use Notifiable;
    protected $guard = 'parent';
    protected $table = 'parents';
	protected $fillable = [
        'name', 'phone', 'password','address','gender','status','last_login'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
