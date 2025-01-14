<button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>

<div class="text-center mb-4">
    <h3 class="mb-2">Apakah Anda yakin sudah selesai?</h3>
    <p class="text-muted">Setelah Anda mengirimkan, Anda tidak dapat mengerjakan ulang tugas ini.</p>
</div>
<div class="d-flex justify-content-center gap-4 px-4">
    <button class="btn btn-danger btn-md" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-primary btn-md">Yakin</button>
</div>
<script>
    function startExam() {
        window.location.href = "{{ route('exam.index') }}";
    }
</script>