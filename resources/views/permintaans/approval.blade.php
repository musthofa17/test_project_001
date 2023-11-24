@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Form Approval</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('permintaans.index') }}"> Back</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="#" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="row col-xs-12 col-sm-12 col-md-12">
            <label for="email" class="col-md-4 col-form-label text-md-end">Tanggal Pengajuan</label>
            <div class="col-md-6">
                <input id="tanggal_pengajuan" type="date"
                    class="form-control @error('tanggal_pengajuan') is-invalid @enderror" name="tanggal_pengajuan"
                    value="{{ $permintaan->tanggal_pengajuan }}" class="form-control" disabled>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama Mesin:</strong>
            <input type="text" name="nama_mesin" value="{{ $permintaan->nama_mesin }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Harga Sekarang:</strong>
            <input type="text" name="harga" value="{{ number_format($permintaan->harga,2) }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Harga Pengajuan:</strong>
            <input type="text" name="harga_baru" value="{{ number_format($permintaan->harga_baru,2) }}"
                class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Persetujuan:</strong>
            <input type="radio" name="harga_baru" value="{{ number_format($permintaan->harga_baru,2) }}"
                class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>

</form>

@endsection