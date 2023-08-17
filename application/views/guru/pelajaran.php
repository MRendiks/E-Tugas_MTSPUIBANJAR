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
                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#addkelas"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Mata Pelajaran</a>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Total Kelas</th>
                                        <th class="text-center">Kelas</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($pelajaran as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_pelajaran']; ?></td>
                                        <td class="text-center"><?= $this->db->get_where('stb_topik_pembelajaran', ['id_pelajaran' => $row['id_pelajaran']])->num_rows(); ?> Kelas</td>
                                        <td class="text-center"><a href="<?= base_url('admin/pelajaran/'. $row['id_pelajaran']); ?>" class="btn btn-sm btn-info">view</a></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link text-primary" data-toggle="modal"
                                                        data-target="#editpelajaran_<?= $row['id_pelajaran']; ?>" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                    </a>
                                                    <a class="nav-link text-danger" href="<?= base_url('admin-delete-pelajaran/'. $row['id_pelajaran']); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Mata Pelajaran</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin-add-mapel'); ?>">
                    <div class="form-group">
                        <label for="nama">Nama Pelajaran</label>
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
<?php foreach ($pelajaran as $row) : ?>
    <div class="modal fade" id="editpelajaran_<?= $row['id_pelajaran']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-pelajaran'); ?>">
                        <div class="form-group">
                            <label for="nama">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" value="<?= $row['nama_pelajaran']; ?>" id="editnama" name="editnama" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_pelajaran']; ?>" id="id_pelajaran" name="id_pelajaran">
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