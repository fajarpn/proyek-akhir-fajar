@extends('layout.v_template')
@section('title','Siswa SMAN 10 Planet Mars')

@section('content')
<a href="/siswa/add" class="btn btn-primary btn-sm">Add</a> <br>

@if (session('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Sukses</h4>
        {{ session('pesan') }}.
    </div>
@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas Siswa</th>
                <th>Foto Siswa</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($siswa as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->nama_siswa}}</td>
                    <td>{{ $data->kelas_siswa}}</td>
                    <td><img src="{{ url('foto_siswa/'.$data->foto_siswa) }}" width="100px"></td>
                    <td>
                        <a href="/siswa/detail/{{ $data->id_siswa }}" class="btn btn-sm btn-success">Detail</a>
                        <a href="/siswa/edit/{{ $data->id_siswa }}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_siswa }}">
                            Delete
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@foreach ($siswa as $data)
    <div class="modal modal-danger fade" id="delete{{ $data->id_siswa }}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $data->nama_siswa }}</h4>
                </div>

                <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini ??</p>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="/siswa/delete/{{ $data->id_siswa }}" class="btn btn-outline">Yakin</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
