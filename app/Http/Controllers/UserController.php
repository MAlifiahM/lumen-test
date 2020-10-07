<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $response = [];
        try {
            if (!empty($request->with)){
                $user = User::with($request->with)->get();
            }else {
                $user = User::all();
            }
            $response["status"] = "success";
            $response["data"]["get"] = $user;
    
        }catch(Exception $e) {
            $response["status"] = "error";
            $response["message"] = "relationship not found";
        }
        return $response;
    }

    public function view(Request $request, string $user)
    {
        $response = [];
        try {
            $user = User::where('fullname', $user)->orWhere('id', $user)->orWhere('email', $user)->first();
            
            $response["status"] = "success";
            $response["data"]["get"] = $user;
    
        }catch(Exception $e) {
            $response["status"] = "error";
            $response["message"] = "data not found";
        }
        return $response;
    }
}
