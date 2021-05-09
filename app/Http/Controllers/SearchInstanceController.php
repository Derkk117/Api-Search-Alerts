<?php

namespace App\Http\Controllers;

use App\SearchInstance;
use Illuminate\Http\Request;
use App\Http\Requests\SearchInstanceStore;
use App\Http\Requests\SearchInstanceUpdate;

class SearchInstanceController extends Controller
{
    public $status = 200;

    public function store(SearchInstanceStore $request)
    {
        $create = function() use ($request){
			try{
				$searchInstance = SearchInstance::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				return $e;
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

	public function update(SearchInstanceUpdate $request, SearchInstance $searchInstance)
	{
		$create = function() use ($request, $searchInstance){
			try{
				$searchInstance->update($request->all());
				return 'Se ha actualizado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al actualizar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
	}
}
