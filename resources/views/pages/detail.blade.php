@extends('layout')

@section('title', 'detail')

@section('content')
    <div class="container-fluid">
        <div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Daftar Detail - {{ $order->code }}</h5>
                    <label for="search">
                        <input type="search" name="search" id="search" class="form-control" placeholder="cari detail">
                    </label>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Row</th>
                                    <th>Jenis Layanan</th>
                                    <th>Kuantitas</th>
                                    <th>Subtotal</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $key => $item)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $key + 1 }}
                                            </div>
                                        </td>
                                        <td>{{ $item->service->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->subtotal + $item->subtotal * 0.11, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex p-3 fw-bold">
                            <div class="row gx-0">
                                <span>Total</span>
                                <span>Payment</span>
                                <span>Change</span>
                            </div>
                            <div class="row gx-0">
                                <span>: Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                <span>: Rp {{ number_format($order->payment, 0, ',', '.') }}</span>
                                <span>: Rp {{ number_format($order->change, 0, ',', '.') }}</span>
                            </div>
                        </div>
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

@if (isset($detail))
    @pushOnce('footerscripts')
        <script>
            window.addEventListener('load', () => {
                new bootstrap.Modal('#staticBackdrop', {}).show();

                const myModalEl = document.getElementById('staticBackdrop')
                myModalEl.addEventListener('hidden.bs.modal', event => {
                    location.href = "{{ route('detail.index') }}"
                })
            })
        </script>
    @endpushOnce
@endif
