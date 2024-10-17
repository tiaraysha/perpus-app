@extends('layouts.layout')

@section('content')

<form action="{{ route('libraries.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="container">
    {{-- Session::get mengambil pesan pada return redirect bagian with pada controller --}}
    @if (Session::get('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::get('failed'))
    <div class="alert alert-danger">{{Session::get('failed')}}</div>
    @endif

    <div class="d-flex justify-content-end my-3">
        <form action="{{ route('libraries.index' )}}" method="GET">
            <div class="d-flex">
                <input type="text" name="search_library" class="form-control" placeholder="Cari nama buku . . .">
                <button class="btn btn-success ms-2" type="submit">Cari</button>
            </div>
        </form>
    </div>
<table class="table table-bordered table-stripped text-center" >
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Jenis Buku</th>
            <th>Harga Buku</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if(count($libraries) < 1)
        <tr>
            <td colspan="6" class="text-center">Data Kosong</td>
        </tr>
        @else
        @foreach ($libraries as $index => $item)
            <tr>
                {{--ini biar per page nya no nya berurut--}}
                <td>{{ ($libraries->currentPage()-1) * ($libraries->perPage()) + ($index+1) }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['author'] }}</td>               
                <td>{{ $item['type'] }}</td>
                <td>Rp. {{  number_format($item['price'], 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                    @else 
                    <span class="badge bg-success">Selesai dibaca</span>
                    @endif
                </td>
                <td>
                    <form action="{{route('libraries.status', $item['id'])}}" method="POST" style="display:inline">
                        @csrf
                        @method('PATCH')
                        @if ($item->status === 'pending')
                        <button type="submit" class="btn btn-success" class="btn btn-success me-2">Selesai</button>
                        @else
                        <button type="submit" class="btn btn-warning" class="btn btn-warning me-2">Pending</button>
                        @endif
                    </form>
                    <a href="{{route('libraries.edit', $item['id'])}}"id="name_library" class="btn btn-primary me-2">Edit</a>
                    <form action="{{ route('libraries.delete', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
</form>

<div class="d-flex justify-content-end">
    {{-- links() : memunculkan button pagination--}}
    {{ $libraries->links()}}
</div>

@endsection

@push('script')
<script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    function showModalDelete(id, name) {
        //memunculkan nama obat dari $item->name button yang di klik agar nama obatnya muncul di modal bagian id="name_medicine"
        $('#name_library').text(name);
        //memunculkan modal yg id nya id = exampleModal
        $('#exampleModal').modal('show');
        //mengisi action pada form sesuai id yg di klik
        //  :id mengacu pada {id} di web.php
        let url = "{{route ('libraries.delete', ':id')}}";
        // mengisi :id dengan parameter id
        url = url.replace(':id', id);
        // mengisi atribut action pd form
        $('form').attr('action', url);

    }
</script>
    
@endpush
