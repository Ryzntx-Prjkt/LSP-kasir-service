@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6>Laporan Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Pembayaran</th>
                                <th>No Meja</th>
                                <th>Pemasukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kode_pembayaran}}</td>
                                    <td>{{$item->no_meja}}</td>
                                    <td>{{$item->total_bayar}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
