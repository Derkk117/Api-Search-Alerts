<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use App\Http\Requests\AlertStore;
use App\Http\Requests\AlertUpdate;

class AlertsController extends Controller
{
    public $status = 200;

    public function store(AlertStore $request)
    {
        $create = function() use ($request){
			try{
				$alert = Alert::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

	public function update(AlertUpdate $request, $search)
	{
		$alert = Alert::where("search_id", $search)->first();
	    $create = function() use ($request, $alert){
			try{
				$alert->fill($request->all());
				$alert->save();
				return 'Se ha actualizado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al actualizar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);	
	}

    public function show($search)
    {
		return Alert::where('search_id', $search)->with('SearchInstances')->first();		
	}

	public function getAlertId($search)
	{
		return Alert::select("id as sku")->where("search_id", $search)->first()['sku'];
	}
}
