<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link d-flex align-items-center justify-content-center">
        <i class="fas fa-book fa-2x"></i>
        <span class="brand-text font-weight-bold mx-3">PEMIRA UNILA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/profile/') . $user['foto']; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('Profile'); ?>" class="d-block"><?= $user['nama']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header ml-3">ADMIN</li>
                <li class="nav-item">
                    <a href="<?= base_url('Admin'); ?>" class="nav-link <?php if ($title == "Dashboard") echo "active"; ?>">
                        <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Admin/datapemilih'); ?>" class="nav-link <?php if ($title == "Data Pemilih") echo "active"; ?>">
                        <i class="nav-icon fas fa-fw fa-user-graduate"></i>
                        <p>
                            Data Pemilih
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php if ($title == "Data Calon") echo "active"; ?>">
                        <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>
                            Data Calon
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/presiden'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Presiden</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/dpmu'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DPM U</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/gubernur'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gubernur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/dpmf'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DPM F</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="<?= base_url('Admin/hasilvoting'); ?>" class="nav-link <?php if ($title == "Hasil Voting") echo "active"; ?>">
                        <i class="nav-icon fas fa-fw fa-chart-pie"></i>
                        <p>
                            Hasil Voting
                        </p>
                    </a>
                </li>
                <li>
                    <hr style="border-top:1px solid grey;">
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Auth'); ?>/logout" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>