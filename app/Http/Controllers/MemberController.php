<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
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
        $data = User::where('role', '=', 'pelanggan')->get();
        return view('member.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
        $validator = Validator::make($data, [
            'email' => "required|email|unique:users,email|string",
            'name' => "required|string|max:255",
            'password' => "required|min:8|confirmed|string",
            'username' => "required|string|unique:users,username|max:255",
        ]);

        if($validator->fails()){
            return back()->with('toast_error', $validator->errors()->all())->withInput();
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => 'pelanggan',
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('member.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('member.edit', compact('data'));
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
        $user = User::findOrFail($id);
        $validator = Validator::make($data, [
            'email' => "required|email|string",
            'name' => "required|string|max:255",
            // 'password' => "required|min:8|confirmed|string",
            'username' => "required|string|max:255",
        ]);

        if($validator->fails()){
            return back()->with('toast_error', $validator->errors()->all())->withInput();
        }

        if($request->filled('password')){
            $validator = Validator::make($data, [
                'password' => "required|min:8|confirmed|string",
            ]);

            if($validator->fails()){
                return back()->with('toast_error', $validator->errors()->all())->withInput();
            }

            $user->update([
                'password' => Hash::make($data['password']),
            ]);

        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => 'pelanggan',
        ]);

        return redirect()->route('member.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('member.index')->with('success', 'Data berhasil dihapus');
    }
}
