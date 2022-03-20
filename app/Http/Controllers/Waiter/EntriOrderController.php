<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class EntriOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $menu = Menu::all();
        $invoice = rand(1000000, 9999999);
        if($request->session()->has('cart'))
        {
            $cart = $request->session()->get('cart');
            $total_harga = 0;
            foreach ($cart as $cr => $item){
                $total_harga += $cart[$cr]['harga'];
            }
            return view('waiter.order.index', compact('menu', 'cart', 'total_harga', 'invoice'));
        }
        return view('waiter.order.index', compact('menu', 'invoice'));
    }

    public function menu_show($id){
        $data = Menu::findOrFail($id);
        return response()->json($data);
    }

    public function add_menu_to_cart(Request $request){
        $data = $request->all();
        $nama_menu = $data['nama_menu'];
        $qty = $data['qty'];
        $id_menu = $data['id_menu'];
        $harga = $data['harga'];
        $row_id = md5($nama_menu . serialize($qty));
        $data = [
            $row_id = [
                'id_menu' => $id_menu,
                'nama_menu' => $nama_menu,
                'qty' => $qty,
                'harga' => $harga,
                'row_id' => $row_id,
            ]
        ];

        if(!$request->session()->has('cart')){
            $request->session()->put('cart', $data);
        } else {
            $exist = 0;
            $cart = $request->session()->get('cart');

            foreach($cart as $cr => $carts){
                if($cart[$cr]['id_menu'] == $id_menu){
                    $cart[$cr]['qty'] += $qty;
                    $cart[$cr]['harga'] += $harga;
                    $exist++;
                }
            }

            if($exist == 0) {
                $newcart = array_merge_recursive($cart, $data);
                $request->session()->put('cart', $newcart);
                //dd($newcart);
            } else {
                // dd($cart);
                $request->session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('toast_success', 'Menu berhasil ditambahkan');
    }

    public function delete_menu_from_cart($row_id, Request $request){

        $newcart = $request->session()->get('cart');
        unset($newcart[$row_id]);

        if($newcart = []){
            $request->session()->forget('cart');
            return redirect()->back();
        } else {
            $request->session()->put('cart', $newcart);
        }

        return redirect()->back()->with('toast_success', 'Menu berhasil di hapus dari keranjang');

    }

    public function simpan_transaksi(Request $request){
        $id_user = auth()->user()->id;
        $invoice = $request->get('kode');
        $cart = $request->session()->get('cart');
        $total_harga = 0;
        $total_menu = count($cart);
            foreach ($cart as $cr => $item){
                $total_harga += $cart[$cr]['harga'];
                DetailTransaksi::create([
                    'id_menu' => $cart[$cr]['id_menu'],
                    'qty' => $cart[$cr]['qty'],
                    'harga' => $cart[$cr]['harga'],
                    'kode_pembayaran' => $invoice,
                ]);
            }
            Transaksi::create([
                'kode_pembayaran' => $invoice,
                'no_meja' => $request->get('no_meja'),
                'id_user' => $id_user,
                'total_bayar' => $total_harga,
                'jumlah_menu' => $total_menu,
                'sudah_dibayar' => '0',
            ]);
            $request->session()->forget('cart');
            return redirect()->back()->with('success', 'Data Order telah disimpan!');
    }

}
