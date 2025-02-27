<button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>

<div class="text-center mb-4">
    <h3 class="mb-2">Detail Ujian</h3>
    <p class="text-muted">Berikut adalah informasi detail ujian yang dipilih</p>
</div>

<div class="row">
    <div class="col-5 text-start">
        <h5>Mata Pelajaran</h5>
    </div>
    <div class="col text-center">
        <h5>: </h5>
    </div>
    <div class="col-6 text-start">
        <h5> {{ $data->examSchedule->exam_title }}</h5>
    </div>
</div>
<hr class="mb-3">
<div class="row">
    <div class="col-5 text-start">
        <h5>Jumlah Soal</h5>
    </div>
    <div class="col text-center">
        <h5>: </h5>
    </div>
    <div class="col-6 text-start">
        <h5> {{ $data->examSchedule->total_question }} Soal</h5>
    </div>
</div>
<hr class="mb-3">
<div class="row">
    <div class="col-5 text-start">
        <h5>Durasi Pengerjaan</h5>
    </div>
    <div class="col text-center">
        <h5>: </h5>
    </div>
    <div class="col-6 text-start">
        <h5> {{ $data->examSchedule->total_time }} Menit</h5>
    </div>
</div>
<hr class="mb-3">
<div class="d-flex justify-content-center">
    <button class="btn btn-warning btn-md" onclick="startExam({{$data->examSchedule->id}})">Mulai mengerjakan<i class="fa fa-arrow-right ms-2"></i></button>
</div>

<script>
    function startExam(id) {
        window.location.href = "{{ route('exam.index', ':id') }}".replace(':id', id);
    }
</script>
