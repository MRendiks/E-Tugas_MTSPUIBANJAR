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
                                        <th class="text-center">Topik Pelajaran</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Guru</th>
                                        <th style="width: 5%;" class="text-center">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($pelajaran as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['judul_topik']; ?></td>
                                        <td class="text-center"><?= $row['nama_pelajaran']; ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td class="text-center"><?= $row['nama_guru']; ?></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link bg-info text-light" data-toggle="modal"
                                                        data-target="#edit_topik<?= $row['id_topik']; ?>" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                    </a>
                                                    <a class="nav-link bg-danger text-light" href="<?= base_url('admin-delete-topik/'. $row['id_topik']); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
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

<!-- modal Topik Belajar -->
<?php foreach ($pelajaran as $row) : ?>
    <div class="modal fade" id="edit_topik<?= $row['id_topik']; ?>" tabindex="-1" role="dialog"
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
                    <form method="POST" action="<?= base_url('admin-update-topik-pelajaran'); ?>">

                        <div class="form-group">
                            <label for="nama">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" value="<?= $row['nama_pelajaran']; ?>" id="editnama" readonly name="editnama" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_topik']; ?>" id="id_topik" name="id_topik">
                            <input type="hidden" value="<?= $row['id_pelajaran']; ?>" id="id_pelajaran" name="id_pelajaran">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <select class="form-control" name="kelas" id="kelas">
                                <?php $cek_kelas = $this->db->get('stb_topik_pembelajaran')->result_array(); ?>
                                <?php foreach ($kelas as $kel) : ?>
                                    <?php $disabled = false; ?>
                                    <?php foreach ($cek_kelas as $cek) {
                                        if ($cek['id_topik'] == $row['id_topik'] && $cek['id_kelas'] == $kel['id_kelas']) {
                                            $disabled = true;
                                            break;
                                        }
                                    } ?>
                                    <option <?= $disabled ? 'disabled' : ''; ?> value="<?= $kel['id_kelas']; ?>"><?= $kel['nama_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Guru</label>
                            <select class="form-control" name="guru" id="guru">
                                <?php foreach ($guru as $gur) : ?>
                                    <option value="<?= $gur['id_guru']; ?>"><?= $gur['nama_guru']; ?> - <?= $gur['title_guru']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topik">Judul Topik Pelajaran</label>
                            <input type="text" class="form-control" value="Belajar <?= $row['nama_pelajaran']; ?>" id="topik" name="topik" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="deksripsi">Deskripsi Topik Pelajaran</label>
                            <textarea class="form-control" name="deksripsi" id="deksripsi" cols="30" rows="3" required>Belajar Bersama Tentang <?= $row['nama_pelajaran']; ?></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>