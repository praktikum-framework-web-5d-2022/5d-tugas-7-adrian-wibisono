@extends('navbar')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @error(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data gagal diubah, silahkan cek kembali form yang anda isi!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

        <div class="card p-4">
            <h3 class="fw-bold">Matkul Data</h3>
            <div class="card-body">
                <div class="tambahdata mb-3 d-flex justify-content-end">
                    <a href="{{ route('matkul.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto" style="width: 400px">
                        <form action="{{route('matkul.index') }}" method="GET">
                            <input type="search" id="search" name="search" placeholder="Search Nama" class="form-control" aria-describedby="passwordHelpInline">
                        </form>
                    </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr  class="align-middle" style="text-align: center">
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Id</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkuls as $matkul)
                            <tr class="align-middle" @if($loop->odd)  style="background-color: #f1f3f5; text-align: center"  @endif>
                                <td class="align-middle" style="text-align: center">{{ $loop->iteration + $matkuls->firstItem() - 1 }}</td>
                                <td class="align-middle" style="text-align: center">{{ $matkul->nama }}</td>
                            
                                <td>
                                    @forelse ($matkul->dosens as $item)
                                        <ul class="align-middle text-center">
                                          {{ $item->nama }}
                                        </ul>
                                        @empty
                                        <div class="text-danger" class="align-middle" style="text-align: center"> Tidak Ada Data Dosen </div>
                                        @endforelse
                                  
                                </td>
                                <td>
                                    @forelse ($matkul->dosens as $item)
                                    <ul class="align-middle text-center">
                                        {{ $item->prodi }}
                                      </ul>
                                      @empty
                                      <div class="text-danger" class="align-middle" style="text-align: center"> Tidak Ada Data Dosen </div>
                                      @endforelse
                                  
                                </td>
                                <td class="align-middle" style="text-align: center">
                            <a href="{{ route('matkul.edit',['matkul' => $matkul->id]) }}" class="btn btn-warning">Edit</a>
                            {{--  <a href="{{ route('item.destroy',['item' => $item->id]) }}" class="btn btn-danger">Delete</a>  --}}
                            <form action="{{ route('matkul.destroy',['matkul'=>$matkul->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">
                                    Delete
                                </button>
                            </form>
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-start sm">
                        Showing
                        {{ $matkuls->firstItem() }}
                        to
                        {{ $matkuls->lastItem() }}
                        of
                        {{ $matkuls->total() }}
                        entries
                    </div>
                    <div class="paginate d-flex justify-content-center sm">
                    {{ $matkuls->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection