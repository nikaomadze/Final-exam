<?php

declare(strict_types=1);

namespace App\Components\ShippingComponent;

use App\Http\Requests\ShippingRequest;
use App\Order;

class Shipping
{
    /**
     * @param ShippingRequest $request
     * @return void
     */
    public function send(ShippingRequest $request): void
    {
        $result = false;
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::find($orderId);
            $result = $order->saveOrder(
                $request->name,
                $request->address,
                $request->phone,
                $request->email,
                $request->shipping_option
            );
        }

        if ($result) {
            session()->flash('success', 'Your order has been shipped!');
        } else {
            session()->flash('warning', 'Something went wrong!');
        }
    }
}