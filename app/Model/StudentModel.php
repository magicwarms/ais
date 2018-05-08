<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentModel extends Authenticatable {
    
	use Notifiable;
	protected $guard = 'student';
    protected $table = 'students';
	protected $fillable = [
        'class_id', 'parents_id', 'nis','password','name','address','gender','birthday','photo_file','status','last_login'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birthday','last_login'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
