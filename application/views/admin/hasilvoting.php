<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <center>
                <h1 class="h3 mb-4" style="color: black;">Hasil Voting Pemira UNILA 2020</h1>
            </center>
            <h3 style="color: black;">Presiden Mahasiswa</h3>
            <?php foreach ($presiden as $p) : ?>
                <div class="card mr-5 mb-3" style="width: 18rem; display:inline-block;">
                    <img src="<?= base_url('assets/img/foto_calon/') . $p['foto']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center; color: black;">No Urut <?= $p['no_urut']; ?></h5>
                        <h5 class="card-text" style="text-align: center; color: black;"><?= $p['nama_ketua'] . " dan " . $p['nama_wakil']; ?></h5>
                        <h5 class="card-text mb-5" style="text-align: center; color: red;"><?= $this->db->get_where('suara', ['presiden' => $p['no_urut']])->num_rows(); ?> Suara</h5>
                    </div>
                </div>
            <?php endforeach; ?>
            <h3 style="color: black;">DPM Universitas</h3>
            <?php foreach ($dpmu as $d) : ?>
                <div class="card mr-5 mb-3" style="width: 18rem; display:inline-block;">
                    <img src="<?= base_url('assets/img/foto_calon/') . $d['foto']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center; color: black;">No Urut <?= $d['no_urut']; ?></h5>
                        <h6 class="card-title" style="text-align: center; color: black;">Fakultas <?= $d['fakultas']; ?></h6>
                        <h5 class="card-text" style="text-align: center; color: black;"><?= $d['nama']; ?></h5>
                        <h5 class="card-text mb-5" style="text-align: center; color: red;"><?= $this->db->get_where('suara', ['dpmu' => $d['fakultas'] . $d['no_urut']])->num_rows(); ?> Suara</h5>
                    </div>
                </div>
            <?php endforeach; ?>
            <h3 style="color: black;">Gubernur Fakultas</h3>
            <?php foreach ($gubernur as $g) : ?>
                <div class="card mr-5 mb-3" style="width: 18rem; display:inline-block;">
                    <img src="<?= base_url('assets/img/foto_calon/') . $g['foto']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center; color: black;">No Urut <?= $g['no_urut']; ?></h5>
                        <h6 class="card-title" style="text-align: center; color: black;">Fakultas <?= $g['dapil']; ?></h6>
                        <h5 class="card-text" style="text-align: center; color: black;"><?= $g['nama_ketua'] . " dan " . $g['nama_wakil']; ?></h5>
                        <h5 class="card-text mb-5" style="text-align: center; color: red;"><?= $this->db->get_where('suara', ['gubernur' => $g['dapil'] . $g['no_urut']])->num_rows(); ?> Suara</h5>
                    </div>
                </div>
            <?php endforeach; ?>
            <h3 style="color: black;">DPM Fakultas</h3>
            <?php foreach ($dpmf as $d) : ?>
                <div class="card mr-5 mb-3" style="width: 18rem; display:inline-block;">
                    <img src="<?= base_url('assets/img/foto_calon/') . $d['foto']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center; color: black;">No Urut <?= $d['no_urut']; ?></h5>
                        <h6 class="card-title" style="text-align: center; color: black;">Fakultas <?= $d['fakultas']; ?></h6>
                        <h6 class="card-title" style="text-align: center; color: black;">Jurusan <?= $d['jurusan']; ?></h6>
                        <h5 class="card-text" style="text-align: center; color: black;"><?= $d['nama']; ?></h5>
                        <h5 class="card-text mb-5" style="text-align: center; color: red;"><?= $this->db->get_where('suara', ['dpmf' => $d['fakultas'] . $d['jurusan'] . $d['no_urut']])->num_rows(); ?> Suara</h5>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Page Heading -->