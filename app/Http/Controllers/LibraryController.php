<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $libraries = Library::where('name', 'LIKE', '%'.$request->search_library.'%')->orderBy('name', 'ASC')->simplePaginate(5); 
        return view('library.index',  compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('library.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'name' => 'required|max:100',
        'type' => 'required|min:3',
        'price' => 'required|numeric',
        'author' => 'required|max:100',
    ]);

    Library::create([
        'name' => $request->name,
        'type' => $request->type,
        'price' => $request->price,
        'author' => $request->author,
    ]);

    return redirect()->back()->with('success', 'Berhasil Menambah Data Buku!');
}

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
         $library = Library::where('id', $id)->first();
        // compact : kirim data ke view ($)
        return view('library.edit', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required|min:3',
            'price' => 'required|numeric',
            'author' => 'required|max:100'
        ], [
            'name.required' => 'Judul buku harus diisi!',
            'type.required' => 'Tipe buku harus diisi!',
            'price.required' => 'Harga buku harus diisi!',
            'author.required' => 'Penerbit buku harus diisi!',
            'name.max' => 'Judul buku maksimal 100 karakter!',
            'type.min' => 'Jenis buku minimal 3 karakter!',
            'price.numeric' => 'Harga buku harus berupa angka!',
        ]);

        $library = Library::where('id', $id)->first();
        $proses = $library->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'author' => $request->author,  
        ]);
        if($proses) {
            return redirect()->route('libraries.index')->with('success', 'Berhasil mengubah data buku!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data buku!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $proses = Library::where('id', $id)->delete();

        if ($proses) {
            return redirect()->back()->with('success','Berhasil mengahapus data buku!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data!');
        }
    }

    public function status($id) {
        $library = Library::findORFail($id);
        if ($library->status === 'pending') {
            $library->status = 'complete';
        } else {
            $library->status = 'pending';
        }
        $library->save();

        if($library) {
            return redirect()->route('libraries.index')->with('success', 'Berhasil mengubah status buku!');
        } else {
            return redirect()->route('libraries.index')->with('failed', 'Gagal mengubah status buku!');
        }
    }
    
}


