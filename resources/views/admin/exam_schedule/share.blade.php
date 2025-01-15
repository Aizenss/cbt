<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Pembagian Soal</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formCreate" action="{{ route('exam-schedule.shareStore') }}"
    enctype="multipart/form-data">
    @csrf

    <div class="col-12 col-md-12" id="classParent">
        <label class="form-label" for="class_id">Kelas</label>
        <select id="class_id" name="class_id[]" class="select2 form-select select2-primary" data-allow-clear="true"
            multiple>
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
        $('#class_id').select2({
            dropdownParent: $('#classParent'),
            placeholder: 'Pilih kelas',
            ajax: {
                url: "{{ route('departement-class.datatable') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        'search[value]': params.term,
                        start: 0,
                        length: 10,
                        'department_id': '{{ $data->examBank->department->id }}'
                    };
                },
                processResults: function(data) {
                    let apiResults = data.data.map(item => ({
                        text: item.fullname,
                        id: item.id,
                    }));
                    return {
                        results: apiResults
                    };
                },
                cache: true
            }
        });

        var shareExamSelected = {!! json_encode($shareExamSelected ?? []) !!}

        if (shareExamSelected) {
            shareExamSelected.forEach(function(item, index) {
                var option = new Option(item.name, item.id,
                    true,
                    true);
                $('#class_id').append(option);
            });
            $('#class_id').trigger('change');
        }
    });
</script>

<script>
    document.getElementById('formCreate').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        formData.append('exam_schedule_id', '{{ $data->id }}');
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
