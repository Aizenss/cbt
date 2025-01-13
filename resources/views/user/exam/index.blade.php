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
                <strong style="font-size: 25px;">{{ $questions[$currentQuestion]->question }}</strong>
            </div>
        </div>
        <div class="option-container">
            <div class="option" data-value="A">
                <input type="radio" name="options" id="option-a" value="option_a" hidden>
                <label for="option-a">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_a }}</h4>
                </label>
            </div>
            <div class="option" data-value="B">
                <input type="radio" name="options" id="option-b" value="option_b" hidden>
                <label for="option-b">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_b }}</h4>
                </label>
            </div>
            <div class="option" data-value="C">
                <input type="radio" name="options" id="option-c" value="option_c" hidden>
                <label for="option-c">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_c }}</h4>
                </label>
            </div>
            <div class="option" data-value="D">
                <input type="radio" name="options" id="option-d" value="option_d" hidden>
                <label for="option-d">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_d }}</h4>
                </label>
            </div>
            @if($questions[$currentQuestion]->option_e)
            <div class="option" data-value="E">
                <input type="radio" name="options" id="option-e" value="option_e" hidden>
                <label for="option-e">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_e }}</h4>
                </label>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-between align-items-center my-5">
            <button class="btn btn-outline-primary btn-md" onclick="previousQuestion()" {{ $currentQuestion == 0 ? 'disabled' : '' }}>Kembali</button>
            <h5 class="fw-bold m-0">{{ $currentQuestion + 1 }} / {{ count($questions) }}</h5>
            <button class="btn btn-primary btn-md" onclick="saveAndNext()">{{ $currentQuestion + 1 == count($questions) ? 'Selesai' : 'Lanjut' }}</button>
        </div>

        <div class="modal fade" id="modal-ce" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body" id="content-modal-ce">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let currentQuestion = {{ $currentQuestion }};
        const totalQuestions = {{ count($questions) }};

        // Tambahkan fungsi untuk menangani pemilihan jawaban
        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', function() {
                // Hapus kelas selected dari semua opsi
                document.querySelectorAll('.option').forEach(opt => {
                    opt.classList.remove('selected');
                });

                // Tambahkan kelas selected ke opsi yang dipilih
                this.classList.add('selected');

                // Check radio button yang sesuai
                const value = this.dataset.value;
                document.querySelector(`#option-${value.toLowerCase()}`).checked = true;
            });
        });

        // Fungsi untuk memuat jawaban yang sudah disimpan sebelumnya
        function loadSavedAnswer() {
            $.ajax({
                url: "{{ route('exam.get-answer') }}", // Anda perlu membuat route ini
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}",
                    question_id: "{{ $questions[$currentQuestion]->id }}"
                },
                success: function(response) {
                    if (response.answer) {
                        const savedOption = document.querySelector(`.option[data-value="${response.answer}"]`);
                        if (savedOption) {
                            savedOption.classList.add('selected');
                            document.querySelector(`#option-${response.answer.toLowerCase()}`).checked = true;
                        }
                    }

                    // Set status ragu-ragu
                    if (response.is_flagged) {
                        document.querySelector('.switch-input').checked = true;
                    }
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadSavedAnswer);

        function completed() {
            Swal.fire({
                title: 'Selesai!',
                text: 'Anda telah menyelesaikan semua soal ujian',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('dashboard') }}";
                }
            });
        }

        function saveAndNext() {
            const answer = document.querySelector('input[name="options"]:checked')?.value;
            const isFlagged = document.querySelector('.switch-input').checked;

            $.ajax({
                url: "{{ route('exam.save-answer') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}",
                    question_id: "{{ $questions[$currentQuestion]->id }}",
                    answer: answer,
                    is_flagged: isFlagged,
                    next_question: currentQuestion + 1
                },
                success: function(response) {
                    if (currentQuestion + 1 < totalQuestions) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Jawaban berhasil disimpan',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        completed();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Gagal menyimpan jawaban.', 'error');
                }
            });
        }

        function previousQuestion() {
            if (currentQuestion > 0) {
                $.ajax({
                    url: "{{ route('exam.save-answer') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        schedule_id: "{{ $schedule->id }}",
                        question_id: "{{ $questions[$currentQuestion]->id }}",
                        answer: document.querySelector('input[name="options"]:checked')?.value,
                        is_flagged: document.querySelector('.switch-input').checked,
                        next_question: currentQuestion - 1
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endpush
