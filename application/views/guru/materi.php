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
                            <span class="btn btn-sm btn-info"> Daftar Materi</span>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <!-- <th class="text-center">Pelajaran</th> -->
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Terkirim</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($materi as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <!-- <td class="text-center"><?= $row['nama_pelajaran']; ?></td> -->
                                        <td class="text-center"><?= $row['judul_materi']; ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td class="text-center"><?= date('d m Y H:i', $row['created']); ?></td>
                                        <td class="text-center">
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link bg-info text-light" data-toggle="modal" data-target="#details_<?= $row['id_materi']; ?>" href="#">Details</a>
                                                    <a class="nav-link bg-danger text-light" href="<?= base_url('guru-delete-materi/'.$row['id_materi']); ?>">Delete</a>
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

<!-- details -->
<?php foreach ($materi as $row) : ?>
<div class="modal fade" id="details_<?= $row['id_materi']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="min-height: 80vh;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="my-2">
                    <textarea class="form-control" cols="30" rows="3"><?= $row['deskripsi']; ?></textarea>
                </div>
                <iframe src="<?= base_url('assets/materi/'.$row['file_materi']); ?>" frameborder="0"
                style="width:100%; height:600px;"></iframe>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
