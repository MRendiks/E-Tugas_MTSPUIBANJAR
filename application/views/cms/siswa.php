<!-- Content -->
<div class="content">
    <div class="animated fadeIn">
        <div class="clearfix"></div>
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="row mx-3 mt-2">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#addguru"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Siswa</a>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Kelas</th>
                                        
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($siswa as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nisn']; ?></td>
                                        <td class="text-center"><?= $row['nama_siswa']; ?></td>
                                        <td class="text-center"><?= date("d-m-Y", strtotime($row['ttl_siswa'])); ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link text-info" data-toggle="modal"
                                                        data-target="#passwordsiswa_<?= $row['id_siswa']; ?>" href="#">
                                                        <i class="fa fa-pencil"></i> Password <hr>
                                                    </a>
                                                    <a class="nav-link text-primary" data-toggle="modal"
                                                        data-target="#editsiswa_<?= $row['id_siswa']; ?>" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit <hr>
                                                    </a>
                                                    <a class="nav-link text-danger" href="<?= base_url('admin-delete-siswa/'.$row['id_siswa']); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
                                                        <i class="fa fa-ban"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add -->
<div class="modal fade" id="addguru" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Siswa</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin-add-siswa'); ?>">
                    <div class="form-group">
                        <label for="nisn">NISN Siswa</label>
                        <input type="number" class="form-control" id="nisn" name="nisn" autocomplete="off" required>
                        <span class="text-danger" id="message"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas Siswa</label>
                        <select class="form-control" aria-label="Default select example" name="kelas" id="kelas">
                            <option selected disabled>Pilih Kelas</option>
                            <?php foreach ($kelas as $row) : ?>
                            <option value="<?= $row['id_kelas']; ?>"><?= $row['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Tanggal Lahir Siswa</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal change data -->
<?php foreach ($siswa as $row) : ?>
    <div class="modal fade" id="editsiswa_<?= $row['id_siswa']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Siswa</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-siswa'); ?>">
                        <div class="form-group">
                            <label for="nisn">NISN Siswa</label>
                            <input type="number" class="form-control" id="nisn" name="nisn" autocomplete="off" readonly required value="<?= $row['nisn']; ?>">
                            <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?= $row['id_siswa']; ?>">
                            <span class="text-danger" id="message"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required value="<?= $row['nama_siswa']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas Siswa</label>
                            <select class="form-control" aria-label="Default select example" name="kelas" id="kelas">
                                <option selected disabled>Pilih Kelas</option>
                                <?php foreach ($kelas as $kel) : ?>
                                <option <?= ($row['id_kelas'] == $kel['id_kelas']) ? 'selected' : ''; ?> value="<?= $kel['id_kelas']; ?>"><?= $kel['nama_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Tanggal Lahir Siswa</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" autocomplete="off" required value="<?= $row['ttl_siswa']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal change password -->
<?php foreach ($siswa as $row) : ?>
    <div class="modal fade" id="passwordsiswa_<?= $row['id_siswa']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password Siswa</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-password-siswa'); ?>">
                        <div class="form-group">
                            <label for="username">Username Siswa</label>
                            <input type="text" class="form-control" value="<?= $row['nisn']; ?>" id="editusername" name="editusername" autocomplete="off" readonly required>
                        </div>    
                        <div class="form-group">
                            <label for="nama">New Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_siswa']; ?>" id="id_user" name="id_user">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>