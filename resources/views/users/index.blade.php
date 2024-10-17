@extends('layouts.layout')

@section('content')

    <div class="container">
        {{-- Session::get mengambil pesan pada return redirect bagian with pada controller --}}
        @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (Session::get('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif

        <div class="d-flex justify-content-end my-3">
            <form action="{{ route('users.index' )}}" method="GET">
                {{--Form pencarian:
                1. Input ada name: untuk mengambil data di controller
                2. Button type nya submit
                3. Form ada action dan method
                    - GET : untuk mencari
                    - POST : menambah, mengubah, menghapus
                    - action: untuk cari arahkan ke route yg sama dengan blade nya. Bbukan untuk mencari arahkan ke route post, patch, delete
                --}}
                <div class="d-flex">
                    <a class="btn btn-success ms-2" type="submit" href="{{route('users.create')}}">Tambah Pengguna</a>
                </div>
            </form>
        </div>
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data Kosong</td>
                    </tr>
                @else
                    @foreach ($users as $index => $item)
                        <tr>
                            {{--ini biar per page nya no nya berurut--}}
                            <td>{{ ($users->currentPage()-1) * ($users->perPage()) + ($index+1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td class="d-flex">
                                <a href="{{route('users.edit', $item['id'])}}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('users.delete', $item['id']) }}" method="POST" style="display:inline">
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
        <div class="d-flex justify-content-end">
            {{-- links() : memunculkan button pagination--}}
            {{ $users->links()}}
        </div>
@endsection

{{-- mengisi stack di layout --}}
@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function showModalDelete(id, name) {
        //memunculkan nama obat dari $item->name button yang di klik agar nama obatnya muncul di modal bagian id="name_medicine"
        $('#name_user').text(name);
        //memunculkan modal yg id nya id = exampleModal
        $('#exampleModal').modal('show');
        //mengisi action pada form sesuai id yg di klik
        //  :id mengacu pada {id} di web.php
        let url = "{{route ('users.delete', ':id')}}";
        // mengisi :id dengan parameter id
        url = url.replace(':id', id);
        // mengisi atribut action pd form
        $('form').attr('action', url);

    }


    @if (Session::get('failed'))
    $(document).ready(function(){
        let id = "{{Session::get('stock_id')}}";
        let stock = "{{Session::get('stock')}}";
        showModalStock(id, stock);
    })
    @endif
</script>

{{-- jika terdapat error yg berhubungan dengan stock atau ada with failed yg terdeteksi, panggil func showModalStockFailed diatas --}}
@endpush