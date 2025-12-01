@extends('layout')

@section('title', 'Pickup')

@section('content')
    <div class="container-fluid">
        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Daftar Order</h5>
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari Order">
                    </label>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pickups as $item)
                                    <tr>
                                        <td>{{ $item->order->code }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ $item->pickup_date }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ route('detail.show', $item->id) }}" title="Detail Pesanan"
                                                    type="button" class="btn btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('struk', $item->id) }}" title="print struk" type="button"
                                                    class="btn btn-outline-success">
                                                    <i class="bi bi-receipt"></i>
                                                </a>
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

@pushOnce('footerscripts')
@endPushOnce
