<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getFullPrice()
    {
        $result = 0;
        foreach ($this->products as $product) {
            $result += $product->getTotalPrice();
        };

        return $result;
    }

    public function saveOrder($name, $address, $phone, $email, $shipping_option)
    {
        $result = false;

        if ($this->status == 0) {
            $this->status = 1;
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->email = $email;
            $this->shipping_option = $shipping_option;
            $this->save();
            session()->forget('orderId');
            $result = true;
        }

        return $result;
    }
}