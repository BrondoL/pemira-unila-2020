<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Verifikasi Profile !</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" action="<?php echo base_url('auth/verify'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan nama lengkap">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class=" form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/img/385631-lamp2.jpg'); ?>" class="img-thumbnail">
                                                </div>
                                                <div class="div-col-sm-9 mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                                        <label class="custom-file-label" for="foto">Foto Selfie</label>
                                                    </div>
                                                    <p class="ml-2">File .JPEG, .JPG, .PNG - Maks 1 MB</p>
                                                </div>
                                                <?php if (isset($error)) : ?>
                                                    <?php foreach ($error as $e) : ?>
                                                        <small class="text-danger pl-3"><?= $e; ?></small>
                                                    <?php endforeach; ?>
                                                    <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select form-control" aria-label="Default select example" name="fakultas" onchange="showJurusan(this.value)">
                                            <option value="___">Pilih Fakultas</option>
                                            <option value="Keguruan Dan ilmu Pendidikan">FKIP</option>
                                            <option value="Matematika dan Ilmu Pengetahuan Alam">FMIPA</option>
                                            <option value="Ilmu Sosial dan Ilmu Politik">FISIP</option>
                                            <option value="Ekonomi dan Bisnis">FEB</option>
                                            <option value="Hukum">F.Hukum</option>
                                            <option value="Kedokteran">F.Kedokteran</option>
                                            <option value="Pertanian">F.Pertanian</option>
                                            <option value="Teknik">F.Teknik</option>
                                        </select>
                                        <?= form_error('fakultas', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group" id="form_jurusan">
                                        <input type="text" class="form-control form-control-user" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan">
                                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <center>
                                        <button type=" submit" class="btn btn-primary btn-user btn-block col-lg-3 text-center">
                                            Verifikasi
                                        </button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>