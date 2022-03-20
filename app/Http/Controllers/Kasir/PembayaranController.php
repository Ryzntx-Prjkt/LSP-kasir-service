<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Transaksi::where('sudah_dibayar', '=', '0')->get();
        return view('kasir.pembayaran.index', compact('data'));
    }

    public function show($id)
    {
        $data = Transaksi::findOrFail($id);
        return view('kasir.pembayaran.show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'sudah_dibayar' => '1'
        ]);
        return redirect()->route('pembayaran.index')->with('success', 'Data Transaksi berhasil di update');
    }
}
