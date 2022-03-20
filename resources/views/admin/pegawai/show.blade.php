@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{route('pegawai.index')}}" class="btn btn-primary">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h6>Detail Akun Pegawai</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="" class="form-control" readonly required value="{{$data->name}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" id="" class="form-control" readonly required
                    value="{{$data->username}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control" readonly required value="{{$data->email}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Role</label>
                <input type="text" name="role" id="" class="form-control" readonly required value="{{$data->role}}">
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-1 mr-0">
                    <a href="{{route('pegawai.edit', $data->id)}}" class=" btn btn-warning">Edit</a>
                </div>
                <form action="{{route('pegawai.destroy', $data->id)}}" method="post" class="col-1">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Yakin untuk hapus data ini?')">Hapus</button>
                </form>
            </div>
            {{-- <a href="{{route('pegawai.destroy', $data->id)}}" class="btn btn-danger">Hapus</a> --}}
        </div>
    </div>
</div>
@endsection
