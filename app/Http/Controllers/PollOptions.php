<?php

namespace quickpoll\Http\Controllers;

use Illuminate\Http\Request;

class PollOptions extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $option = $request->poll_option;
        
        $options = [];
        for($i = 0; $i < count($option); $i++){
            $options[] = new PollOption([
                'option_name' => $option[$i]
            ]);
        }
        $options()->saveMany($options);
    }
}
