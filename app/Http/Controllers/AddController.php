<?php

namespace App\Http\Controllers;

use App\Models\Add;
use Illuminate\Http\Request;
use App\Models\Library;

class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $libraries = Library::where('name', 'LIKE', '%'.$request->search_library.'%')->orderBy('name', 'ASC')->simplePaginate(5);
        return view('home', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('add.add');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:100',
        'author' => 'required|max:100',
        'file' => 'required|image|mimes:jpg,jpeg,png|max:2048', // pastikan aturan validasi file benar
    ], [
        'file.required' => 'Gambar harus diupload!',
        'file.image' => 'File harus berupa gambar!',
        'file.mimes' => 'Format gambar harus jpg, jpeg, atau png!',
        'file.max' => 'Ukuran gambar maksimal 2MB!',
    ]);

    // Upload file jika ada
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('images', 'public');
    }

    // Simpan data ke database
    Add::create([
        'name' => $request->name,
        'author' => $request->author,
        'image' => $path ?? null, // Pastikan path tersimpan di kolom 'image'
    ]);

    return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
}

    

    /**
     * Display the specified resource.
     */
    public function show(Add $add)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Add $add)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Add $add)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Add $add)
    {
        //
    }
}
