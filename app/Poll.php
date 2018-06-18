<?php

namespace quickpoll;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function options()
    {
        return $this->hasMany('quickpoll\PollOption');
    }


}
