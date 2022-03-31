@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Update Products {{ $product->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', Crypt::encryptString($product->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required autocomplete="off" autofocus maxlength="50" value="{{ $product->name }}" />
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required autocomplete="off" maxlength="6" value="{{ $product->price }}" />
                    </div>
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="currency" name="currency" required autocomplete="off" maxlength="5" value="{{ $product->currency }}" />
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="discount" name="discount" required autocomplete="off" maxlength="3" value="{{ $product->discount }}" />
                    </div>
                    <div class="mb-3">
                        <label for="dimension" class="form-label">Dimension</label>
                        <input type="text" class="form-control" id="dimension" name="dimension" required autocomplete="off" maxlength="50" value="{{ $product->dimension }}" />
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" required autocomplete="off" maxlength="5" value="{{ $product->unit }}" />
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" />
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Current Photo</label>
                        <br />
                        <a href="{{ url($product->thumbnail) }}" target="_blank">
                            <img src="{{ url($product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;" />
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products') }}" class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('javascript')
    
@endsection