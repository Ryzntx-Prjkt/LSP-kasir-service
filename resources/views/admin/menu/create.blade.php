@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Tambah Data Menu</h6>
        </div>
        <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Harga Menu</label>
                    <input type="number" name="harga" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Foto Menu</label>
                    <input type="file" name="foto" id="" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
