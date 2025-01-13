@extends('layouts.user')

@section('title', 'Dashboard')

@push('css')
    <style>
        .option-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 40px 0px;
        }

        .option {
            border: 2px solid #ccc;
            border-radius: 10px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .option label {
            display: block;
            padding: 15px;
            cursor: pointer;
        }

        .option:hover {
            border-color: #007bff;
            background-color: #f9f9ff;
        }

        .option.selected {
            border-color: #007bff;
            background-color: #e0f0ff;
        }
    </style>
@endpush

@push('navbar')
    <style>
        .bg-navbar {
            background-color: #79C6FF;
        }
    </style>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar"
        id="layout-navbar">
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex flex-column mb-0">
                    <h5 class="fw-bold mb-0 text-white text-nowrap">Pendidikan Jasmani, Olah Raga & Kesehatan</h5>
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item">
                    <button class="btn btn-md text-center me-3" style="background-color: white;"><span class="fw-bold m-0"
                            style="font-size: 18px;">30:00</span></button>
                </li>
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ti ti-menu-2 ti-xl fw-bold"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                        <h3 class="mb-3 fw-bold">Nomer Soal</h3>
                        <div class="row gap-3">
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">1</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">2</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">3</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">4</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">5</button>
                            </div>
                        </div>
                        <hr class="mb-2 mt-4">
                        <h3 class="mb-3 fw-bold">Ditandai</h3>
                        <div class="row gap-3">
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">1</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">2</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">3</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">4</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">5</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
                aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
        </div>
    </nav>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y " style="margin-top: 80px; padding: 0px 140px;">
        <div class="d-flex gap-3 align-items-center mb-4">
            <label class="switch switch-warning switch-lg">
                <input type="checkbox" class="switch-input" checked />
                <span class="switch-toggle-slider">
                    <span class="switch-on">
                        <i class="ti ti-check"></i>
                    </span>
                    <span class="switch-off">
                        <i class="ti ti-x"></i>
                    </span>
                </span>
                <span class="switch-label">Ragu Ragu</span>
            </label>
        </div>
        <div class="d-flex gap-4">
            <div>
                <strong style="font-size: 25px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat ullam
                    facilis vitae delectus amet corporis distinctio odio aperiam quod asperiores. Debitis ipsum nobis
                    voluptatum quaerat voluptates expedita dolor, magni nisi.</strong>
            </div>
            <div>
                <img src="{{ asset('images/mapel_basic.png') }}" width="300" alt="">
            </div>
        </div>
        <div class="option-container">
            <div class="option" data-value="option1">
                <input type="radio" name="options" id="option-1" hidden>
                <label for="option-1">
                    <h4 class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, libero eos culpa vel
                        dolorum dignissimos voluptatum voluptates officia harum voluptatibus.</h4>
            </div>
            <div class="option" data-value="option2">
                <input type="radio" name="options" id="option-2" hidden>
                <label for="option-2">
                    <h4 class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, odio?</h4>
                </label>
            </div>
            <div class="option" data-value="option3">
                <input type="radio" name="options" id="option-3" hidden>
                <label for="option-3">
                    <h4 class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, libero eos culpa vel
                        dolorum dignissimos voluptatum voluptates officia harum voluptatibus.</h4>
            </div>
            <div class="option" data-value="option4">
                <input type="radio" name="options" id="option-4" hidden>
                <label for="option-4">
                    <h4 class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, odio?</h4>
                </label>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center my-5">
            <button class="btn btn-outline-primary btn-md">Kembali</button>
            <h5 class="fw-bold m-0">15 / 30</h5>
            <button class="btn btn-primary btn-md">Lanjut</button>
            <button class="btn btn-primary btn-md" onclick="completed()">Selesai</button>
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
            function completed() {
                $.ajax({
                        url: "{{ route('exam.show') }}",
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

            document.addEventListener("DOMContentLoaded", function() {
                const options = document.querySelectorAll(".option");

                options.forEach(option => {
                    const input = option.querySelector("input");
                    option.addEventListener("click", function() {
                        input.checked = true;

                        options.forEach(opt => opt.classList.remove("selected"));
                        option.classList.add("selected");
                    });
                });
            });
        </script>
    @endpush
