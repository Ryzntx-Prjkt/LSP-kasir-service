@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{route('member.create')}}" class="btn btn-success" >Tambah Data Member</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Data Member</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <div class="row">
                                            <h6>{{$item->name}}</h6>
                                            <p>{{$item->email}}</p>
                                        </div>
                                    </td>
                                    <td>{{$item->username}}</td>
                                    <td>
                                        <a href="{{route('member.show', $item->id)}}" class="btn btn-primary">Lihat</a>
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
