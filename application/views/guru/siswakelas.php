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
                            <a class="btn btn-sm btn-info" href="<?= base_url('guru/kelas/'); ?>">Daftar Kelas Diampu</a>
                            <span class="btn btn-sm btn-secondary">Siswa <?= $kelas->nama_kelas; ?></span>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-center">Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($pelajaran as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $row['nama_kelas']; ?></td>
                                            <td class="text-center"><?= $row['nisn']; ?></td>
                                            <td class="text-center"><?= $row['nama_siswa']; ?></td>
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
