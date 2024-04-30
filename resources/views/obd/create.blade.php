@extends('layouts.admin.master')

@section('title')Tambah OBD
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>OBD</h3>
@endslot
<li class="breadcrumb-item active"><a href="{{ route('obd') }}">OBD</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Form Tambah OBD</h5>
                </div>
                <form class="form theme-form" method="POST" action="{{ route('obd.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal ! </strong>
                                {{ session('error') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="">Merk</label>
                                    <input class="form-control @error('merk') is-invalid @enderror" type="text"
                                        name="merk" autocomplete="off" value="{{ old('merk') }}" />

                                    @error('merk')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="">Tipe</label>
                                    <input class="form-control @error('type') is-invalid @enderror" type="text"
                                        name="type" autocomplete="off" value="{{ old('type') }}" />

                                    @error('type')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="">Serial Number</label>
                                    <input class="form-control @error('serial_number') is-invalid @enderror" type="text"
                                        name="serial_number" autocomplete="off" value="{{ old('serial_number') }}" />

                                    @error('serial_number')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="">Foto OBD</label>
                                    <input class="form-control @error('foto') is-invalid @enderror" type="file"
                                        width="48" height="48" name="foto" />

                                    @error('foto')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                        {{-- <button class="btn btn-light" href="{{ route('surveilance-car') }}"
                            type="button">Kembali</button> --}}
                        <a href="{{ route('obd') }}" class="btn btn-light">Kembali</a>
                        {{-- <input class="btn btn-light" type="button" value="Cancel" /> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endpush

@endsection