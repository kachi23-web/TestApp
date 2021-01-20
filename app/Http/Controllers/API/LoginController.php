<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends BaseController
{
    //
    /**

     * Login api

     *

     * @return \Illuminate\Http\Response

     */

    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 

            $success['token'] =  $user->createToken('MyApp')-> accessToken; 

            $success['name'] =  $user->name;

   

            return $this->sendResponse($success, 'User login successfully.');

        } 

        else{ 

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

        } 

    }


}
