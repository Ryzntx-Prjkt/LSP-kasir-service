@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6>Detail Menu</h6>
            </div>
            <div class="card-body">
                <img src="{{Storage::url($data->foto)}}" alt="" width="20%">
                <div class="form-group">
                    <label for="" class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu" id="" class="form-control" readonly value="{{$data->nama_menu}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Harga Menu</label>
                    <input type="number" name="harga" id="" class="form-control" readonly value="{{$data->harga}}">
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-1">
                        <a href="{{route('menu.edit', $data->id)}}" class="btn btn-warning">Edit</a>
                    </div>
                    <form action="{{route('menu.destroy', $data->id)}}" method="post" class="col-1">
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
