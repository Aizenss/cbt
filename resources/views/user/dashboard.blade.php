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
            @forelse ($class as $item)
                <div class="col-12 col-md-4">
                    <div class="card card-mapel">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img src="{{ asset('images/mapel_basic.png') }}" class="img-mapel" alt="">
                            <h3 class="fw-bold mt-3 mb-1 text-center" style="height: 80px;">
                                {{ $item->examSchedule->exam_title }}</h3>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary text-nowrap"><i
                                            class="fa fa-circle-question me-2"></i>{{ $item->examSchedule->total_question }}
                                        Soal</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary text-nowrap"><i
                                            class="fa fa-clock me-2"></i>{{ $item->examSchedule->total_time }}
                                        Menit</button>
                                </div>
                            </div>
                            <button
                                class="btn {{ $item->is_finished ? 'btn-success disabled' : 'btn-warning' }} text-nowrap mt-3"
                                onclick="openModal({{ $item->id }})"
                                {{ $item->is_finished ? 'disabled' : '' }}>
                                {{ $item->is_finished ? 'Selesai' : 'Kerjakan' }}
                                <i
                                    class="fa {{ $item->is_finished ? 'fa-check' : 'fa-arrow-right' }} ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <img src="{{ asset('images/empty.png') }}" alt="No Data" class="img-fluid" style="max-width: 300px;">
                    <h4 class="mt-4 text-muted">Belum Ada Pelajaran</h4>
                    <p class="text-muted">Silahkan hubungi guru atau administrator anda untuk mendapatkan akses ke
                        pelajaran.</p>
                </div>
            @endforelse
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
        function openModal(item) {
            $.ajax({
                    url: "{{ route('dashboard.show') }}",
                    type: 'GET',
                    data: {
                        data: item,
                    }
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
