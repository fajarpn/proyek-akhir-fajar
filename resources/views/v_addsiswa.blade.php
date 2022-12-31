@extends('layout.v_template')
@section('title','Add siswa')

@section('content')

<form action="/siswa/insert" method="POST" enctype="multipart/form-data">
    @csrf

<div class="content">
    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label>NIS</label>
                <input name="nis" class="form-control" value="{{ old('nis') }}">
                <div class="text-danger">
                    @error('nis')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Nama Siswa</label>
                <input name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}">
                <div class="text-danger">
                    @error('nama_siswa')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Kelas Siswa</label>
                <input name="kelas_siswa" class="form-control" value="{{ old('kelas_siswa') }}">
                <div class="text-danger">
                    @error('kelas_siswa')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Foto Siswa</label>
                <input type="file" name="foto_siswa" class="form-control" value="{{ old('foto_siswa') }}">
                <div class="text-danger">
                    @error('foto_siswa')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </div>
</div>
    </div>
</form>



@endsection
