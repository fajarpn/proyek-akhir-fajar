@extends('layout.v_template')
@section('title','Add User')

@section('content')

<form action="/user/insert" method="POST" enctype="multipart/form-data">
    @csrf 

<div class="content">
    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label>Nomor User</label>
                <input name="nomor_user" class="form-control"  value="{{ old('nomor_user') }}">
                <div class="text-danger">
                    @error('nomor_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Nama User</label>
                <input name="nama_user" class="form-control" value="{{ old('nama_user') }}">
                <div class="text-danger">
                    @error('nama_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Email User</label>
                <input name="email_user" class="form-control" value="{{ old('email_user') }}">
                <div class="text-danger">
                    @error('email_user')
                       {{ $message }}
                    @enderror
                </div>    
            </div>

            <div class="form-group">
                <label>Foto User</label>
                <input type="file" name="foto_user" class="form-control" value="{{ old('foto_user') }}">
                <div class="text-danger">
                    @error('foto_user')
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
