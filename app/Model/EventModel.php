<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model {
    
	protected $table = 'event_news';
	protected $fillable = [
        'title', 'start_event', 'end_event', 'description', 'event_file'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_event', 'end_event'
    ];

    public $timestamps = false;

}
