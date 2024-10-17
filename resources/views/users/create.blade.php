@extends('layouts.layout')

@section('content')

<form action="{{ route('users.store')}}" method="POST" class="card p-5">
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
    <div class="container">
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="stock" class="col-sm-2 col-form-label">Email: </label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Tipe Pengguna: </label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disabled hidden>Pilih</option>
                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pengguna" {{ old('type') == 'pengguna' ? 'selected' : '' }}>Reader</option>
            </select>
        </div>
    </div>
</div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>

@endsection