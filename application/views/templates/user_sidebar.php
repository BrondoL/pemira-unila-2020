<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pemira Unila</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query Menu -->
    <div class="sidebar-heading">
        user
    </div>
    <li class="nav-item <?php if ($title == "Pilih Presiden") echo "active"; ?>">
        <a class=" nav-link pb-0" href="<?= base_url('user/presiden'); ?>">
            <i class="fas fa-fw fa-user-friends" style="font-size:24px"></i>
            <span>Pilih Presiden</span>
        </a>
    </li>
    <li class="nav-item <?php if ($title == "Pilih DPM U") echo "active"; ?>">
        <a class="nav-link pb-0" href="<?= base_url('user/dpmu'); ?>">
            <i class="fas fa-fw fa-user" style="font-size:24px"></i>
            <span>Pilih DPM U</span>
        </a>
    </li>
    <li class="nav-item <?php if ($title == "Pilih Gubernur") echo "active"; ?>">
        <a class="nav-link pb-0" href="<?= base_url('user/gubernur'); ?>">
            <i class="fas fa-fw fa-user-friends" style="font-size:24px"></i>
            <span>Pilih Gubernur</span>
        </a>
    </li>
    <li class="nav-item <?php if ($title == "Pilih DPM F") echo "active"; ?>">
        <a class="nav-link pb-0" href="<?= base_url('user/dpmf'); ?>">
            <i class="fas fa-fw fa-user" style="font-size:24px"></i>
            <span>Pilih DPM F</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Auth'); ?>/logout" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->