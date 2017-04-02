<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Helpers\Response;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login(Request $request) {
    	$email = $request->email;
    	$password = $request->password;
    	// $validator = Validator::make($request->all(), [
     //        'email' => 'required|email|max:255',
     //        'password' => 'required|min:6',
     //    ]);
  //   	if ($validator->fails()) {
  //   		$errors = $validator->errors();
		//     return FillError::Validation($errors);
		// }
		$user = User::where('email','=',$email)
				->with('roles')
				->first();
		if ($user == null || !Hash::check($password,$user->password)) {
			return Response::responseWithError('Tên đăng nhập hoặc password không đúng',421);
		}
		$user->remember_token = Carbon::now()->addHours(24)->toDateTimeString();
		$user->api_token = bcrypt($user->email.$user->remember_token);
		$user->save();
		return response($user)->cookie(
            'api_token', $user->api_token, 120
        );
    }
	public function logout(Request $request) {
		$user = User::find($request->auth_user_id);
		$user->remember_token = Carbon::now()->subSeconds(1)->toDateTimeString();
		$user->save();
	}
    public function register(Request $request) {
    	$data = $request->all();
    	$validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
            'role_code' => 'required'
        ]);
    	if ($validator->fails()) {
    		$errors = $validator->errors();
		    return Response::response($errors,421);
		}
		$user = $this->create($data);
		$role = Role::where('code',$request->role_code)->first();
		$user->roles()->attach($role->id);
    	return $user;
    }
    public function create($data){
    	$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => bcrypt($data['email'])
        ]);
    	return $user;
    }
}
