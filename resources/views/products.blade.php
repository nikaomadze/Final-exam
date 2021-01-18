<div class="product">
    <div class="product-item">
        <img src="{{ $product->image }}" alt="Камера GoPro">
        <div class="product-description">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} $</p>
            <p>
            <form action="{{ route('cart-add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="button" role="button">Add to cart</button>          </form>
            </p>
        </div>
    </div>
</div>