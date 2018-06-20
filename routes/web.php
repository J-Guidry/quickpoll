<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Http\Request;
use quickpoll\Poll;
use quickpoll\PollOption;
use quickpoll\Vote;

// Route::get('/', "WelcomeController@index");

Route::get('/', "PollController@index");

Route::post('/polls', function(Request $request) {
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

});

Route::get('/poll/{id}', function($id){
    $options = Poll::find($id)->options;
    $poll_name = Poll::find($id)->poll_name;
    
    $option_names = [];
    foreach($options as $option){
        $option_names[] = $option->getAttributes();
    }

    return view('poll',['title' => $poll_name, 'options' => $option_names, 'id' => $id]);
});

Route::put("/vote/{id}", function($id,Request $request){
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
});

Route::get('/results/{id}', function($id){
    $find_results = Poll::find($id)->options;
    $options = [];
    $votes = [];
    foreach($find_results as $result){
        $options[] = $result->only(['option_name']);
        $votes[] = $result->only(['vote_count']);
    };
    $options_array = array();
    $votes_array = array();
    array_walk_recursive($options, function($a) use (&$options_array) { $options_array[] = $a; });
    array_walk_recursive($votes, function($a) use (&$votes_array) { $votes_array[] = $a; });
    //dd($options_array ,$votes_array);
    $poll_title = Poll::find($id)->getAttribute('poll_name');

    return view('results',['title' => $poll_title, 'options'=> $options_array, 'votes' => $votes_array, 'id' => $id]);

});

Route::get('/search_results', function(Request $request){
    $search = $request->query('search');
    
    $polls = Poll::where(
        'poll_name','LIKE', "%$search%"
        )->get();


    $name_id = [];
    foreach($polls as $poll){
        $name_id[] = ['id' => $poll['id'], 'name' => $poll['poll_name']];

    };

    $results = $name_id;
    
    return view('search_results', ['results' => $results]);
});