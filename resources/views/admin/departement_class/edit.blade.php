<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Edit Ujian</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formEdit" action="{{ route('departement-class.update', $data->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="col-12 col-md-12" id="departementParent">
        <label class="form-label" for="departement_id">Departemen<span class="text-danger">*</span></label>
        <select name="departement_id" id="departement_id" class="select2 form-select select2-primary" required>
        </select>
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="alias">Singkatan<span class="text-danger">*</span></label>
        <input type="text" id="alias" name="alias" class="form-control" placeholder="singkatan"
            value="{{ $data->alias }}" required />
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="identity">Identitas<span class="text-danger">*</span></label>
        <input type="number" id="identity" name="identity" class="form-control" placeholder="identitas"
            value="{{ $data->identity }}" required />
    </div>

    <div class="col-12 col-md-12" id="gradeLevelParent">
        <label class="form-label" for="grade_level">Tingkatan <span class="text-danger">*</span></label>
        <select id="grade_level" name="grade_level" class="select2 form-select select2-primary" required>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
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
        $('#departement_id').select2({
            dropdownParent: $('#departementParent'),
            placeholder: 'Pilih jurusan',
            ajax: {
                url: "{{ route('department.datatable') }}",
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
                        text: item.name,
                        id: item.id,
                    }));
                    return {
                        results: apiResults
                    };
                },
                cache: true
            },
        });

        var departmentId = '{{ $data->departement_id }}';
        var departmentName = '{{ $data->departement->name }}';

        if (departmentId) {
            const departmentOption = new Option(departmentName, departmentId, true, true);
            $('#departement_id').append(departmentOption).trigger('change');
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
