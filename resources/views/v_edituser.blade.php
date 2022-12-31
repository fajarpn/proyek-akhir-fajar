@extends('layout.v_template')
@section('title','Edit User')

@section('content')

<form action="/user/update/{{ $user->id_user }}" method="POST" enctype="multipart/form-data">
    @csrf 

<div class="content">
    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label>Nomor User</label>
                <input name="nomor_user" class="form-control"  value="{{ $user->nomor_user }}" readonly>
                <div class="text-danger">
                    @error('nomor_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Nama User</label>
                <input name="nama_user" class="form-control" value="{{ $user->nama_user }}">
                <div class="text-danger">
                    @error('nama_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Email User</label>
                <input name="email_user" class="form-control" value="{{ $user->email_user }}">
                <div class="text-danger">
                    @error('email_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="col-sm-4">
                    <img src="{{ url('foto_user/'.$user->foto_user) }}" width="100px">
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Ganti Foto User</label>
                        <input type="file" name="foto_user" class="form-control" value="{{ old('foto_user') }}">
                        <div class="text-danger">
                            @error('foto_user')
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
                <th><a href="/user" class="btn btn-success tbn-sm">Kembali</a></th>
            </tr>
        </div>
    </div>
</div>
    </div>
</form>

@endsection
