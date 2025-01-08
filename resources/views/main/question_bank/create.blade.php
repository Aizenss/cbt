<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Tambah Soal</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formCreate" action="{{ route('question-bank.store') }}"
    enctype="multipart/form-data">
    @csrf

    <div class="col-12 col-md-12">
        <label class="form-label" for="question">Soal <span class="text-danger">*</span></label>
        <textarea id="question" name="question" class="form-control" placeholder="soal" rows="5"></textarea>
        <button type="button" class="btn btn-secondary mt-2 btn-sm" id="expandQuestion">Tampilkan Lebih Banyak</button>
        <button type="button" class="btn btn-secondary mt-2 d-none btn-sm" id="collapseQuestion">Tampilkan Lebih
            Sedikit</button>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="option_a">Option A <span class="text-danger"></span></label>
        <textarea id="option_a" name="option_a" class="form-control" placeholder="Pilihan A"></textarea>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="option_b">Option B <span class="text-danger"></span></label>
        <textarea id="option_b" name="option_b" class="form-control" placeholder="Pilihan B"></textarea>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="option_c">Option C <span class="text-danger"></span></label>
        <textarea id="option_c" name="option_c" class="form-control" placeholder="Pilihan C"></textarea>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="option_d">Option D <span class="text-danger"></span></label>
        <textarea id="option_d" name="option_d" class="form-control" placeholder="Pilihan D"></textarea>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="option_e">Option E <span class="text-danger"></span></label>
        <textarea id="option_e" name="option_e" class="form-control" placeholder="Pilihan E"></textarea>
    </div>

    <div class="col-12 col-md-12" id="correctAnswerParent">
        <label class="form-label" for="correct_answer">Jawaban Benar <span class="text-danger"></span></label>
        <select id="correct_answer" name="correct_answer" class="select2 form-select select2-primary" required>
            <option value="option_a">A</option>
            <option value="option_b">B</option>
            <option value="option_c">C</option>
            <option value="option_d">D</option>
            <option value="option_e">E</option>
        </select>
    </div>

    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">Cancel</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#correct_answer').select2({
            dropdownParent: $('#correctAnswerParent'),
            placeholder: 'Pilih Jawaban Benar',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });

    })
    document.getElementById('expandQuestion').addEventListener('click', function() {
        var questionTextarea = document.getElementById('question');
        questionTextarea.rows = 15;
        this.classList.add('d-none');
        document.getElementById('collapseQuestion').classList.remove('d-none');
    });

    document.getElementById('collapseQuestion').addEventListener('click', function() {
        var questionTextarea = document.getElementById('question');
        questionTextarea.rows = 5;
        this.classList.add('d-none');
        document.getElementById('expandQuestion').classList.remove('d-none');
    });
</script>
<script>
    document.getElementById('formCreate').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const url = form.action;
        formData.append('examBankId', "{{ $examBanks->id }}");

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    let errorMessages = '';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        errorMessages += messages.join('<br>') + '<br>';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMessages
                    });
                } else if (!data.status) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then(() => {
                        $("#modal-ce").modal("hide");

                        $('#data-table').DataTable().ajax.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            });
    });
</script>
