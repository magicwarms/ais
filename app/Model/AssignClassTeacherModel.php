<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignClassTeacherModel extends Model {
    
	protected $table = 'class_join_teacher';
	protected $fillable = [
        'class_id', 'teachers_id'
    ];

    public $timestamps = false;

}
