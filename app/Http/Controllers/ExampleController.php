<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
/**
    
     * @var \Tymon\JWTAuth\JWTAuth
     */
     protected $jwt;
     
         public function __construct(JWTAuth $jwt)
         {
             $this->jwt = $jwt;
         }
     
         public function postLogin(Request $request)
         {
             $this->validate($request, [
                 'email'    => 'required|max:255',
                 'password' => 'required',
             ]);
     
             try {
     
                 if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                     return response()->json(['user_not_found'], 404);
                 }
     
             } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
     
                 return response()->json(['token_expired'], 500);
     
             } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
     
                 return response()->json(['token_invalid'], 500);
     
             } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
     
                 return response()->json(['token_absent' => $e->getMessage()], 500);
     
             }
     
             return response()->json(compact('token'));
         }

         public function save()
         {
          
            DB::table('users')->insert(
                ['name'=>'anil','email' => 'web@mail.com', 'password' => Hash::make("sam1")]
            );
         }

         public function test()
         {
          echo "inside controller";
           
         }
    
}



