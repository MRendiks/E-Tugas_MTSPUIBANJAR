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
                            <span class="btn btn-sm btn-info"> Daftar Penugasan</span>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Pelajaran</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Terkirim</th>
                                        <th class="text-center">Deadline</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($tugas as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_pelajaran']; ?></td>
                                        <td class="text-center"><?= $row['judul_tugas']; ?></td>
                                        <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                        <td class="text-center"><?= date('Y/m/d H:i', $row['created']); ?></td>
                                        <td class="text-center"><?= date('Y/m/d H:i', $row['deadline']); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="<?= base_url('guru/tugas/'.$row['id_tugas'].'/'.$row['id_kelas']); ?>">Details</a>
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