<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('images/logo_smk.png') }}" width="50" alt="">
            <span class="app-brand-text demo menu-text fw-bold">CBT</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <a href="{{ route('dashboard.admin') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Beranda">Beranda</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('subject.*') ? 'active' : '' }}">
            <a href="{{ route('subject.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-bookmark"></i>
                <div data-i18n="Mata Pelajaran">Mata Pelajaran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('department.*') ? 'active' : '' }}">
            <a href="{{ route('department.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-directions"></i>
                <div data-i18n="Jurusan">Jurusan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('departement-class.*') ? 'active' : '' }}">
            <a href="{{ route('departement-class.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-book"></i>
                <div data-i18n="Kelas">Kelas</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
            <a href="{{ route('student.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="Siswa">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('exam-bank.*') ? 'active' : '' }}">
            <a href="{{ route('exam-bank.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-archive"></i>
                <div data-i18n="Bank Ujian">Bank Ujian</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('exam-schedule.*') ? 'active' : '' }}">
            <a href="{{ route('exam-schedule.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calendar"></i>
                <div data-i18n="Jadwal Ujian">Jadwal Ujian</div>
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="POST" class="menu-link bg-danger text-white">
                @csrf
                <i class="menu-icon tf-icons ti ti-door-exit"></i>
                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer; color: #fff;">
                    <div data-i18n="Keluar">Keluar</div>
                </button>
            </form>
        </li>
    </ul>
</aside>
