@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Tambah Data Member</h6>
        </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="" class="form-control" readonly value="{{$data->name}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" id="" class="form-control" readonly value="{{$data->username}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" id="" class="form-control" readonly value="{{$data->email}}">
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-1 mr-0">
                        <a href="{{route('member.edit', $data->id)}}" class=" btn btn-warning">Edit</a>
                    </div>
                    <form action="{{route('member.destroy', $data->id)}}" method="post" class="col-1">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin untuk hapus data ini?')">Hapus</button>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
