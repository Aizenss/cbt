@extends('layouts.admin')

@section('title', 'Bank Ujian')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman Evaluasi /</span> Home</h4>

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Evaluasi</h5>
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <div class="col-12 col-md-12" id="examScheduleParent">
                        <label class="form-label" for="exam_schedule_id">Bank Ujian<span class="text-danger">*</span></label>
                        <select id="exam_schedule_id" name="exam_schedule_id" class="select2 form-select select2-primary"
                            data-allow-clear="true" required>
                        </select>
                    </div>
                    <div class="col-12 col-md-12" id="departementParent">
                        <label class="form-label" for="departement_class_id">Kelas<span class="text-danger">*</span></label>
                        <select name="departement_class_id" id="departement_class_id"
                            class="select2 form-select select2-primary" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table" id="data-table">
                    <thead class="border-top">
                        <tr>
                            <th>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="checkAll" />
                                </div>
                            </th>
                            <th>Nama Siswa</th>
                            <th>Benar</th>
                            <th>Salah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
        $(document).ready(function() {
            init_table();

            $('#exam_schedule_id').select2({
                dropdownParent: $('#examScheduleParent'),
                placeholder: 'Pilih ujian',
                ajax: {
                    url: "{{ route('exam-schedule.datatable') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            'search[value]': params.term,
                            start: 0,
                        };
                    },
                    processResults: function(data) {
                        let apiResults = data.data.map(item => ({
                            text: item.exam_title,
                            id: item.id,
                        }));
                        return {
                            results: apiResults
                        };
                    },
                    cache: true
                }
            });

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

            $('#exam_schedule_id').on('change', function() {
                let examScheduleId = $(this).val();
                if (examScheduleId) {
                    $('#departement_class_id').val(null).trigger('change'); // Reset kelas selection
                }
            });

            $('#departement_class_id').on('change', function() {
                let classId = $(this).val();
                let examScheduleId = $('#exam_schedule_id').val();
                if (classId && examScheduleId) {
                    init_table(classId, examScheduleId);
                }
            });
        })

        function init_table(classId = '', examScheduleId = '') {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    type: "GET",
                    url: "{{ route('evaluation.datatable') }}",
                    data: {
                        'class_id': classId,
                        'exam_schedule_id': examScheduleId,
                    }
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'correct_answers',
                        name: 'correct_answers'
                    },
                    {
                        data: 'wrong_answers',
                        name: 'wrong_answers'
                    },
                    {
                        data: 'final_score',
                        name: 'final_score'
                    },
                ]
            });
        }
    </script>
@endpush
