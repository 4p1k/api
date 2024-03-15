<?php 
namespace App\Http\Service;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
class OrderService{
    public function createFromRequest(OrderRequest $request):Order
    {
        $order = new Order();
        $order->desk=$request->get('desk');
        $order->waiter=$request->get('waiter');
        $order->status=$request->get('status');
        $order->price=$request->get('price');
        $order->save();
        return $order;
    }

}