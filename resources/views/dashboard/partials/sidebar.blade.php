<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    @if (\Illuminate\Support\Facades\Auth::user()->role == 'customer')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard/customer/home">
        <div class="sidebar-brand-text mx-3">
            {{ env('APP_NAME') }}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard/customer/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/customer/cards">
            <i class="far fa-fw fa-address-card"></i>
            <span>Cards</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/customer/prescriptions">
            <i class="far fa-fw fa-list-alt"></i>
            <span>Prescriptions</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/customer/complaints">
            <i class="far fa-fw fa-comment"></i>
            <span>Complaints</span></a>
    </li>
    @endif





    @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard/admin/home">
        <div class="sidebar-brand-text mx-3">
            {{ env('APP_NAME') }}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="/dashboard/admin/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Users</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/dashboard/admin/customers">Customers</a>
                <a class="collapse-item" href="/dashboard/admin/insurers">Insurers</a>
                {{-- <a class="collapse-item" href="/dashboard/admin/doctors">Doctors</a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/admin/companies">
            <i class="far fa-fw fa-list-alt"></i>
            <span>Insurance Companies</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/admin/prescriptions">
            <i class="far fa-fw fa-list-alt"></i>
            <span>Prescriptions</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/admin/complaints">
            <i class="far fa-fw fa-comment"></i>
            <span>Complaints</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/admin/stock">
            <i class="far fa-fw fa-comment"></i>
            <span>Stock</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/admin/reports">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span></a>
    </li>
    @endif




    @if (\Illuminate\Support\Facades\Auth::user()->role == 'insurer')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard/insurer/home">
        <div class="sidebar-brand-text mx-3">
            {{ env('APP_NAME') }}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="/dashboard/insurer/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/insurer/customers">
            <i class="far fa-fw fa-list-alt"></i>
            <span>Customers</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/insurer/prescriptions">
            <i class="far fa-fw fa-comment"></i>
            <span>Prescriptions</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/insurer/complaints">
            <i class="far fa-fw fa-comment"></i>
            <span>Complaints</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/dashboard/insurer/reports">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
