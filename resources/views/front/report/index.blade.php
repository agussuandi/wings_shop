@extends('front.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Report Penjualan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $keyReport => $report)
                                <tr>
                                    <td>{{ $reports->firstItem() + $keyReport }}</td>
                                    <td>{{ $report->code }}</td>
                                    <td>{{ $report->trans_date }}</td>
                                    <td>{{ $report->total }}</td>
                                </tr>
                            @empty
                                <p colspan="4" class="text-center">Data Kosong</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $reports->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop
@section('javascript')
    
@endsection