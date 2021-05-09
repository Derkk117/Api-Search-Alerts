<?php

namespace App\Http\Controllers;

use App\User;
use App\Search;
use Illuminate\Http\Request;
use App\Http\Requests\SearchStore;

class SearchesController extends Controller
{    
    public $status = 200;

	public function index(User $user)
	{
		return response()->json(Search::searches($user)->get());
	}

	public function showSearches(User $user)
	{
		return Search::select('id as id', 'id as sku', 'user_id', 'concept', 'alert_id')->where('user_id', $user->id)->with('Alert')->get();
	}

	public function recentSearches(User $user)
	{
		return response()->json(Search::recentSearches($user)->orderBy('created_at','desc')->get());
	}

	public function show(Search $search)
	{
		return Search::where('id', $search->id)->with('Alert')->first();
	}

    public function store(SearchStore $request)
	{
        $user_id = \DB::select("SELECT * FROM users WHERE email='" . $request->email . "' LIMIT 1");
        $request['user_id'] = $user_id[0]->id;
        $create = function() use ($request){
			try{
				$search = Search::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }
}
