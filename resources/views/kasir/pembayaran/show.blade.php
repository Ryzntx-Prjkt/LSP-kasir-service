@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6>Detail Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Kode Pembayaran</label>
                    <input type="text" name="" id="" class="form-control" value="{{$data->kode_pembayaran}}">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Nomor Meja</label>
                    <input type="number" name="" id="" class="form-control" value="{{$data->no_meja}}">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" data-bs-target="#pembayaranModal" data-bs-toggle="modal" >Bayar!</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pembayaranModalLabel">Bayar</h5>
                        </div>
                        <form action="{{ route('pembayaran.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="form-label">Kode Pembayaran</label>
                                    <input type="text" name="kode" id="" class="form-control" value="{{ $data->kode_pembayaran }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Total Yang harus dibayar</label>
                                    <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="{{$data->total_bayar}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Uang yang diterima</label>
                                    <input type="number" name="uang_diterima" id="uang_diterima" class="form-control" >
                                </div>
                                <h4 id="kembalian">Kembalian:  </h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#uang_diterima').change(function () {
            var total = $('#total_bayar').val();
            var uang = $("#uang_diterima").val();
            var hasil = uang - total;
            $('#kembalian').html('Kembalian: ' + hasil);
        });
        });
    </script>
@endpush
