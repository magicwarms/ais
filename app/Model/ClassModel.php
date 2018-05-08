<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model {
    
	protected $table = 'class';
	protected $fillable = [
        'name', 'code', 'status'
    ];

    public $timestamps = false;
}
