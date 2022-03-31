@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Products
        </div>
        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Currency</th>
                            <th>Discount</th>
                            <th>Dimension</th>
                            <th>Unit</th>
                            <th>Thumbnail</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $keyProducts => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $keyProducts }}</td>
                                <td>{!! "{$product->code} <br/> {$product->name}" !!}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->currency }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->dimension }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    <a href="{{ url($product->thumbnail) }}" target="_blank">
                                        <img src="{{ url($product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;" />
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', Crypt::encryptString($product->id)) }}" class="btn btn-primary btn-sm">Detail</a>

                                    <a href="{{ route('products.destroy', Crypt::encryptString($product->id)) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();" class="btn btn-danger btn-sm">
                                        <span>Delete</span>
                                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', Crypt::encryptString($product->id)) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                    <a href="{{ route('products.edit', Crypt::encryptString($product->id)) }}" class="btn btn-info btn-sm">Update</a>
                                </td>
                            </tr>
                        @empty   
                            <tr>
                                <td colspan="9" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop
@section('javascript')
    
@endsection