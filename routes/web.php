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

Route::post('/polls', "PollController@store");

Route::get('/poll/{id}', "PollController@show");

Route::put("/vote/{id}", "PollController@update");

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