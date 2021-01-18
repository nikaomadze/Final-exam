@extends('master')
@section('content')
    <div class="shipping">
        <div class="shipping-form">
            <h2>Place Order</h2>
            <form action="{{ route('shipping-send') }}" method="POST">
                @csrf
                <div class="shipping-form-item">
                    <label for="name">Name</label>
                    @error('name')
                    <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-item" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                </div>
                <div class="shipping-form-item">
                    <label for="address">Address</label>
                    @error('address')
                    <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-item" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                </div>
                <div class="shipping-form-item">
                    <label for="phone">Phone</label>
                    @error('phone')
                    <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-item" id="phone" name="phone" placeholder="80999999999" value="{{ old('phone') }}">
                </div>
                <div class="shipping-form-item">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                    <input type="email" class="form-item" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
                </div>
                <div class="shipping-form-item">
                    <label for="options">Shipping options</label>
                    @if($order->getFullPrice() > 300)
                        <select class="form-item" id="option" name="shipping_option">
                            <option value="0">Free express shipping</option>
                        </select>
                    @else

                        <select class="form-item" id="option" name="shipping_option">
                            <option data-value="0" value="Free shipping">Free shipping</option>
                            <option data-value="9.99" value="Express shipping">Express shipping 9.99$</option>
                            <option data-value="19.99" value="Courier shipping">Courier shipping 19.99$</option>
                        </select>
                    @endif
                </div>
                <h3>Total order amount: <span data-total-price="">{{ $order->getFullPrice() }}</span>$</h3>
                <button class="button button-buy" type="submit">Checkout</button>
            </form>
        </div>
    </div>
@endsection
<script src="/js/shop.js"></script>