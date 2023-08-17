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
                            <span class="btn btn-sm btn-info">Report Notifikasi</span>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Wali</th>
                                        <th class="text-center">Siswa</th>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($notif as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_ortu']; ?></td>
                                        <td class="text-center"><?= $row['nama_siswa']; ?></td>
                                        <td class="text-center"><?= date('Y-m-j, H:i', $row['time']); ?></td>
                                        <?php 
                                            $category = $row['category'];
                                            $color = ($category == 1) ? 'success' : (($category == 2) ? 'info' : (($category == 3) ? 'primary' : (($category == 4) ? 'warning' : (($category == 5) ? 'secondary' : 'danger'))));
                                            $text = ($category == 1) ? 'Tersambung' : (($category == 2) ? 'Penugasan' : (($category == 3) ? 'Terkumpul' : (($category == 4) ? 'Telat' : (($category == 5) ? 'Materi' : 'Tidak Kumpul'))));                                            
                                        ?>
                                        <td class="text-center"><span class="btn btn-sm btn-<?= $color; ?>"><?= $text; ?></span></td>
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
