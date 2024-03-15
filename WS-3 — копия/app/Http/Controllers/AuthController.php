<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Service\UserService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public const TOKEN_NAME= 'ApiToken';
    public function registration(RegistrationRequest $request, UserService $service):JsonResponse
    {
        $user = $service->createFromRequest($request);
        return response()->json([
            'success'=>true,
            'message'=>'success',
            'token'=>$user->createToken(self::TOKEN_NAME)->plainTextToken
        ]);
    }
    public function login(LoginRequest $request):JsonResponse
    {
        /** @var User $user */
        $users = User::where('login', $request->get('login'))->get();
        $found = false;
        foreach($users as $user){
            if($request->get('password')=== $user->password){
                $found = true;
                break;
            }
        }
        if(!$found){
            throw new UnauthorizedException();
        }
        

        return response()->json([
            'success'=>true,
            'message'=>'success',
            'token'=>$user->createToken(self::TOKEN_NAME)->plainTextToken
        ]);
    }


    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout'
        ]);
    }

}
