<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <center>
        <h1 class="h3 mb-4 text-gray-800">Pemilihan DPM Universitas</h1>
    </center>
    <?php foreach ($dpmu as $d) : ?>
        <div class="card mr-5 mb-3" style="width: 18rem; display:inline-block;">
            <img src="<?= base_url('assets/img/foto_calon/') . $d['foto']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; color: black;"><?= $d['no_urut']; ?></h5>
                <h5 class="card-text mb-5" style="text-align: center; color: black;"><?= $d['nama']; ?></h5>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <a href="<?= base_url('user/pilihDpmu/') . $d['id']; ?>" class="btn btn-danger" onclick="return confirm ('apakah anda yakin?');">Pilih</a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <a href="<?= base_url('user/detailDpmu/') . $d['id']; ?>" class="btn btn-warning">Details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->