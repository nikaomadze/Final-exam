<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Components\CartComponent\Cart;
use App\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cartComponent;

    /**
     * CartController constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cartComponent = $cart;
    }

    /**
     * @return View
     */
    public function show()
    {
        $order = null;
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        }

        return view('cart', compact('order'));
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function add($productId)
    {
        $productId = (int)$productId;
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        $this->cartComponent->addProduct($order, $productId);

        return redirect()->route('cart');
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function clear($productId)
    {
        $productId = (int)$productId;
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
            $this->cartComponent->clearProduct($order, $productId);
        }

        return redirect()->route('cart');
    }

    /**
     * @param $productId
     * @return RedirectResponse
     */
    public function remove($productId)
    {
        $productId = (int)$productId;
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
            $this->cartComponent->removeProduct($order, $productId);
        }

        return redirect()->route('cart');
    }
}