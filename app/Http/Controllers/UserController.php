<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(Request $request) //fungsinya untuk mengambil isian dari input
    {   
        $users = User::where('name', 'LIKE', '%'.$request->search_user.'%')->orderBy('name', 'ASC')->simplePaginate(5); 
        return view('users.index', compact('users')); //compact itu mengirim data dri controller. users sama dgn nama variabel
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required ',
            'email' => 'required',
            'password' => 'nullable|min:8'
        ], [
            'name.required' => 'Nama pengguna harus diisi!',
            'type.required' => 'Tipe pengguna harus diisi!',
            'email.required' => 'Nama email harus diisi!',
            'name.max' => 'Nama obat maksimal 100 karakter!',
            'type.min' => 'Tipe obat minimal 2 karakter!',
            'email.max' => 'Nama email maksimal 100 karakter!',
        ]);

        User::create([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambah Data Pengguna!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = User::where('id', $id)->first();
        return view('users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'email' => 'required|string|email|unique:users,email,' . $id,
        ], [
            'name.required' => 'Nama pengguna harus diisi!',
            'type.required' => 'Tipe pengguna harus diisi!',
            'email.required' => 'Nama email harus diisi!',
            'name.max' => 'Nama maksimal 100 karakter!',
            'email.max' => 'Email maksimal 100 karakter!',
        ]);
        
        // Ambil data user sebelumnya berdasarkan ID
        $userBefore = User::where('id', $id)->first();
        
        // Update data user termasuk email
        $proses = $userBefore->update([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'password' => bcrypt ($request->password), // tambahkan email ke sini
        ]);
        
        if ($proses) {
            return redirect()->route('users.index')->with('success', 'Berhasil mengubah data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $proses = User::where('id', $id)->delete();

        if ($proses) {
            return redirect()->back()->with('success','Berhasil mengahapus data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus!');
        }
    }
    
    public function showLogin() {
        return view('pages.login');
    }
    

    public function login(Request $request) {
        // ini cara cepet biar ga usah validate, buat dlu variabel nya
        // var credential hanya meminta email dan password
        $credential = $request->only('email', 'password');

        // auth attempt -> untuk cek
        if(Auth::attempt($credential)) {
            return redirect()->route('home')->with('success', 'Berhasil Login');
        } else {
            return redirect()->back()->with('failed', 'Gagal Login');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

}
