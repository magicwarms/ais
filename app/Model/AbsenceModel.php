<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenceModel extends Model {

    use SoftDeletes;
    protected $table = 'absent_students';
	protected $fillable = [
        'students_id', 'code','class_id','input_by','remark','absent_date'
    ];
  	protected $dates = ['deleted_at','absent_date'];
  	public $timestamps = false;
}
