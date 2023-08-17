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
                            <a class="btn btn-sm btn-primary" href="javascript:history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>
                            <span class="btn btn-sm btn-info">Daftar Kelas Diampu</span>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Pelajaran</th>
                                        <th class="text-center">Guru</th>
                                        <th class="text-center">Siswa</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($pelajaran as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                            <td class="text-center"><?= $row['nama_pelajaran']; ?></td>
                                            <td class="text-center"><?= $row['nama_guru']; ?></td>
                                            <td class="text-center"><a href="<?= base_url('guru/kelas/'.$row['id_kelas']); ?>" class="btn btn-sm btn-info">view</a></td>
                                            <td class="text-center">
                                                <div class="dropdown float-right">
                                                    <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </a>
                                                    <div class="user-menu dropdown-menu">
                                                        <a class="dropdown-item text-light bg-primary" data-toggle="modal" data-target="#addtugas_<?= $row['id_topik']; ?>" href="#"><i class="fa fa-paper-plane"></i> Penugasan</a>
                                                        <a class="dropdown-item text-light bg-info" data-toggle="modal" data-target="#addmateri_<?= $row['id_topik']; ?>" href="#"><i class="fa fa-paper-plane"></i> Materi</a>
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

<!-- add tugas -->
<?php foreach ($pelajaran as $row) : ?>
<div class="modal fade" id="addtugas_<?= $row['id_topik']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"><b>Kirim Penugasan Kelas</b></h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('guru-add-tugas'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Pelajaran</label>
                        <input type="text" class="form-control" value="<?= $row['nama_pelajaran']; ?>" readonly>
                        <input type="hidden" class="form-control" value="<?= $row['id_guru']; ?>" name="id_guru">
                        <input type="hidden" class="form-control" value="<?= $row['id_topik']; ?>" name="id_topik">
                        <input type="hidden" class="form-control" value="<?= $row['id_kelas']; ?>" name="id_kelas">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="Judul">Deadline Tugas</label>
                        <input type="datetime-local"class="form-control" id="deadline" name="deadline" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File Tugas <span class="text-danger">(Optional)</span></label>
                        <input type="file" class="form-control" id="file<?= $row['id_topik']; ?>" name="file" accept="application/pdf">
                    </div>
                    <script>
                        document.getElementById("file<?= $row['id_topik']; ?>").addEventListener('change', function() {
                            var fileInput = this;
                            var files = fileInput.files;
                            var allowedTypes = ['application/pdf'];

                            if (files.length > 0) {
                                var fileType = files[0].type;

                                if (!allowedTypes.includes(fileType)) {
                                    fileInput.value = '';

                                    alert('Hanya file PDF yang diizinkan.');
                                }
                            }
                        });
                    </script>
                    <div class="form-group">
                        <label for="Judul">Deskripsi Tugas</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Tugas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- add Materi -->
<?php foreach ($pelajaran as $row) : ?>
<div class="modal fade" id="addmateri_<?= $row['id_topik']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"><b>Kirim Materi Kelas</b></h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('guru-add-materi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Pelajaran</label>
                        <input type="text" class="form-control" value="<?= $row['nama_pelajaran']; ?>" readonly>
                        <input type="hidden" class="form-control" value="<?= $row['id_guru']; ?>" name="id_guru">
                        <input type="hidden" class="form-control" value="<?= $row['id_topik']; ?>" name="id_topik">
                        <input type="hidden" class="form-control" value="<?= $row['id_pelajaran']; ?>" name="id_pelajaran">
                        <input type="hidden" class="form-control" value="<?= $row['id_kelas']; ?>" name="id_kelas">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Materi</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File Materi <span class="text-danger">(Optional)</span></label>
                        <input type="file" class="form-control" id="file_<?= $row['id_topik']; ?>" name="file" accept="application/pdf">
                    </div>
                    <script>
                        document.getElementById("file_<?= $row['id_topik']; ?>").addEventListener('change', function() {
                            var fileInput = this;
                            var files = fileInput.files;
                            var allowedTypes = ['application/pdf'];

                            if (files.length > 0) {
                                var fileType = files[0].type;

                                if (!allowedTypes.includes(fileType)) {
                                    fileInput.value = '';

                                    alert('Hanya file PDF yang diizinkan.');
                                }
                            }
                        });
                    </script>
                    <div class="form-group">
                        <label for="Judul">Deskripsi Materi</label>
                        <textarea class="form-control" name="deskripsi" id="materi_<?= $row['id_topik']; ?>" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Materi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
