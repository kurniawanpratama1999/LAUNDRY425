@extends('layout')

@section('title', 'Transaction')

@section('content')
    <div class="container">
        <div class="mt-3">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row mx-auto">
                        <div class="col-12 col-sm-4 col-lg-6">
                            <label for="customer_id" class="w-100 p-0">
                                <select onchange="changeCustomer(event)" name="customer_id" id="customer_id"
                                    class="form-select" autocomplete="off">
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach ($customers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->phone }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="col-12 col-sm-4 col-lg-3">
                            <a href="{{ route('customer.index') }}" class="btn btn-warning text-nowrap w-100">
                                <i class="bi bi-plus"></i>
                                <span>Customer</span>
                            </a>
                        </div>
                        <div class="col-12 col-sm-4 col-lg-3">
                            <button type="button" class="btn btn-primary text-nowrap w-100" onclick="addOrder()">
                                <i class="bi bi-plus"></i>
                                <span>Order</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Jenis Layanan</th>
                                    <th>Harga Satuan</th>
                                    <th>Satuan/Kg</th>
                                    <th>Subtotal</th>
                                    <th colspan="2">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-1">
                                    <td>
                                        <label for="service-1">
                                            <select style="width: max-content;" onchange="changeService(1)" name="service-1"
                                                id="service-1" class="form-select" autocomplete="off">
                                                <option value="">-- Pilih Layanan --</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row flex-nowrap">
                                            <span class="col-3">Rp</span>
                                            <span id="price-1" class="col-9 text-right">0</span>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="quantity">
                                            <input onkeyup="changeQuantity(1)" style="width: 10ch;" class="form-control"
                                                type="text" for="quantity-1" id="quantity-1" value=""
                                                placeholder="1" autocomplete="off" autocorrect="off" disabled>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row flex-nowrap">
                                            <span class="col-3">Rp</span>
                                            <span id="subtotal-1" class="col-9 text-right">0</span>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="note-1">
                                            <input style="width: max-content;" class="form-control" type="text"
                                                name="note-1" id="note-1" value="" placeholder="Catatan pelanggan"
                                                autocomplete="off" autocorrect="off">
                                        </label>
                                    </td>
                                    <td>
                                        <div>
                                            <button id="button-1" type="button" class="btn btn-outline-danger">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0 bg-white">
                    <div class="card col-12 col-lg-6 ms-auto">
                        <div class="card-header">
                            <h5>Kalkulasi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-gap-1">
                                <div class="bg-green-200 rounded p-2 mb-2">
                                    <div class="col-12 mx-0">
                                        <label for="end_data" class="form-label">Tanggal Pengambilan</label>
                                        <input onchange="changeEndDate(event)" type="date" name="end_date" id="end_date"
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="col-6">Subtotal</span>
                                    <span class="col-2">Rp</span>
                                    <span class="col-4 text-end" id="subtotal">-</span>
                                </div>
                                <div class="row">
                                    <span class="col-6">Pajak (11%)</span>
                                    <span class="col-2">Rp</span>
                                    <span id="tax" class="col-4 text-end">-</span>
                                </div>
                                <hr class="mx-0 p-0 my-2">
                                <div class="row fw-bold">
                                    <span class="col-6">Total</span>
                                    <span class="col-2">Rp</span>
                                    <span class="col-4 text-end" id="total">-</span>
                                </div>
                                <div class="row align-items-center">
                                    <span class="col-6">Payment</span>
                                    <span class="col-2">Rp</span>
                                    <span class="col-4 text-end">
                                        <input onkeyup="changePayment(event)" type="text" name="payment"
                                            id="payment" class="form-control text-end m-0" autocomplete="off"
                                            placeholder="-">
                                    </span>
                                </div>
                                <hr class="mx-0 p-0 my-2">
                                <div class="row fw-bold">
                                    <span class="col-6">Change</span>
                                    <span class="col-2">Rp</span>
                                    <span class="col-4 text-end" id="change">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" onclick="saveTransaction()">Simpan
                                Transaksi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushOnce('footerscripts')
    <script>
        const tableDataElement = (id) => `
                <tr id="row-${id}">
                    <td>
                        <label for="service-${id}">
                            <select onchange="changeService(${id})" name="service-${id}" id="service-${id}" class="form-select">
                                <option value="">-- Pilih Layanan --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </td>
                    <td>
                        <div class="row flex-nowrap">
                            <span class="col-3">Rp</span>
                            <span id="price-${id}" class="col-9 text-right">0</span>
                        </div>
                    </td>
                    <td>
                        <label for="quantity">
                            <input onkeyup="changeQuantity(${id})" style="width: 10ch;" class="form-control" type="text" for="quantity-${id}" id="quantity-${id}"
                                value="" placeholder="1" autocomplete="off" autocorrect="off" disabled>
                        </label>
                    </td>
                    <td>
                        <div class="row flex-nowrap">
                            <span class="col-3">Rp</span>
                            <span id="subtotal-${id}" class="col-9 text-right">0</span>
                        </div>
                    </td>
                    <td>
                        <label for="note-${id}">
                            <input class="form-control" type="text" name="note-${id}" id="note-${id}"
                                value="" placeholder="Catatan pelanggan" autocomplete="off" autocorrect="off">
                        </label>
                    </td>
                    <td>
                        <div>
                            <button id="button-${id}" onclick="deleteOrder(${id})" type="button" class="btn btn-outline-danger">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </td>
                </tr>
        `

        // INCREMENT
        const row = {
            value: 1
        };

        // GET from backend
        const services = {{ Js::from($services) }}

        // 1# SETUP
        const orderDetails = {
            value: [{
                id: 1,
                service_id: null,
                price: 0,
                quantity: 1,
                subtotal: 0,
                notes: '-'
            }]
        }

        // 2# SETUP
        const order = {
            value: {
                customer_id: null,
                code: null,
                end_date: null,
                subtotal: null,
                tax: null,
                total: null,
                payment: null,
                change: null
            }
        }


        // HTML - EVENTHANDLER
        const addOrder = () => {
            row.value += 1;

            const getTableBody = document.querySelector('tbody');
            getTableBody.insertAdjacentHTML('beforeend', tableDataElement(row.value));
            addDatas({
                id: row.value
            })
        }

        // HTML - EVENTHANDLER
        const deleteOrder = (id) => {
            document.getElementById(`row-${id}`).remove();
            removeDatas(id);
        }

        // HTML - EVENTHANDLER
        const changeEndDate = (event) => {
            order.value.end_date = event.target.value
            console.log(event.target.value)
        }

        // HTML - EVENTHANDLER
        const changeCustomer = (event) => {
            order.value.customer_id = event.target.value
        }

        // HTML - EVENTHANDLER
        const changeService = (id) => {
            const targetElement = document.getElementById(`service-${id}`)
            const targetValue = parseInt(targetElement.value)

            const findService = services.find(service => service.id === targetValue)
            if (!findService) return;

            const price = findService.price
            const index = findDatasID(id)

            orderDetails.value[index].service_id = targetValue

            orderDetails.value[index].price = price
            document.getElementById(`price-${id}`).innerHTML = toRupiah(orderDetails.value[index].price);

            const quantityVal = document.getElementById(`quantity-${id}`)
            quantityVal.disabled = false;
            changeQuantity(id)
        }

        // HTML - EVENTHANDLER
        const changeQuantity = (id) => {
            const targetElement = document.getElementById(`quantity-${id}`)
            const targetValue = parseInt(targetElement.value == "" ? 1 : targetElement.value)

            const index = findDatasID(id)

            orderDetails.value[index].quantity = targetValue

            orderDetails.value[index].subtotal = orderDetails.value[index].price * orderDetails.value[index].quantity
            document.getElementById(`subtotal-${id}`).innerHTML = toRupiah(orderDetails.value[index].subtotal)

            calculate()
        }


        // UTILS
        const toRupiah = (n) => {
            const convert = new Intl.NumberFormat("id-ID").format(n);
            return convert
        }

        // UTILS
        const addDatas = ({
            id = null,
            service_id = null,
            price = null,
            quantity = null,
            subtotal = null,
            notes = null
        }) => {
            orderDetails.value.push({
                id,
                service_id,
                price,
                quantity,
                subtotal,
                notes: "-"
            })
        }

        // UTILS
        const removeDatas = (id) => {
            orderDetails.value = orderDetails.value.filter(data => data.id !== id)
        }

        // UTILS
        const findDatasID = (id) => orderDetails.value.findIndex(data => data.id == id)

        // UTILS
        const updateDatas = (id, objName, val) => {
            const index = findDatasID(id);

            orderDetails.value[index][objName] = val;
        }

        // HTML - EVENTHANDLER
        const changePayment = (event) => {
            const payment = event.target.value
            order.value = {
                ...order.value,
                payment,
                change: payment - order.value.total
            }

            calculateElements(order.value)
        }

        // UTILS
        const calculate = () => {
            const subtotal = orderDetails.value.reduce((a, b) => a + b.subtotal, 0);
            const tax = subtotal * .11;
            const total = subtotal + tax
            const payment = total
            const change = 0

            order.value = {
                ...order.value,
                subtotal,
                tax,
                total,
                payment,
                change
            }

            calculateElements(order.value)
        }

        // UTILS
        const calculateElements = (data) => {
            document.getElementById('subtotal').innerHTML = toRupiah(data.subtotal);
            document.getElementById('tax').innerHTML = toRupiah(data.tax);
            document.getElementById('total').innerHTML = toRupiah(data.total);
            document.getElementById('payment').value = data.payment;
            document.getElementById('change').innerHTML = toRupiah(data.change);
        }

        // HTML - EVENTHANDLER
        const saveTransaction = async () => {
            if (!order.value.customer_id || !order.value.end_date) return;
            const datas = {
                order: order.value,
                orderDetails: orderDetails.value
            }

            const API = await fetch("{{ route('transaction.store') }}", {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').getAttribute('content')
                },
                body: JSON.stringify({
                    datas
                })
            })

            const res = await API.json()

            if (res.success) {
                location.href = res.redirect
            } else {
                console.log(res.message)
            }
        }
    </script>
@endPushOnce
