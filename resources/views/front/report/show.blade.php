@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Report Penjualan {{ $report->code }}
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Code</td>
                            <td>{{ $report->code }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ $report->total }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>{{ $report->trans_date }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Currency</th>
                                <th>Discount</th>
                                <th>Dimension</th>
                                <th>Unit</th>
                                <th>Thumbnail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($report->trxDetail as $keyReport => $detail)
                                <tr>
                                    <td>{!! "{$detail->product->code} <br/> {$detail->product->name}" !!}</td>
                                    <td>{{ $detail->price }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ $detail->product->currency }}</td>
                                    <td>{{ $detail->product->discount }}</td>
                                    <td>{{ $detail->product->dimension }}</td>
                                    <td>{{ $detail->product->unit }}</td>
                                    <td>
                                        <a href="{{ url($detail->product->thumbnail) }}" target="_blank">
                                            <img src="{{ url($detail->product->thumbnail) }}" alt="{{ $detail->product->name }}" class="img-thumbnail" style="width: 100px; height: 100px;" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <p colspan="8" class="text-center">Data Kosong</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    
@endsection