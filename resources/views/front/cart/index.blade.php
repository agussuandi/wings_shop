@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Selamat Belanja!
        </div>
        <div class="card-body">
            <div class="row">
                @php $total = 0 @endphp
                @forelse ($carts as $keyCart => $cart)
                    @php $total += $cart['price'] * $cart['quantity'] @endphp
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ url($cart['thumbnail']) }}" class="card-img-top alt="product" loading="lazy" />
                            <div class="card-body">
                                <h4>{{ $cart['name'] }} </h4>
                                <p class="card-text mb-1">
                                    <strong>Price Product Rp. {{ number_format($cart['price'], 0,",",".") }} </strong>
                                </p>
                                <p class="mb-1">
                                    <strong>Quantity : {{ $cart['quantity'] }}</strong>
                                </p>
                                <p class="mb-1">
                                    <strong>Total : Rp. {{ number_format(($cart['price'] * $cart['quantity']), 0,",",".") }}</strong>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('cart.destroy', Crypt::encryptString($keyCart)) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('remove-cart-{{ $keyCart }}').submit();" class="btn btn-danger btn-sm">
                                    <span>Remove</span>
                                    <form id="remove-cart-{{ $keyCart }}" action="{{ route('cart.destroy', Crypt::encryptString($keyCart)) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-dark">Barang Kosong</p>
                @endforelse
                <div class="mt-2">
                    <h3>Total : Rp. {{ number_format($total, 0,",",".") }}</h3>
                </div>
            </div>
        </div>
        @if (sizeof($carts) > 0)
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}" readonly />
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Checkout</button>
                </div>
            </form>
        @endif
    </div>
@stop
@section('javascript')
    
@endsection