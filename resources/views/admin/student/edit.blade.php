<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Edit Siswa</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formEdit" action="{{ route('student.update', $data->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="col-12 col-md-12" id="departementParent">
        <label class="form-label" for="departement_class_id">Kelas<span class="text-danger">*</span></label>
        <select name="departement_class_id" id="departement_class_id" class="select2 form-select select2-primary"
            required>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="name">Nama<span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control" placeholder="nama"
            value="{{ $data->name }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="nisn">NISN<span class="text-danger">*</span></label>
        <input type="text" id="nisn" name="nisn" class="form-control" placeholder="nisn"
            value="{{ $data->nisn }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="nis">NIS<span class="text-danger">*</span></label>
        <input type="text" id="nis" name="nis" class="form-control" placeholder="nis"
            value="{{ $data->nis }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
        <select name="gender" id="gender" class="select2 form-select select2-primary" required>
            <option value="L" {{ $data->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $data->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="birth_place">Tempat Lahir<span class="text-danger">*</span></label>
        <input type="text" id="birth_place" name="birth_place" class="form-control" placeholder="tempat lahir"
            value="{{ $data->birth_place }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="birth_date">Tanggal Lahir<span class="text-danger">*</span></label>
        <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="tanggal lahir"
            value="{{ $data->birth_date }}" required />
    </div>

    <div class="col-12 col-md-6" id="religionParent">
        <label class="form-label" for="religion">Agama<span class="text-danger">*</span></label>
        <select name="religion" id="religion" class="select2 form-select select2-primary" required>
            <option value="Islam" {{ $data->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Kristen" {{ $data->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
            <option value="Katholik" {{ $data->religion == 'Katholik' ? 'selected' : '' }}>Katholik</option>
            <option value="Budha" {{ $data->religion == 'Budha' ? 'selected' : '' }}>Budha</option>
            <option value="Hindu" {{ $data->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
            <option value="Konghucu" {{ $data->religion == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="address">Alamat<span class="text-danger">*</span></label>
        <input type="text" id="address" name="address" class="form-control" placeholder="alamat"
            value="{{ $data->address }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="phone">No. Telp<span class="text-danger">*</span></label>
        <input type="text" id="phone" name="phone" class="form-control" placeholder="no. telp"
            value="{{ $data->phone }}" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
        <input type="text" id="email" name="email" class="form-control" placeholder="email"
            value="{{ $data->email }}" required />
    </div>

    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">Cancel</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#departement_class_id').select2({
            dropdownParent: $('#departementParent'),
            placeholder: 'Pilih kelas',
            ajax: {
                url: "{{ route('departement-class.datatable') }}",
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
                        text: item.fullname,
                        id: item.id,
                    }));
                    return {
                        results: apiResults
                    };
                },
                cache: true
            },
        });

        var departmentId = '{{ $data->departement_class_id }}';
        var departmentName =
            '{{ $data->departementClass->grade_level }} {{ $data->departementClass->alias }} {{ $data->departementClass->identity }}';

        if (departmentId) {
            const departmentOption = new Option(departmentName, departmentId, true, true);
            $('#departement_class_id').append(departmentOption).trigger('change');
        }

        $('#religion').select2({
            dropdownParent: $('#religionParent'),
            placeholder: 'Pilih agama',
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
