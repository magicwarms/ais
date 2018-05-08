<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConfirmationModel extends Model {
    
	protected $table = 'confirm_payment';
	protected $fillable = [
        'financial_id', 'parents_id', 'confirm_file','remark','total_pay','remark_admin','status'
    ];

    public $timestamps = false;

}
