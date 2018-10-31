<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use App\User;
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
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        try {

            // $user = User::where('email', '=', 'sam@mail.com')->first();

            // if (!$token = $this->jwt->fromUser($user)) {
            //     return response()->json(['user_not_found'], 404);
            // }
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
            ["id" => "1b7161ea8542462dbf21db4ca9e66288",
                'name' => 'sam',
                'email' => 'sam@mail.com',
                'password' => Hash::make("sam1"),
            ]
        );
    }

    public function test()
    {

        $token = $this->jwt->getToken();
        $this->jwt->user();
        $data = $this->jwt->setToken($token)->toUser();
        print_r($data);
        // echo "inside controller";

    }

}
