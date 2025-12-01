@extends('layout')

@section('title', 'Customer')

@section('content')

    <div class="container-fluid">
        <x-modal title="{{ isset($customer) ? 'Update Data Customer' : 'Tambah Data Customer' }}">
            <form method="POST"
                action="{{ isset($customer) ? route('customer.update', $customer->id) : route('customer.store') }}">
                @csrf
                @if (isset($customer))
                    @method('PUT')
                @endif

                <div class="col-12">
                    <x-form-input idprop="name" labelprop="Nama" :model="$customer ?? null" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="phone" labelprop="Nomor Hp" :model="$customer ?? null" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="address" labelprop="Alamat" :model="$customer ?? null" />
                </div>

                <div class="card-footer mt-3 bg-transparent">

                    @if (isset($customer))
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif

                    <button type="submit" class="btn {{ isset($customer) ? 'btn-primary' : 'btn-success' }}">
                        {{ isset($customer) ? 'Perbaharui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </x-modal>

        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control"
                            placeholder="cari customer">
                    </label>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Tambah Customer</button>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Nama</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Dibuat Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{ route('customer.show', $item->id) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ $key + 1 }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
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

@if (isset($customer))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('customer.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
