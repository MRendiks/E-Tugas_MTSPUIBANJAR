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
                            <span class="btn btn-sm btn-info">Tugas : <?= $tugas->judul_tugas; ?></span>
                            <a class="btn btn-sm btn-success ml-5" href="<?= base_url('guru/rekap_tugas/'. $id1 . '/'. $id2);?>">Cetak</a>
                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Terkirim</th>
                                        <th class="text-center">Status</th>
                                        <th style="width: 5%;" class="text-center">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($pengumpulan as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $row['nisn']; ?></td>
                                            <td class="text-center"><?= $row['nama_siswa']; ?></td>
                                            <td class="text-center"><?= date("d-m-Y H:i", $row['uploaded']); ?></td>
                                            <?php 
                                                $color = ($row['status'] == 0) ? 'warning' : (($row['status'] == 1) ? 'success' : (($row['status'] == 2) ? 'secondary' : 'danger'));
                                                $text = ($row['status'] == 0) ? 'BELUM' : (($row['status'] == 1) ? 'SUDAH' : (($row['status'] == 2) ? 'DINILAI' : 'TIDAK'));
                                            ?>
                                            <td class="text-center"><span class="btn btn-sm btn-<?= $color; ?>"><?= $text; ?></span></td>
                                            <td>
                                                <div class="dropdown float-right">
                                                    <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </a>
                                                    <div class="user-menu dropdown-menu">
                                                        <a class="nav-link text-info" data-toggle="modal"
                                                            data-target="#cek_<?= $row['nisn']; ?>" href="#">
                                                            <i class="fa fa-pencil"></i> Check Tugas
                                                        </a>
                                                        <a class="nav-link text-primary" data-toggle="modal"
                                                            data-target="#nilai_<?= $row['nisn']; ?>" href="#">
                                                            <i class="fa fa-pencil-square-o"></i> Nilai
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
<?php foreach ($pengumpulan as $row) : ?>
<div class="modal fade" id="cek_<?= $row['nisn']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Siswa : <?= $row['nama_siswa']; ?></h5>
            </div>
            <div class="modal-body">
            <?php
                $pdfPath = base_url('assets/jawaban/'.$row['file_jawaban']);
            ?>
            <iframe src="<?= $pdfPath; ?>" width="100%" height="600px">
                Maaf, browser Anda tidak mendukung pratinjau PDF. Silakan <a href="<?= $pdfPath; ?>">unduh file PDF</a> untuk melihatnya.
            </iframe>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- modal Nilai -->
<?php foreach ($pengumpulan as $row) : ?>
<div class="modal fade" id="nilai_<?= $row['nisn']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Siswa : <?= $row['nama_siswa']; ?></h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('guru-nilai-tugas'); ?>">
                    <div class="form-group">
                        <label for="nama">Input Nilai</label>
                        <input type="number" class="form-control" id="<?= $row['nisn']; ?>" name="nilai" autocomplete="off" min="0" max="100" required>
                        <input type="hidden" class="form-control" name="id_tugas" value="<?= $row['id_tugas']; ?>">
                        <input type="hidden" class="form-control" name="id_siswa" value="<?= $row['id_siswa']; ?>">
                        <input type="hidden" class="form-control" name="id1" value="<?= $id1; ?>">
                        <input type="hidden" class="form-control" name="id2" value="<?= $id2; ?>">
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
