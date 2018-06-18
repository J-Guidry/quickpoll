<?php

namespace quickpoll;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    //
    public function poll()
    {
        return $this->belongsTo('quickpoll\Poll');
    }
    protected $fillable = ['option_name', 'poll_id'];


}
