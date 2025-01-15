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
                    <h5 class="fw-bold mb-0 text-white text-nowrap">{{ $schedule->exam_title }}</h5>
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item">
                    <button class="btn btn-md text-center me-3" style="background-color: white;">
                        <span class="fw-bold m-0" style="font-size: 18px;" id="timer">00:00</span>
                    </button>
                </li>
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ti ti-menu-2 ti-xl fw-bold"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                        <h3 class="mb-3 fw-bold">Nomer Soal</h3>
                        <div class="row gap-3">
                            @foreach ($questions as $index => $question)
                                <div class="col-2">
                                    <button
                                        class="btn {{ $index == $currentQuestion ? 'btn-success' : 'btn-primary' }} question-number text-nowrap text-center"
                                        data-question="{{ $index }}">{{ $index + 1 }}</button>
                                </div>
                            @endforeach
                        </div>
                        <hr class="mb-2 mt-4">
                        <h3 class="mb-3 fw-bold">Ditandai</h3>
                        <div class="row gap-3" id="flagged-questions">
                            <!-- Akan diisi secara dinamis via JavaScript -->
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
            <div class="option" data-value="E">
                <input type="radio" name="options" id="option-e" value="option_e" hidden>
                <label for="option-e">
                    <h4 class="m-0">{{ $questions[$currentQuestion]->option_e }}</h4>
                </label>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center my-5">
            <button class="btn btn-outline-primary btn-md" onclick="previousQuestion()"
                {{ $currentQuestion == 0 ? 'disabled' : '' }}>Kembali</button>
            <h5 class="fw-bold m-0">{{ $currentQuestion + 1 }} / {{ count($questions) }}</h5>
            <button class="btn btn-primary btn-md"
                onclick="saveAndNext()">{{ $currentQuestion + 1 == count($questions) ? 'Selesai' : 'Lanjut' }}</button>
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
                const radioInput = document.querySelector(`#option-${value.toLowerCase()}`);
                if (radioInput) {
                    radioInput.checked = true;
                }
            });
        });

        // Fungsi untuk memuat jawaban yang sudah disimpan sebelumnya
        function loadSavedAnswer() {
            $.ajax({
                url: "{{ route('exam.get-answer') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}",
                    question_id: "{{ $questions[$currentQuestion]->id }}"
                },
                success: function(response) {
                    if (response.answer) {
                        const optionLetter = response.answer.slice(-1).toUpperCase();
                        const savedOption = document.querySelector(`.option[data-value="${optionLetter}"]`);
                        if (savedOption) {
                            savedOption.classList.add('selected');
                            // document.querySelector(`#option-${response.answer.toLowerCase()}`).checked = true;
                        }
                    }

                    // Set status ragu-ragu
                    document.querySelector('.switch-input').checked = response.is_flagged;
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadSavedAnswer();
            loadFlaggedQuestions();

            // Tambahkan event listener untuk switch ragu-ragu
            document.querySelector('.switch-input').addEventListener('change', function() {
                const questionNumber = currentQuestion + 1;
                const button = document.querySelector(
                    `.question-number[data-question="${currentQuestion}"]`);

                updateFlaggedQuestions();
            });
        });

        // Tambahkan kode timer
        const endTime = {{ session('exam_end_time') }};
        const canBeCompletedTime = {{ $schedule->can_be_completed_time }};
        let timerInterval;

        function updateTimer() {
            const now = Math.floor(Date.now() / 1000);
            const timeLeft = endTime - now;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);

                $.ajax({
                    url: "{{ route('exam.clear-session') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        schedule_id: "{{ $schedule->id }}"
                    },
                    success: function() {
                        Swal.fire({
                            title: 'Waktu Habis!',
                            text: 'Waktu ujian telah selesai',
                            icon: 'warning',
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            window.location.href = "{{ route('dashboard') }}";
                        });
                    }
                });
                return;
            }

            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer').textContent =
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // Jalankan timer
        timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Modifikasi fungsi completed
        function completed() {
            const now = Math.floor(Date.now() / 1000);
            const examDuration = endTime - now;

            if (examDuration > (canBeCompletedTime * 60)) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Anda harus menunggu waktu dibawah ' + canBeCompletedTime +
                        ' menit sebelum menyelesaikan ujian',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Periksa soal yang ditandai sebelum menyelesaikan
            $.ajax({
                url: "{{ route('exam.get-all-answers') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}"
                },
                success: function(response) {
                    const flaggedQuestions = response.answers.filter(answer => answer.is_flagged);

                    if (flaggedQuestions.length > 0) {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Masih ada ' + flaggedQuestions.length +
                                ' soal yang ditandai ragu-ragu. Harap periksa kembali jawaban Anda.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Tampilkan konfirmasi sebelum menyelesaikan
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menyelesaikan ujian?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Selesaikan',
                        cancelButtonText: 'Tidak, Kembali',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lanjutkan dengan proses penyelesaian
                            $.ajax({
                                url: "{{ route('exam.clear-session') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    schedule_id: "{{ $schedule->id }}"
                                },
                                success: function() {
                                    Swal.fire({
                                        title: 'Selesai!',
                                        text: 'Anda telah menyelesaikan semua soal ujian',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href =
                                                "{{ route('dashboard') }}";
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }

        function saveAndNext() {
            const selectedAnswer = document.querySelector('input[name="options"]:checked')?.value;
            const isFlagged = document.querySelector('.switch-input').checked ? 1 : 0;

            $.ajax({
                url: "{{ route('exam.get-answer') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}",
                    question_id: "{{ $questions[$currentQuestion]->id }}"
                },
                success: function(previousAnswer) {
                    const finalAnswer = selectedAnswer || previousAnswer.answer;

                    $.ajax({
                        url: "{{ route('exam.save-answer') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            schedule_id: "{{ $schedule->id }}",
                            question_id: "{{ $questions[$currentQuestion]->id }}",
                            answer: finalAnswer,
                            is_flagged: isFlagged,
                            next_question: currentQuestion + 1
                        },
                        success: function(response) {
                            if (currentQuestion + 1 < totalQuestions) {
                                window.location.reload();
                            } else {
                                completed();
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Gagal menyimpan jawaban.', 'error');
                        }
                    });
                }
            });
        }

        function previousQuestion() {
            if (currentQuestion > 0) {
                const selectedAnswer = document.querySelector('input[name="options"]:checked')?.value;
                const isFlagged = document.querySelector('.switch-input').checked ? 1 : 0;

                $.ajax({
                    url: "{{ route('exam.get-answer') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        schedule_id: "{{ $schedule->id }}",
                        question_id: "{{ $questions[$currentQuestion]->id }}"
                    },
                    success: function(previousAnswer) {
                        const finalAnswer = selectedAnswer || previousAnswer.answer;

                        $.ajax({
                            url: "{{ route('exam.save-answer') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                schedule_id: "{{ $schedule->id }}",
                                question_id: "{{ $questions[$currentQuestion]->id }}",
                                answer: finalAnswer,
                                is_flagged: isFlagged,
                                next_question: currentQuestion - 1
                            },
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        }

        // Tambahkan fungsi baru untuk memuat soal yang ditandai
        function loadFlaggedQuestions() {
            $.ajax({
                url: "{{ route('exam.get-all-answers') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}"
                },
                success: function(response) {
                    updateQuestionButtons(response.answers);
                    updateFlaggedQuestions(response.answers);
                }
            });
        }

        // Fungsi untuk memperbarui tampilan tombol nomor soal
        function updateQuestionButtons(answers) {
            answers.forEach(answer => {
                const button = document.querySelector(`.question-number[data-question="${answer.question_index}"]`);
                if (button) {
                    // Reset class terlebih dahulu
                    button.classList.remove('btn-primary', 'btn-success', 'btn-warning', 'btn-light');

                    if (answer.is_flagged) {
                        // Jika soal ditandai
                        button.classList.add('btn-warning');
                    } else if (answer.answer) {
                        // Jika sudah dijawab (answer tidak null)
                        button.classList.add('btn-primary');
                    } else {
                        // Jika belum dijawab
                        button.classList.add('btn-light');
                        button.style.border = '1px solid #dee2e6';
                    }

                    // Khusus untuk soal yang sedang aktif
                    if (answer.question_index === currentQuestion) {
                        button.classList.remove('btn-light', 'btn-primary');
                        button.classList.add('btn-success');
                    }
                }
            });
        }

        // Fungsi untuk memperbarui daftar soal yang ditandai
        function updateFlaggedQuestions(answers) {
            const container = document.getElementById('flagged-questions');
            container.innerHTML = '';

            if (!answers) return;

            answers.filter(answer => answer.is_flagged).forEach(answer => {
                const div = document.createElement('div');
                div.className = 'col-2';

                const buttonClass = answer.answer ? 'btn-warning' : 'btn-light border';

                div.innerHTML = `
                    <button class="btn ${buttonClass} question-number text-nowrap text-center"
                            data-question="${answer.question_index}"
                            onclick="goToQuestion(${answer.question_index})">
                        ${answer.question_index + 1}
                    </button>
                `;
                container.appendChild(div);
            });
        }

        // Tambahkan event listener untuk tombol nomor soal di navbar
        document.querySelectorAll('.question-number').forEach(button => {
            button.addEventListener('click', function() {
                const questionIndex = parseInt(this.dataset.question);
                goToQuestion(questionIndex);
            });
        });

        // Perbaikan fungsi goToQuestion
        function goToQuestion(questionIndex) {
            const selectedAnswer = document.querySelector('input[name="options"]:checked')?.value;
            const isFlagged = document.querySelector('.switch-input').checked ? 1 : 0;

            $.ajax({
                url: "{{ route('exam.save-answer') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    schedule_id: "{{ $schedule->id }}",
                    question_id: "{{ $questions[$currentQuestion]->id }}"
                },
                success: function(previousAnswer) {
                    const finalAnswer = selectedAnswer || previousAnswer.answer;

                    // Simpan jawaban saat ini sebelum pindah
                    $.ajax({
                        url: "{{ route('exam.save-answer') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            schedule_id: "{{ $schedule->id }}",
                            question_id: "{{ $questions[$currentQuestion]->id }}",
                            answer: finalAnswer,
                            is_flagged: isFlagged,
                            next_question: questionIndex
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endpush
