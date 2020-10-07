<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SecureController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
	}
	public function profile(Request $request)
	{
		$response = [];
		if(!empty($request->header('Authorization'))){
			$token = $request->header('Authorization');
			$token = explode(" ", $token);
			$user = User::where('token', $token[1])->first();
			
			$response['status'] = 'success';
			$response['data']['get'] = $user;
		}else {
			$response['status'] = 'error';
			$response['message'] = 'Unauthorized.';	
		}
		return $response;
	}
}