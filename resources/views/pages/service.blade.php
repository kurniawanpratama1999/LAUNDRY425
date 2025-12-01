@extends('layout')

@section('title', 'Service')

@section('content')
    <div class="container-fluid">
        <x-modal title="{{ isset($service) ? 'Update Data Service' : 'Tambah Data Service' }}">
            <form class="row row-gap-3" method="POST"
                action="{{ isset($service) ? route('service.update', $service->id) : route('service.store') }}">
                @csrf
                @if (isset($service))
                    @method('PUT')
                @endif
                <div class="col-12">
                    <x-form-input idprop="name" labelprop="Nama" :model="$service ?? null" typeprop="text" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="price" labelprop="Harga" :model="$service ?? null" typeprop="text" />
                </div>

                <div class="col-12">
                    <x-form-textarea idprop="description" labelprop="Deskripsi" :model="$service ?? null" />
                </div>

                <div class="card-footer mt-3 bg-transparent">

                    @if (isset($service))
                        <a href="{{ route('service.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif

                    <button type="submit" class="btn mx-2 {{ isset($service) ? 'btn-primary' : 'btn-success' }}">
                        {{ isset($service) ? 'Perbaharui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </x-modal>

        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari service">
                    </label>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Tambah Service</button>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{ route('service.show', $item->id) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ $key + 1 }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-outline-danger">
                                                    <i class="bi bi-eraser"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    note
                </div>
            </div>
        </div>
    </div>
@endsection

@pushOnce('headscripts')
@endPushOnce

@if (isset($service))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('service.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
