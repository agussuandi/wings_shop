@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Selamat Belanja!
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($products as $keyProduct => $product)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ url($product->thumbnail) }}" class="card-img-top alt="product" loading="lazy" />
                            <div class="card-body">
                                <p class="mb-1">{{ $product->name }}</p>
                                <p class="card-text">Rp. {{ number_format($product->price, 0,",",".") }}</p>
                                <a href="{{ route('cart.store') }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('buy-form-{{ $product->id }}').submit();" class="btn btn-danger btn-sm">
                                    <span>Buy</span>
                                    <form id="buy-form-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" value="{{ Crypt::encryptString($product->id) }}" name="id" readonly />
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-dark">Barang Kosong</p>
                @endforelse
            </div>
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop
@section('javascript')
    
@endsection