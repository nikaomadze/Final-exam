<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Components\ShippingComponent\Shipping;
use App\Http\Requests\ShippingRequest;
use App\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShippingController extends Controller
{
    /**
     * @var Shipping
     */
    private $shippingComponent;

    /**
     * @param Shipping $shipping
     */
    public function __construct(Shipping $shipping)
    {
        $this->shippingComponent = $shipping;
    }

    /**
     * @return View|RedirectResponse
     */
    public function form()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            session()->flash('warning', 'You dont have an order!');
            return redirect()->route('index');
        }
        if (Order::find($orderId)->getFullPrice() === 0) {
            session()->flash('warning', 'Your order is empty!');
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        return view('shipping', compact('order'));
    }

    /**
     * @param ShippingRequest $request
     * @return RedirectResponse
     */
    public function send(ShippingRequest $request): RedirectResponse
    {
        $this->shippingComponent->send($request);

        return redirect()->route('index');
    }
}