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
                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#addkelas"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Kelas</a>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Nama Kelas</th>
                                        <th class="text-center">Total Siswa</th>
                                        <th class="text-center">Anggota</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($kelas as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td class="text-center"><?= $this->db->get_where('tb_siswa', ['id_kelas' => $row['id_kelas']])->num_rows(); ?> Siswa</td>
                                        <td class="text-center"><a href="<?= base_url('admin/kelas/'. $row['id_kelas']); ?>" class="btn btn-sm btn-info">view</a></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link text-primary" data-toggle="modal"
                                                        data-target="#editkelas_<?= $row['id_kelas']; ?>" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                    </a>
                                                    <a class="nav-link text-danger" href="<?= base_url('admin-delete-kelas/'. $row['id_kelas']); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
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
<div class="modal fade" id="addkelas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Kelas</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin-add-kelas'); ?>">
                    <div class="form-group">
                        <label for="nama">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
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
<?php foreach ($kelas as $row) : ?>
    <div class="modal fade" id="editkelas_<?= $row['id_kelas']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-guru'); ?>">
                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <input type="text" class="form-control" value="<?= $row['nama_kelas']; ?>" id="editnama" name="editnama" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_kelas']; ?>" id="id_kelas" name="id_kelas">
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
