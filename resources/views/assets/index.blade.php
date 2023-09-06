@extends('layout.layout')

@section('judul','Data Barang')
@section('isi')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Tutorial Laravel 10 untuk Pemula</h3>
                <h5 class="text-center"><a href="https://santrikoding.com">www.santrikoding.com</a></h5>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('assets.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col"> GAMBAR BARANG</th>
                            <th scope="col">NAMA BARANG</th>
                            <th scope="col">DESKIRPSI</th>
                            <th scope="col">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($assets as $asset)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/assets/'.$asset->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td>{{ $asset->nama_barang }}</td>
                                <td>{!! $asset->deskripsi !!}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('assets.destroy', $asset->id) }}" method="POST">
                                        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Post belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>
                      {{ $assets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
