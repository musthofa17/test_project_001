@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Daftar Pengajuan</h2>
        </div>
        <div class="pull-right">
            @can('permintaan-create')
            <a class="btn btn-success" href="{{ route('permintaans.create') }}"> Tambah Pengajuan</a>
            @endcan
        </div>
    </div>
</div>

</br>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal Pengajuan</th>
        <th>Nama Mesin</th>
        <th>Harga Sekarang</th>
        <th>Harga Pengajuan</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($permintaans as $permintaan)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permintaan->tanggal_pengajuan }}</td>
        <td>{{ $permintaan->nama_mesin }}</td>
        <td>{{ $permintaan->harga }}</td>
        <td>{{ $permintaan->harga_baru }}</td>
        <td>
            @can('permintaan-edit')
            <a class="btn btn-primary" href="{{ route('permintaans.edit',$permintaan->id) }}">Edit</a>
            @endcan
            @can('permintaan-delete')
            <a href="{{ route('permintaans.destroy',$permintaan->id) }}" class="btn btn-danger"
                data-confirm-delete="true">Hapus</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $permintaans->links() !!}

@endsection