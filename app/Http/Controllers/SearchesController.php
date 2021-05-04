<?php

namespace App\Http\Controllers;

use App\User;
use App\Search;
use Illuminate\Http\Request;
use App\Http\Requests\SearchStore;

class SearchesController extends Controller
{    
    public $status = 200;

	public function index(){
		return response()->json(Search::searches()->get());
	}

	public function recentSearches(User $user){
		return response()->json(Search::recentSearches($user)->get());
	}

    public function store(SearchStore $request){
        $user_id = \DB::select("SELECT * FROM users WHERE email='" . $request->email . "' LIMIT 1");
        $request['user_id'] = $user_id[0]->id;
        $create = function() use ($request){
			try{
				$user = Search::create($request->all());
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
