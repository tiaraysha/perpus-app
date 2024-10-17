@extends('layouts.layout')

@section('content')
    <div class="jumbotron py-4 px-5 bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="container text-center">
            <h1 class="display-4 text-primary mb-4">
                Happy Reading!
            </h1>
            <div class="row justify-content-center align-items-center" style="max-width: 600px; margin: 0 auto;">
                <div class="col-12 col-md-6 text-center mb-4">
                    <img src="assets/book.jpg" class="img-fluid rounded shadow" alt="Book Image" style="max-width: 100%; height: auto;">
                </div>
                <div class="col-12 col-md-6">
                    <p class="lead text-center">Perpus App adalah platform digital yang memungkinkan pengguna untuk mencari, membaca, dan mengelola informasi tentang berbagai jenis buku. Melalui website ini, pengguna dapat menelusuri katalog buku yang tersedia, baik itu buku fiksi, novel, ensiklopedi, atau buku belajar.</p>
                    <p class="lead text-center">Selain itu, website ini juga menyediakan fitur untuk menambah, mengedit, atau menghapus data buku, yang cocok untuk perpustakaan atau toko buku yang ingin mengelola inventaris buku mereka secara lebih efisien.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
