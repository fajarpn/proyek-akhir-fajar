@extends('layout.v_template')
@section('title','Edit Siswa')

@section('content')

<form action="/siswa/update/{{ $siswa->id_siswa }}" method="POST" enctype="multipart/form-data">
    @csrf 

<div class="content">
    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label>NIS</label>
                <input name="nis" class="form-control"  value="{{ $siswa->nis }}" readonly>
                <div class="text-danger">
                    @error('nis')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Nama Siswa</label>
                <input name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}">
                <div class="text-danger">
                    @error('nama_siswa')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Kelas Siswa</label>
                <input name="kelas_siswa" class="form-control" value="{{ $siswa->kelas_siswa }}">
                <div class="text-danger">
                    @error('kelas_siswa')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="col-sm-4">
                    <img src="{{ url('foto_siswa/'.$siswa->foto_siswa) }}" width="100px">
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Ganti Foto Siswa</label>
                        <input type="file" name="foto_siswa" class="form-control" value="{{ old('foto_siswa') }}">
                        <div class="text-danger">
                            @error('foto_siswa')
                                     {{ $message }}
                            @enderror
                        </div>    
                    </div>
                </div>
            </div>
            <br>

            <div class="col-sm-12">
                <div class="form-group">
                <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>

            <tr>
                <th><a href="/guru" class="btn btn-success tbn-sm">Kembali</a></th>
            </tr>
        </div>
    </div>
</div>
    </div>
</form>

@endsection
