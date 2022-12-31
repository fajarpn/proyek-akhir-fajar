@extends('layout.v_template')
@section('title','User SMAN 10 Planet Mars')

@section('content')
<a href="/user/add" class="btn btn-primary btn-sm">Add</a> <br>

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
                <th>Nomor User</th>
                <th>Nama User</th>
                <th>Email User</th>
                <th>Foto User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($user as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nomor_user }}</td>
                    <td>{{ $data->nama_user}}</td>
                    <td>{{ $data->email_user}}</td>
                    <td><img src="{{ url('foto_user/'.$data->foto_user) }}" width="100px"></td>
                    <td>
                        <a href="/user/detail/{{ $data->id_user }}" class="btn btn-sm btn-success">Detail</a>
                        <a href="/user/edit/{{ $data->id_user }}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_user }}">
                            Delete
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@foreach ($user as $data)
    <div class="modal modal-danger fade" id="delete{{ $data->id_user }}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $data->nama_user }}</h4>
                </div>

                <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini ??</p>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="/user/delete/{{ $data->id_user }}" class="btn btn-outline">Yakin</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
