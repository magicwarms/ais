<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FinancialModel extends Model {

    protected $table = 'financial';
	protected $fillable = [
        'class_id', 'title', 'remark','total_pay','input_by'
    ];

    public $timestamps = false;
}
