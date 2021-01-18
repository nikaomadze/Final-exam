<?php

declare(strict_types=1);

namespace App\Components\CartComponent;

use App\Order;

class Cart
{
    /**
     * @param Order $order
     * @param int $productId
     */
    public function addProduct(Order $order, int $productId)
    {
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }
    }

    /**
     * @param Order $order
     * @param int $productId
     */
    public function clearProduct(Order $order, int $productId)
    {
        if ($order->products->contains($productId)) {
            $order->products()->detach($productId);
        }
    }

    /**
     * @param Order $order
     * @param int $productId
     */
    public function removeProduct(Order $order, int $productId)
    {
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count === 1) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }
}