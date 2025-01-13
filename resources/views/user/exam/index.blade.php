@extends('layouts.user')

@section('title', 'Dashboard')

@push('css')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-xxl container-p-y" style="margin-top: 80px;">
        <div class="d-flex gap-3 align-items-center mb-4">
            <button class="btn btn-primary px-4 py-2 fw-bold" style="font-size: 20px;" onclick="normalFontSize()">A</button>
            <button class="btn btn-primary px-3 py-2 fw-bold" style="font-size: 20px;" onclick="addFontSize()">A <i
                    class="ti ti-arrow-up ti-xs"></i></button>
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
        <div class="d-flex flex-column gap-3 align-items-center mt-5">
            <div class="form-check custom-option     custom-option-basic" style="width: 100%;">
                <label class="form-check-label custom-option-content" for="customRadioTemp1">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                        id="customRadioTemp1" />
                    <span class="custom-option-header">
                        <span class="h6 mb-0">Basic</span>
                        <span class="text-muted">Free</span>
                    </span>
                    <span class="custom-option-body">
                        <small>Get 1 project with 1 teams members.</small>
                    </span>
                </label>
            </div>
            <div class="form-check custom-option     custom-option-basic" style="width: 100%;">
                <label class="form-check-label custom-option-content" for="customRadioTemp2">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                        id="customRadioTemp2" />
                    <span class="custom-option-header">
                        <span class="h6 mb-0">Premium</span>
                        <span class="text-muted">$ 5.00</span>
                    </span>
                    <span class="custom-option-body">
                        <small>Get 5 projects with 5 team members.</small>
                    </span>
                </label>
            </div>
            <div class="form-check custom-option     custom-option-basic" style="width: 100%;">
                <label class="form-check-label custom-option-content" for="customRadioTemp2">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                        id="customRadioTemp2" />
                    <span class="custom-option-header">
                        <span class="h6 mb-0">Premium</span>
                        <span class="text-muted">$ 5.00</span>
                    </span>
                    <span class="custom-option-body">
                        <small>Get 5 projects with 5 team members.</small>
                    </span>
                </label>
            </div>
            <div class="form-check custom-option     custom-option-basic" style="width: 100%;">
                <label class="form-check-label custom-option-content" for="customRadioTemp2">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                        id="customRadioTemp2" />
                    <span class="custom-option-header">
                        <span class="h6 mb-0">Premium</span>
                        <span class="text-muted">$ 5.00</span>
                    </span>
                    <span class="custom-option-body">
                        <small>Get 5 projects with 5 team members.</small>
                    </span>
                </label>
            </div>
            <div class="form-check custom-option     custom-option-basic" style="width: 100%;">
                <label class="form-check-label custom-option-content" for="customRadioTemp2">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                        id="customRadioTemp2" />
                    <span class="custom-option-header">
                        <span class="h6 mb-0">Premium</span>
                        <span class="text-muted">$ 5.00</span>
                    </span>
                    <span class="custom-option-body">
                        <small>Get 5 projects with 5 team members.</small>
                    </span>
                </label>
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
