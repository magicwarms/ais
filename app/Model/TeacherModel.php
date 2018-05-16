<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TeacherModel extends Authenticatable {
    
    use Notifiable;
    protected $guard = 'teacher';
    protected $table = 'teachers';
	protected $fillable = [
        'name', 'address', 'birthday','code','gender','education','status','photo_file','password','phone'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birthday'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
