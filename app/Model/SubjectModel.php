<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model {
    
	protected $table = 'subjects';
	protected $fillable = [
        'name', 'code', 'status'
    ];

    public $timestamps = false;

}
