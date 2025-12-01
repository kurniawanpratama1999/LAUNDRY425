@extends('layout')

@section('title', 'Login')

@section('content')
    <section style="height: calc(100vh - 4rem);" class="container d-flex justify-content-center align-items-center">
        <div style="width: 350px;" class="card p-3 ">
            <div class="card-header bg-transparent">
                <h5 class="text-center">Laundry Kurniawan</h5>
                <div class="text-center">Please Login to your account</div>
            </div>
            <div class="card-body">
                <form action="{{ route('login.process') }}" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <x-form-input idprop="email" labelprop="Email" typeprop="email" />
                    </div>

                    <div class="col-12 mb-3">
                        <x-form-input idprop="password" labelprop="Password" typeprop="password" />
                    </div>

                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@pushOnce('headscripts')
@endPushOnce

@pushOnce('footerscripts')
@endPushOnce
