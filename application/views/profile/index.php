    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title; ?></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                </div>

                <div class="card mb-3 col-lg-8">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $user['foto']; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <center>
                                    <h5 class="card-title mb-3"><?= $user['npm']; ?></h5>
                                </center>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nama</th>
                                            <td>: <?= $user['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>: <?= $user['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fakultas</th>
                                            <td>: <?= $user['fakultas']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jurusan</th>
                                            <td>: <?= $user['jurusan']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->