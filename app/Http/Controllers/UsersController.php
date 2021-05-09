<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;


class UsersController extends Controller
{
	public $status = 200;

    public function index()
    {
        return response()->json(User::users()->get());
    }

    public function store(UserStore $request)
    {
        $create = function() use ($request){
			try{
				$user = User::create($request->all());
				return 'Se ha creado correctamente';
			}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($create), 'status' => $this->status], $this->status);
    }

    public function showLogged($email)
    {
        $user = User::where('email', $email)->select('id', 'name', 'image', 'email')->first();
        return $user;
    }

    public function userImage($path){
        return response()->file("UserImages/".$path);
    }

    public function update(UserUpdate $request, User $user)
    {
        $update = function() use ($request, $user){
			try{
                $user->fill($request->all());
                if($image = $request->file('image')){
                    $image_name = "derkk117_".date("Y_m_d_H_i_s").".".$image->extension();
        
                    $image->move("UserImages",$image_name);
                    $user->image = $image_name;
                }
				$user->save();
				return 'Se ha actualizado correctamente';
    		}catch(\Exception $e){
				dd($e);
				$this->status = 500;
				return 'Hubo un error al registrar, intentelo nuevamente';
			}
		};
	    return response()->json(['message' => \DB::transaction($update), 'status' => $this->status], $this->status);
    }
}
