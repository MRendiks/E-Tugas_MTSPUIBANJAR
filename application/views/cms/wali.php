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
                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Nama Orang Tua</th>
                                        <th class="text-center">Chat ID</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Dibuat</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($wali as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_ortu']; ?></td>
                                        <td class="text-center"><?= $row['chat_id']; ?></td>
                                        <td class="text-center"><?= $row['nama_siswa']; ?></td>
                                        <td class="text-center"><?= $row['created']; ?></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link text-primary" data-toggle="modal"
                                                        data-target="#editguru_" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                    </a>
                                                    <a class="nav-link text-danger" href="<?= base_url('admin-delete-siswa/'); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
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
