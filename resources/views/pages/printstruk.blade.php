<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Struk</title>
    <style>
        body {
            font-family: monospace;
            width: 58mm;
            /* ukuran struk thermal  */
            margin: 0 auto;
        }

        .center {
            text-align: center;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            font-size: 13px;
        }

        table td {
            vertical-align: top;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="center">
        <h3 style="margin:0;">LAUNDRY 425</h3>
        <small>Jl. Contoh Nomor 123</small>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>Kode</td>
            <td class="right">{{ $order->code }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="right">{{ $order->date }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <thead>
            <tr>
                <td>Qty</td>
                <td>Item</td>
                <td class="right">Subtotal</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $d)
                <tr>
                    <td>{{ $d->quantity }}</td>
                    <td>
                        {{ $d->service->name }} <br>
                    </td>
                    <td class="right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td>Total</td>
            <td class="right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Payment</td>
            <td class="right">Rp {{ number_format($order->payment, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Change</td>
            <td class="right">Rp {{ number_format($order->change, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="text-center"><small>Terima kasih</small></div>
        <div class="text-center"><small>sudah menggunakan jasa kami!</small></div>
    </div>

</body>

</html>
