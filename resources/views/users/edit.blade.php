@extends('layouts.layout')

@section('content')
    <form action="{{route('users.edit', $users['id'])}}" method="POST" class="card p-5">
        @csrf
        {{-- action ke patch, mengirim {id} --}}
        @method('PATCH')
        @if (Session::get('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        <div class="form-group">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" name="name" id="name" value="{{$users['name']}}" class="form-control">
            @error('name')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" id="email" value="{{ old('email', $users->email) }}" class="form-control">
            @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Tipe Pengguna: </label>
            <select name="type" id="type" class="form-select">
                <option selected disabled hidden>Pilih</option>
                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pengguna" {{ old('type') == 'pengguna' ? 'selected' : '' }}>Reader</option>
            </select>
            @error('type')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Ubah Password: </label>
            <input type="password" name="password" id="password" value="{{$users['password']}}" class="form-control">
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-lg my-3">Ubah Data</button>
    </form>
@endsection