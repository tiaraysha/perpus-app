@extends('layouts.layout')

@section('content')

<form action="{{ route('libraries.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
    @csrf
    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label">Judul Buku: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="type" class="col-sm-2 col-form-label">Jenis Buku: </label>
    <div class="col-sm-10">
        <select class="form-select" name="type" id="type">
            <option selected disabled hidden>Pilih</option>
            <option value="pembelajaran" {{ old('type') == 'pembelajaran' ? 'selected' : '' }}>Pembelajaran</option>
            <option value="novel" {{ old('type') == 'novel' ? 'selected' : '' }}>Novel</option>
            <option value="ensiklopedi" {{ old('type') == 'ensiklopedi' ? 'selected' : '' }}>Ensiklopedia</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="price" class="col-sm-2 col-form-label">Penulis: </label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
    </div>
</div>
</div>
    </div>
</div>
<div class="mb-3 row">
    <label for="stock" class="col-sm-2 col-form-label">Harga Buku: </label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
    </div>
</div>
<button type="submit" name="btn" class="btn btn-primary mt-3">Kirim</button>
</form>
    
@endsection
