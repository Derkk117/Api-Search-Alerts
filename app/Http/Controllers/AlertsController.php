<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use App\Http\Requests\AlertStore;

class AlertsController extends Controller
{
    public $status = 200;

    public function store(AlertStore $request)
    {
        $create = function() use ($request){
			try{
				$user = Alert::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function show(Alert $alert)
    {
        return $alert;
    }
}
