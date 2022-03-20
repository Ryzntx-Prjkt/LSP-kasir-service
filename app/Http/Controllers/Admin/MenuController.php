<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::all();
        return view('admin.menu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $menu = Menu::create([
            'nama_menu' => $data['nama_menu'],
            'harga' => $data['harga'],
        ]);

        if($request->hasFile('foto')){
            $path = $request->file('foto')->store('public/files/foto');
            $menu->foto = $path;
            $menu->save();
        }

        return redirect()->route('menu.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Menu::findOrFail($id);
        return view('admin.menu.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $menu = Menu::findOrFail($id);
        $menu->update([
            'nama_menu' => $data['nama_menu'],
            'harga' => $data['harga'],
        ]);

        if($request->hasFile('foto')){
            $path = $request->file('foto')->store('public/files/foto');
            $menu->foto = $path;
            $menu->save();
        }

        return redirect()->route('menu.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Menu::findOrFail($id);
        $data->delete();
        return redirect()->route('menu.index')->with('success', 'Data berhasil dihapus!');
    }
}
