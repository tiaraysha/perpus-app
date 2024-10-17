@extends('layouts.layout')

@section('content')
    <form action="{{route('libraries.edit', $library['id'])}}" method="POST" class="card p-5">
        @csrf
        {{-- action ke patch, mengirim {id} --}}
        @method('PATCH')
        @if (Session::get('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        <div class="form-group">
            <label for="name" class="form-label">Judul Buku:</label>
            <input type="text" name="name" id="name" value="{{$library['name']}}" class="form-control">
            @error('name')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="author" class="form-label">Penerbit: </label>
            <input type="text" name="author" id="author" value="{{ old('author', $library->author) }}" class="form-control">
            @error('author')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Jenis Buku: </label>
            <select name="type" id="type" class="form-select">
                <option selected disabled hidden>Pilih</option>
                <option value="pembelajaran" {{ old('type') == 'pembelajaran' ? 'selected' : '' }}>Pembelajaran</option>
                <option value="novel" {{ old('type') == 'novel' ? 'selected' : '' }}>Novel</option>
                <option value="ensiklopedi" {{ old('type') == 'ensiklopedi' ? 'selected' : '' }}>Ensiklopedia</option>
            </select>
            @error('type')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Harga Buku: </label>
            <input type="number" name="price" id="price" value="{{$library['price']}}" class="form-control">
            @error('price')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg my-3">Ubah Data</button>
    </form>
@endsection