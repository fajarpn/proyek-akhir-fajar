@extends('layout.v_template')
@section('title','Detail Siswa')
@section('content')
<table class="table">
    <tr>
        <th width="100px">NIS</th>
        <th width="30px">:</th>
        <th>{{ $siswa->nis }}</th>
    </tr>
    <tr>
        <th width="100px">Nama Siswa</th>
        <th width="30px">:</th>
        <th>{{ $siswa->nama_siswa }}</th>
    </tr>
    <tr>
        <th width="100px">Kelas Siswa</th>
        <th width="30px">:</th>
        <th>{{ $siswa->kelas_siswa }}</th>
    </tr>
    <tr>
        <th width="100px">Foto Siswa</th>
        <th width="30px">:</th>
        <th><img src="{{ url('foto_siswa/'.$siswa->foto_siswa) }}" width="200px"></th>
    </tr>
    <tr>
        <th><a href="/siswa" class="btn btn-success tbn-sm">Kembali</a></th>
    </tr>
</table>





@endsection
