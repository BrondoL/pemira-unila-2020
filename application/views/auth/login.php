<center>
    <span class="login-logo">
        <img alt="" src="<?= base_url() ?>assets/img/unila.png" style="width: 100px; border-style: none;">
    </span>
</center>
<!-- /.login-logo -->
<div class="card mt-3">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in untuk mulai memilih</p>
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('auth'); ?>" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Nomor Pokok Mahasiswa" name="npm">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <?= form_error('npm', '<small class="text-danger pl-1">', '</small>'); ?>
            <div class="input-group mt-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
            <div class="row d-flex justify-content-center mt-3">
                <!-- /.col -->
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-card-body -->
</div>