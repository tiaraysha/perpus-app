<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href=""><i class="bi bi-book"></i>Perpus App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
     <i class="bi bi-house"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="/"><i class="bi bi-house"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link {{ Route::is('libraries.create') }}" href="{{ Route('libraries.create') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="bi bi-plus-square"></i> Tambah Buku</a>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('libraries.index') }}"><i class="bi bi-journal-bookmark-fill"></i> Data Buku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('users.index')}}"><i class="bi bi-person"></i> Kelola Akun</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
</body>
</html>