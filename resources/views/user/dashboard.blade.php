@extends('layouts.user')

@section('title', 'Dashboard')

@push('css')
    <style>
        .card-mapel {
            border-radius: 25px;
            border: 1px solid #DBDDE8;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            margin-top: 100px;
            height: 450px;
        }

        .img-mapel {
            width: 300px;
            margin-top: -100px;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl container-p-y" style="margin-top: 80px;">
        <div class="row ">
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/mapel_basic.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Pendidikan Jasmani, Olah Raga &
                            Kesehatan</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/tkkr.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Tata Kecantikan Kulit dan Rambut
                        </h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/rpl.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Rekayasa Perangkat Lunak</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/tab.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Teknik Alat Berat</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/tkro.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Teknik Kendaraan Ringan Otomotif
                        </h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/tpm.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Teknik Permesinan</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/tkj.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Teknik Komputer dan Jaringan</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-mapel">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/titl.png') }}" class="img-mapel" alt="">
                        <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">Teknik Instalasi dan Tenaga
                            Listrik</h3>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-circle-question me-2"></i>40
                                    Soal</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary text-nowrap"><i class="fa fa-clock me-2"></i>40
                                    Menit</button>
                            </div>
                        </div>
                        <button class="btn btn-warning text-nowrap mt-3" onclick="openModal()">Kerjakan<i
                                class="fa fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-ce" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body" id="content-modal-ce">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function openModal() {
            $.ajax({
                    url: "{{ route('dashboard.show') }}",
                    type: 'GET',
                })
                .done(function(data) {
                    $('#content-modal-ce').html(data);

                    $("#modal-ce").modal("show");
                })
                .fail(function() {
                    Swal.fire('Error!', 'An error occurred while creating the record.', 'error');
                });
        }
    </script>
@endpush
