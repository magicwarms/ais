<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model {
    
	protected $table = 'student_assignments';
	protected $fillable = [
        'name', 'class_id', 'assignment_file', 'remark', 'status', 'start_assignment', 'end_assignment', 'input_by', 'subjects_id','teachers_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_assignment', 'end_assignment', 'deleted_at'
    ];

    public $timestamps = false;

}
