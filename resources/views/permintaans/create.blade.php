@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah Data Pengajuan</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('permintaans.index') }}"> Back</a>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Ada masalah dengan inputan anda.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('permintaans.store') }}" method="POST">
    @csrf


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Pengajuan:</strong>
                <input type="text" name="tanggal_pengajuan" class="form-control" placeholder="2023-11-22">
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Mesin:</strong>
                <input type="text" name="nama_mesin" class="form-control" placeholder="Nama Mesin">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga Sekarang:</strong>
                <input type="text" name="harga" class="form-control" placeholder="1000000">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga Ajuan:</strong>
                <input type="text" name="harga_baru" class="form-control" placeholder="1000000">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


</form>

@endsection