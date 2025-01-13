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
                @if (request()->routeIs('exam.index'))
                    <h5 class="fw-bold mb-0 text-white text-nowrap">Pendidikan Jasmani, Olah Raga & Kesehatan</h5>
                @else
                    <h5 class="fw-bold mb-0 text-white">{{ Auth::user()->name }}</h5>
                    <span class="text-white">XII RPL 1 - SESI 3 - Ruang 5</span>
                @endif
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            @if (request()->routeIs('exam.index'))
                <li class="nav-item">
                    <button class="btn btn-md text-center me-3" style="background-color: white;"><span
                            class="fw-bold m-0" style="font-size: 18px;">30:00</span></button>
                </li>
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="ti ti-menu-2 ti-xl fw-bold"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                        <h3 class="mb-3 fw-bold">Nomer Soal</h3>
                        <div class="row gap-3">
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">1</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">2</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">3</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">4</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary text-nowrap text-center">5</button>
                            </div>
                        </div>
                        <hr class="mb-2 mt-4">
                        <h3 class="mb-3 fw-bold">Ditandai</h3>
                        <div class="row gap-3">
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">1</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">2</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">3</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">4</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning text-nowrap text-center">5</button>
                            </div>
                        </div>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn text-danger" style="background-color: white;">Keluar</button>
                    </form>
                </li>
            @endif

        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
