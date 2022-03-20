@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6>Data Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Pembayaran</th>
                                <th>Nomor Meja</th>
                                <th>Jumlah Menu</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kode_pembayaran}}</td>
                                    <td>{{$item->no_meja}}</td>
                                    <td>{{$item->jumlah_menu}}</td>
                                    <td>{{$item->total_bayar}}</td>
                                    <td>
                                        <a href="{{route('pembayaran.show', $item->id)}}" class="btn btn-primary">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
