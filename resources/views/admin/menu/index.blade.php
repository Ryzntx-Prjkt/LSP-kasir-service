@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{route('menu.create')}}" class="btn btn-success">Tambah Data Menu</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Data Menu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>
                                        <h6>{{$item->nama_menu}}</h6>
                                    </th>
                                    <th>{{$item->harga}}</th>
                                    <th>
                                        <a href="{{route('menu.show', $item->id)}}" class="btn btn-primary">Lihat</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
