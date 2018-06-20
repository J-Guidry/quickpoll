<?php

namespace quickpoll\Http\Controllers;

use Illuminate\Http\Request;
use quickpoll\Poll;
use quickpoll\PollOption;

class PollController extends Controller
{
    //
    public function index(){
        return view("index");
    }

    public function store(Request $request){
        $input = $request->all();

        $input['poll_name'] = filter_var($input['poll_name'], FILTER_SANITIZE_STRING);
        $input['poll_option'] = filter_var_array($input['poll_option']);
        $request->replace($input);  
    
        $request->validate([
            'poll_name' => 'required|string',
            'poll_option' => 'required',
        ]);
        
        $poll = new Poll;
        $poll->poll_name = $request->poll_name;
    
        $poll->save();
        $id = $poll->getAttribute('id');
    
        $option = $request->poll_option;
    
        $options = [];
    
        for($i = 0; $i < count($option); $i++){
            $poption =  new PollOption;
            $options[] = $poption->fill([
                'option_name' => $option[$i],
                'poll_id' => $id
            ]);
            $poption->save();
        }
        //dd(response($id));
        return $id;
        //return redirect("/poll/$id");
       // return response()->json(['id' => $id]);
    }

    public function show($id){
        $options = Poll::find($id)->options;
        $poll_name = Poll::find($id)->poll_name;
        
        $option_names = [];
        foreach($options as $option){
            $option_names[] = $option->getAttributes();
        }
    
        return view('poll',['title' => $poll_name, 'options' => $option_names, 'id' => $id]);
    }

    public function update($id,Request $request){
        $input = $request->all();
        //dd($input);
        $input['poll_name'] = filter_var($input['votes'], FILTER_SANITIZE_STRING);
        $request->replace($input);  
    
        $request->validate([
            'votes' => 'required|string',
        ]);
    
        $option_voted_for = $request->votes;
    
        $find_vote = PollOption::where([        
            ['poll_id', '=', $id],
            ['option_name','=', $option_voted_for]
            ])->firstOrFail();
        $vote = $find_vote;
        $vote->vote_count += 1;
        $vote->save();
    
        return redirect("/results/$id");
    }
}
