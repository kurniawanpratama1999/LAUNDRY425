@extends('layout')

@section('user', 'Login')

@section('content')
    <div class="container-fluid">
        <x-modal title="{{ isset($user) ? 'Update Data User' : 'Tambah Data User' }}">
            <form method="POST" class="row row-gap-3"
                action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="col-lg-6 col-12">
                    <x-form-input idprop="name" labelprop="Nama" :model="$user ?? null" typeprop="text" />
                </div>

                <div class="col-lg-6 col-12">
                    <x-form-select idprop="level_id" labelprop="Level" :model="$user ?? null" :options="$levels" />
                </div>

                <div class="col-12">
                    <x-form-input idprop="email" labelprop="Email" :model="$user ?? null" typeprop="email" />
                </div>


                @if (isset($user))
                    <div class="col-12 text-center">
                        <button class="badge border-0 text-black fst-italic bg-transparent" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                            Ganti Password ?
                        </button>
                    </div>
                    <div class="collapse row g-0" id="collapseExample">
                        <div class="col-lg-6 col-12 px-2">
                            <x-form-input idprop="password" labelprop="Password" typeprop="password" />
                        </div>

                        <div class="col-lg-6 col-12 px-2">
                            <x-form-input idprop="password_confirmation" labelprop="Password Confirmation"
                                typeprop="password" />
                        </div>
                    </div>
                @else
                    <div class="col-lg-6 col-12">
                        <x-form-input idprop="password" labelprop="Password" typeprop="password" />
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-form-input idprop="password_confirmation" labelprop="Password Confirmation"
                            typeprop="password" />
                    </div>
                @endif


                <div class="card-footer mt-3 bg-transparent px-3">
                    @if (isset($user))
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif

                    <button type="submit" class="btn {{ isset($user) ? 'btn-primary' : 'btn-success' }}">
                        {{ isset($user) ? 'Perbaharui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </x-modal>

        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari user">
                    </label>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Tambah User</button>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                <a href="{{ route('user.show', $item->id) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ $key + 1 }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->level->name ?? '' }}</td>
                                        <td>{{ $item->email }}</td>
                                        @if ($item->id !== 1 || Auth::user()->level_id !== $item->id)
                                            <td>
                                                <div>
                                                    <form action="{{ route('user.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            onclick="return confirm('Yakin ingin hapus ?')"
                                                            class="btn btn-outline-danger">
                                                            <i class="bi bi-eraser"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
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

@if (isset($user))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('user.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
