<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-stethoscope"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PasPerDok</div>
    </a>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider my-0"> --}}

    <!-- Nav Item - Dashboard -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Data
    </div> --}}

    <!-- Dokter -->
    @if (Auth::user()->hasRole('doctor'))
    <li
        class="nav-item {{ (request()->is('doctors') || request()->is('doctors/' . Auth::user()->doctor->id . '/rekap-jadwal')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-procedures"></i>
            <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="{{ route('doctors.index') }}">
                    {!! request()->is('doctors') ? '<b>Dashboard</b>' : 'Dashboard' !!}
                </a>
                <a class="collapse-item"
                    href="{{ route('rekap.jadwal.dokter', ['doctor' => Auth::user()->doctor->id]) }}">
                    {!! request()->is("doctors/" . Auth::user()->doctor->id . "/rekap-jadwal") ? '<b>Rekap Jam
                        Kerja</b>'
                    : 'Rekap Jam Kerja' !!}
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->is('doctors/' . Auth::user()->doctor->id) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('doctors.show', ['doctor' => Auth::user()->doctor->id]) }}">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Profile Dokter</span></a>
    </li>
    @endif

    <!-- Nav Item - Perawat Collapse Menu -->
    @if (Auth::user()->hasRole('nurse'))
    <li
        class="nav-item {{ (request()->is('nurses') || request()->is('nurses/' . Auth::user()->nurse->id . '/rekap-jadwal')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-nurse"></i>
            <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="{{ route('nurses.index') }}">
                    {!! request()->is('nurses') ? '<b>Dashboard</b>' : 'Dashboard' !!}
                </a>
                <a class="collapse-item"
                    href="{{ route('rekap.jadwal.perawat', ['nurse' => Auth::user()->nurse->id]) }}">
                    {!! request()->is("nurses/" . Auth::user()->nurse->id . "/rekap-jadwal") ? '<b>Rekap Jam Kerja</b>'
                    : 'Rekap Jam Kerja' !!}
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->is('nurses/' . Auth::user()->nurse->id) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('nurses.show', ['nurse' => Auth::user()->nurse->id]) }}">
            <i class="fas fa-fw fa-user-nurse"></i>
            <span>Profile Perawat</span></a>
    </li>
    @endif

    <!-- Admin -->
    @if (Auth::user()->hasRole('admin'))
    <li class="nav-item
        {{ (request()->is('admins') ||
            request()->is('admins/data-pasien') ||
            request()->is('admins/data-perawat') ||
            request()->is('admins/data-dokter') ||
            request()->is('diseases') ||
            request()->is('rooms') ||
            request()->is('admins/data-admin'))
            ? 'active'
            : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-users-cog"></i>
            <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="{{ route('admins.index') }}">
                    {!! request()->is('admins') ? '<b>Dashboard</b>' : 'Dashboard' !!}
                </a>
                <a class="collapse-item" href="{{ route('admins.data.patient') }}">
                    {!! request()->is('admins/data-pasien') ? '<b>Data Pasien</b>' : 'Data Pasien' !!}
                </a>
                <a class="collapse-item" href="{{ route('admins.data.nurse') }}">
                    {!! request()->is('admins/data-perawat') ? '<b>Data Perawat</b>' : 'Data Perawat' !!}
                </a>
                <a class="collapse-item" href="{{ route('admins.data.doctor') }}">
                    {!! request()->is('admins/data-dokter') ? '<b>Data Dokter</b>' : 'Data Dokter' !!}
                </a>
                <a class="collapse-item" href="{{ route('diseases.index') }}">
                    {!! request()->is('diseases') ? '<b>Data Penyakit</b>' : 'Data Penyakit' !!}
                </a>
                <a class="collapse-item" href="{{ route('rooms.index') }}">
                    {!! request()->is('rooms') ? '<b>Data Kamar</b>' : 'Data Kamar' !!}
                </a>
                <a class="collapse-item" href="{{ route('admins.data.admins') }}">
                    {!! request()->is('admins/data-admin') ? '<b>Data Admin</b>' : 'Data Admin' !!}
                </a>
                <a class="collapse-item" href="{{ route('attendances.index') }}">
                    {!! request()->is('attendances') ? '<b>Rekapitulasi Jadwal</b>' : 'Rekapitulasi Jadwal' !!}
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admins.show', ['admin' => Auth::user()->admin->id]) }}">
            <i class="fas fa-user-shield"></i>
            <span>Profile Admin</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
