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
                                    <th>Code</th>
                                    <th>Pelanggan</th>
                                    <th>
                                        <select style="width: 160px;" name="terima_filter" id="terima_filter"
                                            class="form-select border-0 fw-bold">
                                            <option value="">Tgl Terima</option>
                                            <option value="0">Tgl Terima a~z</option>
                                            <option value="1">Tgl Terima z~a</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select style="width: 220px;" name="perkiraan_filter" id="perkiraan_filter"
                                            class="form-select border-0 fw-bold">
                                            <option value="">Perkiraan Selesai</option>
                                            <option value="0">Perkiraan Selesai a~z</option>
                                            <option value="1">Perkiraan Selesai z~a</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select style="width: 135px;" name="status_filter" id="status_filter"
                                            class="form-select border-0 fw-bold">
                                            <option value="">Status</option>
                                            <option value="0">Status a~z</option>
                                            <option value="1">Status z~a</option>
                                        </select>
                                    </th>
                                    <th>Total</th>
                                    <th>Pembayaran</th>
                                    <th>Kembalian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    @php
                                        $status = 'Belum diambil';
                                        if ($item->status == 1) {
                                            $status = 'Sudah diambil';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        @php
                                            $start_date = new DateTime($item->date);
                                            $end_date = new DateTime($item->end_date);
                                        @endphp
                                        <td>{{ $start_date->format('d/m/Y') }}</td>
                                        <td>{{ $end_date->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <p class="badge text-success m-0">{{ $status }}</p>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->payment, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->change, 0, ',', '.') }}</td>
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
