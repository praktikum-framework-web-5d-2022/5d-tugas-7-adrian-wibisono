@extends('navbar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen | Create</title>
</head>
<body>
<div class="container pt-4 bg-white">
        <div class="row">
            <div class="col-md-8">
                <h2>Dosen Data</h2>
                <p>Masukkan data dengan lengkap</p>
               @if (session()->has('message'))
               <div class="my-3">
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            </div> 
            
               @endif 
                <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="nim" placeholder="Input NIS" id="nim"  value="{{ old('nim')}}"
                        class="form-control">
                        <label for="nis">NIM</label>
                        @error('nim')
                        <div class="text-danger">
                        {{ $message }}    
                        </div> 
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="nama" placeholder="Input Nama" id="nama" 
                        class="form-control" value="{{ old('nama') }}">
                        <label for="nama">Nama</label>
                        @error('nama')
                        <div class="text-danger">
                        {{ $message }}    
                        </div> 
                        @enderror
                    </div>
                    

                <div class="form-floating mb-3  ">
                    <select name="prodi" placeholder="Input Prodi" id="prodi" class="form-select">
                        <option value="Informatika" {{ old('prodi') == "Informatika" ? "selected" : "" }}>Informatika</option>
                        <option value="Informasi" {{ old('prodi') == "Informasi" ? "selected" : "" }}>Informasi</option>
                    </select>
                    <label for="prodi">Select Prodi</label>
                    @error('prodi')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="matkul_id" class="form-label">matkul</label>
                <div class="form-group">
                    @foreach ($matkuls as $matkul)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="matkul_id[]" id="{{ $matkul->id }}" value="{{ $matkul->id }}" {{ $matkul->dosen()->find($matkul->id) ? '' : '' }}>
                        <label for="{{ $matkul->id }}" class="form-check-label">{{ $matkul->nama }}</label>
                    </div>
                        
                    @endforeach
                </div>
            </div>
                
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection