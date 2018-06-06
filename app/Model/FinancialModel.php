<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FinancialModel extends Model {

    protected $table = 'financial';
	protected $fillable = [
        'students_id', 'title', 'remark','total_pay','input_by','class_id'
    ];

    public $timestamps = false;
}
