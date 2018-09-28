<?php

namespace App\Http\Controllers;

use App\Http\ApiHelpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class ExampleController extends Controller
{
    protected $jwt;
    protected $const = "";

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->const = trans('apiResponse.login');
    }
    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required',
        ]);
        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }
        $Response = ResponseBuilder::result(
            true,
            $this->const['infoCode'],
            $this->const['infoMsg']
        );
        return response()->json($Response)->header('Auth-token', [compact('token')][0]['token']);
    }

    public function save()
    {
        DB::table('users')->insert(
            ['name' => 'anil', 'email' => 'web@mail.com', 'password' => Hash::make("sam1")]
        );
    }
    public function test()
    {
        $Response = ResponseBuilder::result(
            true,
            $this->const['infoCode'],
            "Test Api Done"
        );
        return response()->json($Response);

    }
    public function logout(Request $request)
    {
        app('translator')->setLocale("en");

        // $this->jwt->setToken("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwOCIsImlhdCI6MTUzODAzOTE1NiwiZXhwIjoxNTM4MDM5Mjc2LCJuYmYiOjE1MzgwMzkxNTYsImp0aSI6IlRUOHE4bGpaeE8wQVZMdmciLCJzdWIiOjYsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.eKnP2MjlZk4uqh0Jq_7-gXFQXK9G-77bDqpB33Oi6DI")->invalidate();
        $Response = ResponseBuilder::result(
            true,
            $this->const['infoCode'],
            "Test Api Done"
        );
        return response()->json($Response);
    }
}
