<style>
    .bg-navbar {
        background-color: #79C6FF;
    }
</style>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar"
    id="layout-navbar">
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex flex-column mb-0">
                <h5 class="fw-bold mb-0 text-white">{{ Auth::user()->name }}</h5>
                @php
                    $student = \App\Models\Student::where('id', Auth::user()->id)->first();
                    $tingkat = $student->departementClass->grade_level;
                    $jurusan = $student->departementClass->alias;
                    $identitas = $student->departementClass->identity;
                @endphp
                <span class="text-white">{{ $tingkat . ' ' . $jurusan . ' ' . $identitas }}</span>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item">
                <form action="{{ route('logout-student') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn text-danger" style="background-color: white;">Keluar</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
