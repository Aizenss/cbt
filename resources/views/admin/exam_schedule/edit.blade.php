<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Edit Ujian</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formEdit" action="{{ route('exam-schedule.update', $data->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="col-12 col-md-12">
        <label class="form-label" for="exam_date">Tanggal Ujian<span class="text-danger">*</span></label>
        <input type="date" id="exam_date" name="exam_date" class="form-control" placeholder="tanggal ujian" required
            value="{{ $data->exam_date }}" />
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="exam_title">Nama Ujian<span class="text-danger">*</span></label>
        <input type="text" id="exam_title" name="exam_title" class="form-control" placeholder="nama ujian"
            value="{{ $data->exam_title }}" required />
    </div>

    <div class="col-12 col-md-12" id="examBankParent">
        <label class="form-label" for="exam_bank_id">Bank Ujian<span class="text-danger">*</span></label>
        <select id="exam_bank_id" name="exam_bank_id" class="select2 form-select select2-primary"
            data-allow-clear="true" required>
        </select>
    </div>

    <div class="col-12 col-md-12" id="gradeLevelParent">
        <label class="form-label" for="grade_level">Tingkatan <span class="text-danger">*</span></label>
        <select id="grade_level" name="grade_level" class="select2 form-select select2-primary" required>
            <option value="10" {{ $data->gravde_level == 10 ? 'selected' : '' }}>10</option>
            <option value="11" {{ $data->gravde_level == 11 ? 'selected' : '' }}>11</option>
            <option value="12" {{ $data->gravde_level == 12 ? 'selected' : '' }}>12</option>
        </select>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="total_time">Waktu Pengerjaan<span class="text-danger">*</span></label>
        <input type="number" id="total_time" name="total_time" class="form-control" placeholder="waktu pengerjaan" value="{{ $data->total_time }}"
            required />
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="can_be_completed_time">Waktu Selesai Sebelum<span
                class="text-danger">*</span></label>
        <input type="number" id="can_be_completed_time" name="can_be_completed_time" class="form-control"
            placeholder="waktu selesai sebelum" value="{{ $data->can_be_completed_time }}" required />
    </div>

    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">Cancel</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#exam_bank_id').select2({
            dropdownParent: $('#examBankParent'),
            placeholder: 'Pilih bank ujian',
            ajax: {
                url: "{{ route('exam-bank.datatable') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        'search[value]': params.term,
                        start: 0,
                        length: 10
                    };
                },
                processResults: function(data) {
                    let apiResults = data.data.map(item => ({
                        text: item.subject_id,
                        id: item.id,
                    }));
                    return {
                        results: apiResults
                    };
                },
                cache: true
            },
        });

        var examId = '{{ $data->exam_bank_id }}';
        var examBankName = '{{ $data->examBank->subject->name }}';

        if (examId) {
            const examOption = new Option(examBankName, examId, true, true);
            $('#exam_bank_id').append(examOption).trigger('change');
        }

        $('#grade_level').select2({
            dropdownParent: $('#gradeLevelParent'),
            placeholder: 'Pilih tingkat kelas',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });

    })
</script>
<script>
    document.getElementById('formEdit').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const url = form.action;

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
