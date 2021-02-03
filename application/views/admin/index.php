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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $this->db->get_where('user', ['role_id' => 2])->num_rows(); ?></h3>

                            <p>Pemilih</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $this->db->get_where('user', ['role_id' => 2, 'is_active' => 1])->num_rows(); ?></h3>

                            <p>Pemilih (Verified)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $this->db->get_where('user', ['role_id' => 2, 'presiden' => 1, 'dpmu' => 1, 'gubernur' => 1, 'dpmf' => 1])->num_rows(); ?></h3>

                            <p>Pemilih (selesai)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <?php if ($this->db->get_where('user', ['role_id' => 2])->num_rows() < 1) {
                    $progres = 0;
                } else {
                    $progres = $this->db->get_where('user', ['role_id' => 2, 'presiden' => 1, 'dpmu' => 1, 'gubernur' => 1, 'dpmf' => 1])->num_rows() / $this->db->get_where('user', ['role_id' => 2])->num_rows();
                } ?>
                <?php $progres = number_format($progres * 100, 2, '.', ''); ?>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $progres; ?><sup style="font-size: 20px">%</sup></h3>
                            <p>Progress Pemira</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->