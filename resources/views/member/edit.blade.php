@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Tambah Data Member</h6>
        </div>
        <form action="{{route('member.update', $data->id)}}" method="post">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="" class="form-control" required value="{{$data->name}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" id="" class="form-control" required value="{{$data->username}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" id="" class="form-control" required value="{{$data->email}}">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Sandi</label>
                            <input type="password" name="password" id="" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Konfirmasi Sandi</label>
                            <input type="password" name="password_confirmation" id="" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Perbarui Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
