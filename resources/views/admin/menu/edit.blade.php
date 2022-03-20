@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Edit Data Menu</h6>
        </div>
        <form action="{{route('menu.update', $data->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu" id="" class="form-control" required value="{{$data->nama_menu}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Harga Menu</label>
                    <input type="number" name="harga" id="" class="form-control" required value="{{$data->harga}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Foto Menu</label>
                    <input type="file" name="foto" id="" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Perbarui Data!</button>
            </div>
        </form>
    </div>
</div>
@endsection
