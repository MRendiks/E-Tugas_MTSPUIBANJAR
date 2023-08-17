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
                            <a class="btn btn-sm btn-info" href="javascript:history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Guru</th>
                                        <th class="text-center">anggota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($pelajaran as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_pelajaran']; ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td class="text-center"><?= $row['nama_guru']; ?></td>
                                        <td class="text-center"><a href="<?= base_url('admin/kelas/'. $row['id_kelas']); ?>" class="btn btn-sm btn-info">view</a></td>
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