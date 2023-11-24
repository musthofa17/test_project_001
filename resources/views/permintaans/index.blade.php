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
        <th style="text-align:right">Harga Sekarang</th>
        <th style="text-align:right">Harga Pengajuan</th>
        <th width="20%" style="text-align:center">Action</th>
    </tr>
    @foreach ($permintaans as $permintaan)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permintaan->tanggal_pengajuan }}</td>
        <td>{{ $permintaan->nama_mesin }}</td>
        <td style="text-align:right">{{ number_format($permintaan->harga,2) }}</td>
        <td style="text-align:right">{{ number_format($permintaan->harga_baru,2) }}</td>
        <td style="text-align:center">
            @can('permintaan-edit')
            <a class="btn btn-primary" href="{{ route('permintaans.edit',$permintaan->id) }}">Edit</a>
            @endcan
            @can('permintaan-delete')
            <a href="{{ route('permintaans.destroy',$permintaan->id) }}" class="btn btn-danger"
                data-confirm-delete="true">Hapus</a>
            @endcan
            @can('approved-btn')
            <a href="{{ route('permintaans.approval',$permintaan->id) }}"
                class="btn btn-success btn-edit-post">Approval</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $permintaans->links() !!}

@endsection
@push('stack')

@endpush