@extends('layout.v_template')
@section('title','Detail User')
@section('content')
<table class="table">
    <tr>
        <th width="100px">Nomor User</th>
        <th width="30px">:</th>
        <th>{{ $user->nomor_user }}</th>
    </tr>
    <tr>
        <th width="100px">Nama User</th>
        <th width="30px">:</th>
        <th>{{ $user->nama_user }}</th>
    </tr>
    <tr>
        <th width="100px">Email User</th>
        <th width="30px">:</th>
        <th>{{ $user->email_user }}</th>
    </tr>
    <tr>
        <th width="100px">Foto User</th>
        <th width="30px">:</th>
        <th><img src="{{ url('foto_user/'.$user->foto_user) }}" width="200px"></th>
    </tr>
    <tr>
        <th><a href="/user" class="btn btn-success tbn-sm">Kembali</a></th>
    </tr>
</table>





@endsection
