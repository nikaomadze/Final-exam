<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getTotalPrice()
    {
        $totalPrice = $this->price;
        if (!is_null($this->pivot)) {
            $totalPrice = $this->price * $this->pivot->count;
        }

        return $totalPrice;
    }

    public function getShortDescription()
    {
        return mb_substr($this->description, 0, 100) . '...';
    }
}