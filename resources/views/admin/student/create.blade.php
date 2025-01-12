<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<div class="text-center mb-4">
    <h3 class="mb-2">Tambah Siswa</h3>
    <p class="text-muted">Tambahkan Data Sesuai Dengan Informasi Yang Tersedia</p>
</div>
<form method="POST" class="row g-3" id="formCreate" action="{{ route('student.store') }}"
    enctype="multipart/form-data">
    @csrf

    <div class="col-12 col-md-12" id="departementParent">
        <label class="form-label" for="departement_class_id">Kelas<span class="text-danger">*</span></label>
        <select name="departement_class_id" id="departement_class_id" class="select2 form-select select2-primary" required>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="name">Nama<span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control" placeholder="nama" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="nisn">NISN<span class="text-danger">*</span></label>
        <input type="text" id="nisn" name="nisn" class="form-control" placeholder="nisn" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="nis">NIS<span class="text-danger">*</span></label>
        <input type="text" id="nis" name="nis" class="form-control" placeholder="nis" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="gender">Jenis Kelamin<span class="text-danger">*</span></label>
        <select name="gender" id="gender" class="select2 form-select select2-primary" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="birth_place">Tempat Lahir<span class="text-danger">*</span></label>
        <input type="text" id="birth_place" name="birth_place" class="form-control" placeholder="tempat lahir" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="birth_date">Tanggal Lahir<span class="text-danger">*</span></label>
        <input type="date" id="birth_date" name="birth_date" class="form-control" placeholder="tanggal lahir" required />
    </div>

    <div class="col-12 col-md-6" id="religionParent">
        <label class="form-label" for="religion">Agama<span class="text-danger">*</span></label>
        <select name="religion" id="religion" class="select2 form-select select2-primary" required>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katholik">Katholik</option>
            <option value="Budha">Budha</option>
            <option value="Hindu">Hindu</option>
            <option value="Konghucu">Konghucu</option>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="address">Alamat<span class="text-danger">*</span></label>
        <input type="text" id="address" name="address" class="form-control" placeholder="alamat" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="phone">No. Telp<span class="text-danger">*</span></label>
        <input type="text" id="phone" name="phone" class="form-control" placeholder="no. telp" required />
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
        <input type="text" id="email" name="email" class="form-control" placeholder="email" required />
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
            }
        });
        $('#religion').select2({
            dropdownParent: $('#religionParent'),
            placeholder: 'Pilih agama',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });

    })
</script>
<script>
    document.getElementById('formCreate').addEventListener('submit', function(event) {
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
