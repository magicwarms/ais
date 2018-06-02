<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubjectTeacherModel extends Model {
    
	protected $table = 'subject_join_teacher';
	protected $fillable = [
        'subjects_id', 'teachers_id','subject_day_time','total_hours'
    ];

    public $timestamps = false;

}
