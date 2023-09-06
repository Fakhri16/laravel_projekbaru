@extends('layout.layout')
@section('judul','show data')

@section('isi')
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('storage/assets/'.$asset->image) }}" class="w-100 rounded">
                        <hr>
                        <h4>{{ $asset->nama_barang }}</h4>
                        <p class="tmt-3">
                            {!! $asset->deskripsi !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
