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
                    <div class="col-lg">
                        <?= $this->session->flashdata('message'); ?>

                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">Tambah Pemilih</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">NPM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Fakultas</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pemilih as $u) : ?>
                                    <tr>
                                        <th scope="row" style="vertical-align: middle;"><?= $i++; ?></th>
                                        <td><img src="<?= base_url('assets/img/profile/') . $u['foto']; ?>" alt="" class="img-thumbnail" width="70px"></td>
                                        <td style="vertical-align: middle;"><?= $u['npm']; ?></td>
                                        <td style="vertical-align: middle;"><?= $u['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?= $u['email']; ?></td>
                                        <td style="vertical-align: middle;"><?= $u['fakultas']; ?></td>
                                        <td style="vertical-align: middle;"><?= $u['jurusan']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#editMahasiswa<?= $u['id']; ?>">Edit</a>
                                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteMahasiswa<?= $u['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="newSubmenuModal" tabindex="-1" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newSubmenuModalLabel">Tambah Pemilih</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('Admin/datapemilih'); ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="npm" name="npm" placeholder="Masukkan NPM...">
                                        <?= form_error('npm', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password...">
                                        <?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php foreach ($pemilih as $u) : ?>
                    <div class="modal fade" id="editMahasiswa<?= $u['id']; ?>" tabindex="-1" aria-labelledby="editMahasiswaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMahasiswaLabel">Edit data pemilih</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Admin/editPemilih/' . $u['id']); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img src="<?= base_url('assets/img/profile/') . $u['foto']; ?>" class="img-thumbnail">
                                                    </div>
                                                    <div class="div-col-sm-9 mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="foto" name="foto" value="<?= $u['foto']; ?>">
                                                            <label class="custom-file-label" for="foto">Foto Selfie</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="npm" name="npm" placeholder="Masukkan NPM..." value="<?= $u['npm']; ?>">
                                            <?= form_error('npm', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru..">
                                            <?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama..." value="<?= $u['nama']; ?>">
                                            <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email..." value="<?= $u['email']; ?>">
                                            <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-select form-control" aria-label="Default select example" name="fakultas">
                                                <option value="<?= $u['fakultas']; ?>">Pilih Fakultas</option>
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
                                        <div class="form-group">
                                            <select class="form-select form-control" aria-label="Default select example" name="jurusan">
                                                <option value="<?= $u['jurusan']; ?>">Pilih Jurusan</option>
                                                <option value="Bimbingan Konseling">Bimbingan Konseling</option>
                                                <option value="Pendidikan Bahasa Dan Sastra Indonesia">Pendidikan Bahasa Dan Sastra Indonesia</option>
                                                <option value="Pendidikan Bahasa Inggris">Pendidikan Bahasa Inggris</option>
                                                <option value="Pendidikan Biologi">Pendidikan Biologi</option>
                                                <option value="Pendidikan Ekonomi">Pendidikan Ekonomi</option>
                                                <option value="Pendidikan Fisika">Pendidikan Fisika</option>
                                                <option value="Pendidikan Geografi">Pendidikan Geografi</option>
                                                <option value="Pendidikan Jasmani, Kesehatan Dan Rekreasi">Pendidikan Jasmani, Kesehatan Dan Rekreasi</option>
                                                <option value="Pendidikan Kimia">Pendidikan Kimia</option>
                                                <option value="Pendidikan Matematika">Pendidikan Matematika</option>
                                                <option value="Pendidikan Pancasila Dan Kewarganegaraan">Pendidikan Pancasila Dan Kewarganegaraan</option>
                                                <option value="Pendidikan Sejarah">Pendidikan Sejarah</option>
                                                <option value="Pendidikan Seni Tari">Pendidikan Seni Tari</option>
                                                <option value="Pendididikan Bahasa Prancis">Pendididikan Bahasa Prancis</option>
                                                <option value="Pendidikan Anak Usia Dini">Pendidikan Anak Usia Dini</option>
                                            </select>
                                            <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteMahasiswa<?= $u['id']; ?>" tabindex="-1" aria-labelledby="deleteMahasiswa<?= $u['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMahasiswa<?= $u['id']; ?>">Delete Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/deletepemilih/') . $u['id']; ?>" method="POST">
                                    <div class="modal-body">Apakah anda yakin ingin menghapus user <?= $u['npm']; ?> ?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->