<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenceModel extends Model {

    use SoftDeletes;
    protected $table = 'absent_students';
	protected $fillable = [
        'students_id', 'code','class_id','input_by','remark'
    ];
  	protected $dates = ['deleted_at'];
  	public $timestamps = false;
}
