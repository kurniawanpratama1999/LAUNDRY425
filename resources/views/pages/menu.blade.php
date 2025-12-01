@extends('layout')

@section('title', 'Menu')

@section('content')
    <div class="container-fluid">
        <x-modal title="{{ isset($menu) ? 'Update Data Menu' : 'Tambah Data Menu' }}">
            <form  method="POST" action="{{ isset($menu) ? route('menu.update', $menu->id) : route('menu.store') }}">
                @csrf
                @if (isset($menu))
                    @method('PUT')
                @endif

                <div class="col-12">
                    <x-form-input idprop="icon" labelprop="Icon" :model="$menu ?? null" typeprop="text" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="name" labelprop="Name Menu" :model="$menu ?? null" typeprop="text" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="master" labelprop="Master" :model="$menu ?? null" typeprop="text" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="link" labelprop="Link" :model="$menu ?? null" typeprop="text" />
                </div>

                <div class="card-footer mt-3 bg-transparent">

                    @if (isset($menu))
                        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif

                    <button type="submit" class="btn {{ isset($menu) ? 'btn-primary' : 'btn-success' }}">
                        {{ isset($menu) ? 'Perbaharui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </x-modal>

        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari menu">
                    </label>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Tambah Menu</button>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Master</th>
                                    <th>Link</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $key => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{ route('menu.show', $item->id) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ $key + 1 }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->icon }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->master }}</td>
                                        <td>{{ $item->link }}</td>
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

@if (isset($menu))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('menu.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
