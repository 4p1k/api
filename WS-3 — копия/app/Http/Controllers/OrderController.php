<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Service\OrderService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;

use Symfony\Component\Finder\Exception\AccessDeniedException;

class OrderController extends Controller
{
    public const TOKEN_NAME='ApiToken';
    public function addOrder(OrderRequest $request, OrderService $service):JsonResponse
    {
      
        $order = $service->createFromRequest($request);
        return response()->json([
            'success'=>true,
            'message'=>'success',
            'token'=>$order->createToken(self::TOKEN_NAME)->plainTextToken
        ]);
    }

    public function showOrder(LoginRequest $request)
    {
    $this ->check_role($request);
        $order = Order::all(); 
        return response()->json([
            'Orders'=>$order
        ]);

        
      
    }
    public function check_role(LoginRequest $request)
    {
        // $user = $service->createFromRequest($request);
        $user = User::where('login',$request->get('login'))->first();
        // $user = auth();
       if(!$user || $user->login !== 'waiter'){
            throw new AccessDeniedException();
       }
    }
}
