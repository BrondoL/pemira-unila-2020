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

                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">Tambah Calon</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">No. Urut</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($presiden as $p) : ?>
                                    <tr>
                                        <th scope="row" style="vertical-align: middle;"><?= $i++; ?></th>
                                        <td><img src="<?= base_url('assets/img/foto_calon/') . $p['foto']; ?>" alt="" class="img-thumbnail" width="70px"></td>
                                        <td style="vertical-align: middle;"><?= $p['no_urut']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#editMahasiswa<?= $p['id']; ?>">Edit</a>
                                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteMahasiswa<?= $p['id']; ?>">Delete</a>
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
                                <h5 class="modal-title" id="newSubmenuModalLabel">Tambah Calon</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('Admin/presiden'); ?>" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="No Urut...">
                                        <?= form_error('no_urut', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="div-col-sm-9 mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="foto">Foto Paslon</label>
                                        </div>
                                        <?= form_error('foto', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" placeholder="Masukkan Nama Ketua...">
                                        <?= form_error('nama_ketua', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_wakil" name="nama_wakil" placeholder="Masukkan Nama Wakil...">
                                        <?= form_error('nama_wakil', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select form-control" aria-label="Default select example" name="fak_ketua">
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
                                        <?= form_error('fak_ketua', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select form-control" aria-label="Default select example" name="fak_wakil">
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
                                        <?= form_error('fak_wakil', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="jur_ketua" name="jur_ketua" placeholder="Masukkan Jurusan Ketua...">
                                        <?= form_error('jur_ketua', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="jur_wakil" name="jur_wakil" placeholder="Masukkan Jurusan Wakil...">
                                        <?= form_error('jur_wakil', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="visi" name="visi" placeholder="Masukkan Visi...">
                                        <?= form_error('visi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="misi">Masukkan Misi...</label>
                                        <textarea class="form-control" id="misi" rows="3" name="misi"></textarea>
                                        <?= form_error('misi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
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

                <?php foreach ($presiden as $p) : ?>
                    <div class="modal fade" id="editMahasiswa<?= $p['id']; ?>" tabindex="-1" aria-labelledby="editMahasiswaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMahasiswaLabel">Edit data pemilih</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Admin/editPresiden/' . $p['id']); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="No Urut..." value="<?= $p['no_urut']; ?>">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img src="<?= base_url('assets/img/foto_calon/') . $p['foto']; ?>" class="img-thumbnail">
                                                    </div>
                                                    <div class="div-col-sm-9 mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="foto" name="foto" value="<?= $p['foto']; ?>">
                                                            <label class="custom-file-label" for="foto">Foto Paslon</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" placeholder="Masukkan Nama Ketua..." value="<?= $p['nama_ketua']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nama_wakil" name="nama_wakil" placeholder="Masukkan Nama Wakil..." value="<?= $p['nama_wakil']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-select form-control" aria-label="Default select example" name="fak_ketua">
                                                <option value="<?= $p['fak_ketua']; ?>">Pilih Fakultas</option>
                                                <option value="Keguruan Dan ilmu Pendidikan">FKIP</option>
                                                <option value="Matematika dan Ilmu Pengetahuan Alam">FMIPA</option>
                                                <option value="Ilmu Sosial dan Ilmu Politik">FISIP</option>
                                                <option value="Ekonomi dan Bisnis">FEB</option>
                                                <option value="Hukum">F.Hukum</option>
                                                <option value="Kedokteran">F.Kedokteran</option>
                                                <option value="Pertanian">F.Pertanian</option>
                                                <option value="Teknik">F.Teknik</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-select form-control" aria-label="Default select example" name="fak_wakil">
                                                <option value="<?= $p['fak_wakil']; ?>">Pilih Fakultas</option>
                                                <option value="Keguruan Dan ilmu Pendidikan">FKIP</option>
                                                <option value="Matematika dan Ilmu Pengetahuan Alam">FMIPA</option>
                                                <option value="Ilmu Sosial dan Ilmu Politik">FISIP</option>
                                                <option value="Ekonomi dan Bisnis">FEB</option>
                                                <option value="Hukum">F.Hukum</option>
                                                <option value="Kedokteran">F.Kedokteran</option>
                                                <option value="Pertanian">F.Pertanian</option>
                                                <option value="Teknik">F.Teknik</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="jur_ketua" name="jur_ketua" placeholder="Masukkan Jurusan Ketua..." value="<?= $p['jur_ketua']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="jur_wakil" name="jur_wakil" placeholder="Masukkan Jurusan Wakil..." value="<?= $p['jur_wakil']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="visi" name="visi" placeholder="Masukkan Visi..." value="<?= $p['visi']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="misi">Masukkan Misi...</label>
                                            <textarea class="form-control" id="misi" rows="3" name="misi"><?= $p['misi']; ?></textarea>
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

                    <div class="modal fade" id="deleteMahasiswa<?= $p['id']; ?>" tabindex="-1" aria-labelledby="deleteMahasiswa<?= $p['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMahasiswa<?= $p['id']; ?>">Delete Paslon</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/deletepresiden/') . $p['id']; ?>" method="POST">
                                    <div class="modal-body">Apakah anda yakin ingin menghapus No Urut <?= $p['no_urut']; ?> ?</div>
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