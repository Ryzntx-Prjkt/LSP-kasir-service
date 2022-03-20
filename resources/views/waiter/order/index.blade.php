@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h6>Daftar Menu</h6>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($menu as $item)
                        <div class="col">
                            <div class="card">
                                <img src="{{Storage::url($item->foto)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->nama_menu}}</h5>
                                    <p class="card-text">{{ "Rp " . number_format($item->harga, 2, ",", "."); }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="" class="btn btn-primary" id="keranjang-modal"
                                        data-attr="{{ url('show-menu/' . $item->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Tambahkan</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h6>Daftar Keranjang</h6>
                </div>
                <form action="{{route('insert-order')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="" class="form-label">Kode Pembayaran</label>
                            <input type="text" name="kode" id="" class="form-control" value="{{$invoice}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nomor Meja</label>
                            <input type="number" name="no_meja" id="" min="1" class="form-control"
                                value="{{old('no_meja')}}" required>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Menu</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($cart))

                                    @foreach ($cart as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['nama_menu'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>{{ $item['harga'] }}</td>

                                        <td>
                                            <a href="{{ route('delete-menu', $item['row_id']) }}"
                                                class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        @if (session()->has('cart'))
                        <div class="row justify-content-between">
                            @if (isset($cart))
                            <div class="col-4">
                                Jumlah: {{ count($cart) }}
                            </div>
                            <div class="col-5">

                                Total harga: {{ $total_harga }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan data order ini?')" >Simpan Data Order</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Item Keranjang</h5>
            </div>
            <form action="{{route('insert-menu')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="id_menu" id="id_menu" hidden>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Menu</label>
                        <input type="text" name="nama_menu" id="nama" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="1">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambahkan ke keranjang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    $(document).ready(function () {
        var harga;

        $('#uang_diterima').change(function () {
            var total = $('#total_bayar').val();
            var uang = $("#uang_diterima").val();
            var hasil = uang - total;
            $('#kembalian').html('Kembalian: ' + hasil);
        });

        $('body').on('click', '#button_transaksi', function (event) {
            event.preventDefault();
            var pelanggan = $('#nama_pelanggan').val();
            $('#pelanggan_di').val(pelanggan);
        });

        $('body').on('click', '#keranjang-modal', function (event) {
            event.preventDefault();
            let hrefs = $(this).attr('data-attr');
            axios.get(hrefs)
                .then(function (response) {
                    harga = response.data.harga;
                    $('#nama').val(response.data.nama_menu);
                    $('#harga').val(harga);
                    $('#id_menu').val(response.data.id);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('#qty').change(function () {
            $hasil = harga * $('#qty').val();
            $('#harga').val($hasil);
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#exampleModal').modal('hide');
            $('#qty').val('1');
            $('#harga').val('0');
        });
    });

</script>
@endpush
