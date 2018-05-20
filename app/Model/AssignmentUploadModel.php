<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignmentUploadModel extends Model {
    
	protected $table = 'students_assignment_upload';
	protected $fillable = [
        'students_assignment_id', 'students_id', 'assignment_file', 'remark'
    ];

    public $timestamps = false;

}
