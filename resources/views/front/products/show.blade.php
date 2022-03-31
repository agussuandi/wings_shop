@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Products {{ $product->name }}
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" disabled value="{{ $product->name }}" />
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" disabled value="{{ $product->price }}" />
                </div>
                <div class="mb-3">
                    <label for="currency" class="form-label">Currency</label>
                    <input type="text" class="form-control" id="currency" name="currency" disabled value="{{ $product->currency }}" />
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" disabled value="{{ $product->discount }}" />
                </div>
                <div class="mb-3">
                    <label for="dimension" class="form-label">Dimension</label>
                    <input type="text" class="form-control" id="dimension" name="dimension" disabled value="{{ $product->dimension }}" />
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" disabled value="{{ $product->unit }}" />
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Photo</label>
                    <br />
                    <a href="{{ url($product->thumbnail) }}" target="_blank">
                        <img src="{{ url($product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;" />
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('products') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    
@endsection