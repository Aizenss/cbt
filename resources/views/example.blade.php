@extends('layouts.global')

@section('title', 'Nama Halaman')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables table" id="data-table">
                    <thead class="border-top">
                        <tr>
                            <th>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="checkAll" />
                                </div>
                            </th>
                            <th>Gambar</th>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Unit</th>
                            <th>Tipe</th>
                            <th>Nopol</th>
                            <th>Serial Number</th>
                            <th>Classification</th>
                            <th>No Rangka</th>
                            <th>No Mesin</th>
                            <th>NIK</th>
                            <th>Warna</th>
                            <th>Asset Manager</th>
                            <th>Assign to Project</th>
                            <th>Location</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>Aksi</th>
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