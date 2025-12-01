@extends('layout')

@section('title', 'Level')

@section('content')
    <section class="container">
        <x-modal title="{{ isset($level) ? 'Update Data Level' : 'Tambah Data Level' }}">
            <form method="POST" action="{{ isset($level) ? route('level.update', $level->id) : route('level.store') }}">
                @csrf
                @if (isset($level))
                    @method('PUT')
                @endif
                <div>
                    <x-form-input idprop="name" labelprop="Nama" :model="$level ?? null" />
                </div>
                <div class="card-footer mt-3 bg-transparent">

                    @if (isset($level))
                        <a href="{{ route('level.index') }}" class="btn btn-secondary">Kembali</a>
                    @endif

                    <button type="submit" class="btn {{ isset($level) ? 'btn-primary' : 'btn-success' }}">
                        {{ isset($level) ? 'Perbaharui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </x-modal>

        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari level">
                    </label>
                    @if (Auth::user()->level_id == 1)
                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Tambah Level</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Nama</th>
                                    <th colspan="2">Dibuat Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($levels as $key => $item)
                                    <tr>
                                        <td class="align-middle">
                                            <div>
                                                <a href="{{ route('level.show', $item->id) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ $key + 1 }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        @if ($item->id !== 1 || Auth::user()->level_id !== $item->id)
                                            <td>
                                                <div>
                                                    <form action="{{ route('level.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus ?')"
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
    </section>
@endsection

@if (isset($level))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('level.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
