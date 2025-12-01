@extends('layout')

@section('title', 'Report')

@section('content')
    <div class="container-fluid">
        <div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Laporan Pesanan</h5>
                    <div class="row g-0">
                        <div class="col-6 px-2">
                            <label for="start_date">
                                <input onchange="changeDate(event)" type="date" name="start_date" id="start_date"
                                    class="form-control">
                            </label>
                        </div>
                        <div class="col-6 px-2">
                            <label for="end_date">
                                <input onchange="changeDate(event)" type="date" name="end_date" id="end_date"
                                    class="form-control">
                            </label>
                        </div>
                    </div>
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
                                    <th>Tanggal</th>
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
                                        @php
                                            $created_at = new DateTime($item->created_at);
                                        @endphp
                                        <td>{{ $created_at->format('d/m/Y') }}</td>
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
    <script>
        const now = new Date()
        const year = now.getFullYear()
        const month = now.getMonth() + 1
        const totalDay = new Date(year, month, 0).getDate()

        document.getElementById('start_date').value = `${year}-${month}-01`
        document.getElementById('end_date').value = `${year}-${month}-${totalDay.toString().padStart(2, '0')}`

        const changeDate = () => {
            const startDate = document.getElementById('start_date').value
            const endDate = document.getElementById('end_date').value

            const startVal = new Date(startDate)
            const endVal = new Date(endDate)
            const calc = endVal - startVal

            if (calc <= 0) return;
        }
    </script>
@endpushOnce
