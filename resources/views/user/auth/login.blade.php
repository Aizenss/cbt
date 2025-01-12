@extends('layouts.auth')

@push('css')
    <style>
        .card-wrapper {
            height: 350px;
            width: 400px;
            border-radius: 10px;
            padding: 0px 8px;
        }

        .logo {
            width: 120px;
        }

        .h-full {
            height: 100vh;
        }

        .h-fill {
            height: 100%;
        }

        .fill {
            height: 100%;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }

        .login-text {
            color: #201E43;
            font-weight: 600;
            font-size: 30px;
        }

        .col-left {
            background-color: #201E43;
            border-radius: 21px;
        }

        .btn-main {
            padding: 10px 0px;
            width: 100%;
            text-align: center;
            color: #FFFFFF;
            background-color: #79C6FF;
            border-radius: 5px;
            border: none;
        }

        .title {
            font-weight: 600;
            font-size: 20px;
            color: #FFFFFF;
        }

        .z-1 {
            z-index: 10;
        }

        .z-2 {
            z-index: 20;
        }
        .shape {
            position: absolute;
            top: 0;
            left: 0;
            max-width: 100%;
            width: 100%;
            max-height: 500px;
            object-fit: fill;
        }
    </style>
@endpush
@section('content')
    <div class="container-xl d-flex flex-column justify-content-center align-items-center h-full w-screen">
        <img src="{{ asset('images/shape_login.png') }}" class="z-1 shape" alt="">
        <div class="d-flex flex-column justify-content-between align-items-center h-full py-4 z-2">
            <div class="flex-1 d-flex flex-column justify-content-center align-items-center ">
                <img src="{{ asset('images/logo_smk.png') }}" width="120" alt="">
                <h1 class="fw-bold mt-3 mb-1 text-white">UJIAN ONLINE</h1>
                <span class="fs-4 mb-3 text-white">SMK PGRI WLINGI</span>
                <div class="card card-wrapper">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center">
                            <h5 class="login-text text-center mb-2">Silakan Login</h5>
                            <form class="mb-3" action="{{ route('login-student') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis"
                                        placeholder="contoh: 16161" autofocus />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Tanggal Lahir</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn-main d-grid w-100" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <span>TIM KECIL
                    <script>
                        document.write(new Date().getFullYear());
                    </script> © All Rights Reserved
                </span>
            </div>
        </div>
    </div>
@endsection
