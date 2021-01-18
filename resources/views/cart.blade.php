@extends('master')

@section('title', 'Cart')

@section('content')
    <h1>Cart</h1>
    <div class="cart">
    @isset($order)
        @foreach($order->products as $product)
            <div class="cart-item">
                <div class="cart-item-left">
                    <div class="cart-image cart-item-p">
                        <img class="cart-image-item" src="{{ $product->image }}">
                    </div>
                    <div class="cart-about cart-item-p">
                        <div class="cart-title">
                            {{ $product->name }}
                        </div>
                        <div class="cart-description">
                            {{ $product->getShortDescription() }}
                        </div>
                    </div>
                </div>
                <div class="cart-item-right">
                    <div class="cart-counter cart-item-p">
                        <form action="{{ route('cart-remove', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button-minus">-</button>
                        </form>
                        <span class="cart-item-count">{{ $product->pivot->count }}</span>
                        <form action="{{ route('cart-add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button-minus">+</button>
                        </form>
                        <form action="{{ route('cart-clear', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button-trash">
                                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     width="24px" height="24px">
                                    <path d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5
                                 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 C 5.9453899
                                 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671
                                 18.431641 21.431641 C 18.808671 21.05461 19 20.522222 19 20 L 19 5
                                 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 20 L
                                 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L
                                 15 7 L 13 7 z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="cart-item-price cart-item-p">{{ $product->getTotalPrice() }}$</div>
                </div>
            </div>
        @endforeach
        <div class="cart-total">
            Total order amount: <span class="cart-total-price">{{ $order->getFullPrice() }}$</span>
        </div>
        <div class="cart-button">
            <a class="button button-buy" href="{{ route('shipping') }}">Buy</a>
        </div>
    @endisset
    </div>
@endsection