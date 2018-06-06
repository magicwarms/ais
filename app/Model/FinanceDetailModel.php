<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FinanceDetailModel extends Model {
    
	protected $table = 'financial_detail';
	protected $fillable = [
        'financial_id', 'fee', 'total','discount','remark','subtotal'
    ];

    public $timestamps = false;

}
