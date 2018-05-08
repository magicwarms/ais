<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubjectTeacherModel extends Model {
    
	protected $table = 'subject_join_teacher';
	protected $fillable = [
        'subjects_id', 'teachers_id'
    ];

    public $timestamps = false;

}
