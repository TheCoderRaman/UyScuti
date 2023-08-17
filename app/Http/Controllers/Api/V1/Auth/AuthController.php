<?php

namespace App\Http\Controllers\Api\V1\Auth;

use JWTAuth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utility\Api\ApiCodes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login','refresh','register'
            ]
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = auth()->user();

        $user = [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at
        ];

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($user)->build()
        );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $update = [];
        $data = $request->all();
        $user = User::where('email',
            auth()->user()->email
        )->first();

        if($user->name != $data['name']){
            $validated = Validator::make($data, [
                'name' => 'required|string|between:2,100',
            ])->validate();

            $update['name'] = $validated['name'];
            $update['avatar'] = (Avatar::create(
                $validated['name'])->toBase64()
            );
        }

        if($user->email != $data['email']){
            $validated = Validator::make($data, [
                'email' => 'required|string|email|max:100|unique:users',
            ])->validate();

            $update['email'] = $validated['email'];
        }

        if(!empty($data['password'])){
            $validated = Validator::make($data, [
                'password' => 'required|string|confirmed|min:6',
            ])->validate();

            $update['password'] = bcrypt($validated['password']);
        }

        if($user->update($update)){
            $user = [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'created_at' => $user->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::CREATED)->withData($user)->build()
        );
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ])->validate();

        if (!$token = auth()->attempt($data)) {
            return ResponseBuilder::error(ApiCodes::UNAUTHORIZED);
        }

        $token = [
            'token_type' => 'bearer',
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];

        $user = auth()->user();

        $token['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at
        ];

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($token)->build()
        );
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|string|email|max:100|unique:users',
        ])->validate();

        $user = User::create(array_merge($data,
            [
                'password' => bcrypt($request->password),
                'avatar' => Avatar::create($data['name'])->toBase64(),
            ]
        ));

        if($user){
            $user = [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'created_at' => $user->created_at
            ];
        } else {
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::CREATED)->withData($user)->build()
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Session::flush();
        
        //auth()->logout();

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withMessage(
                Lang::get('auth.signed_out')
            )->build()
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = [
            'token_type' => 'bearer',
            'access_token' => auth()->refresh(),
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];

        $user = auth()->user();

        $token['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'updated_at' => $user->updated_at,
            'created_at' => $user->created_at
        ];

        return (ResponseBuilder::asSuccess()
            ->withHttpCode(ApiCodes::ACCEPTED)->withData($token)->build()
        );
    }
}
