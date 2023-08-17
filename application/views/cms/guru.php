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
                            <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#addguru"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Tambah Guru</a>

                            <div class="mb-2"></div>

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="serial">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Username</th>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;  foreach ($guru as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['nama_guru']; ?></td>
                                        <td class="text-center"><?= $row['title_guru']; ?></td>
                                        <td class="text-center"><?= date("d-m-Y", strtotime($row['ttl_guru'])); ?></td>
                                        <td class="text-center"><?= $row['username']; ?></td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a class="btn btn-sm btn-primary text-light dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </a>
                                                <div class="user-menu dropdown-menu">
                                                    <a class="nav-link text-info" data-toggle="modal"
                                                        data-target="#passwordguru_<?= $row['id_guru']; ?>" href="#">
                                                        <i class="fa fa-pencil"></i> Password <hr>
                                                    </a>
                                                    <a class="nav-link text-primary" data-toggle="modal"
                                                        data-target="#editguru_<?= $row['id_guru']; ?>" href="#">
                                                        <i class="fa fa-pencil-square-o"></i> Edit <hr>
                                                    </a>
                                                    <a class="nav-link text-danger" href="<?= base_url('admin-delete-guru/'. $row['id_guru']); ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?')">
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
<div class="modal fade" id="addguru" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Guru</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin-add-guru'); ?>">
                    <div class="form-group">
                        <label for="nama">Nama Guru</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan Guru</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Tanggal Lahir Guru</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username Guru</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                        <span class="text-danger" id="pesan"></span>
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
<?php foreach ($guru as $row) : ?>
    <div class="modal fade" id="editguru_<?= $row['id_guru']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Guru</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-guru'); ?>">
                        <div class="form-group">
                            <label for="nama">Nama Guru</label>
                            <input type="text" class="form-control" value="<?= $row['nama_guru']; ?>" id="editnama" name="editnama" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_guru']; ?>" id="id_guru" name="id_guru">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan Guru</label>
                            <input type="text" class="form-control" value="<?= $row['title_guru']; ?>" id="editjabatan" name="editjabatan" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Tanggal Lahir Guru</label>
                            <input type="date" class="form-control" value="<?= $row['ttl_guru']; ?>" id="editbirthday" name="editbirthday" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username Guru</label>
                            <input type="text" class="form-control" value="<?= $row['username']; ?>" id="editusername" name="editusername" autocomplete="off" readonly required>
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

<!-- modal change password -->
<?php foreach ($guru as $row) : ?>
    <div class="modal fade" id="passwordguru_<?= $row['id_guru']; ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password Guru</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin-update-password-guru'); ?>">
                        <div class="form-group">
                            <label for="username">Username Guru</label>
                            <input type="text" class="form-control" value="<?= $row['username']; ?>" id="editusername" name="editusername" autocomplete="off" readonly required>
                        </div>    
                        <div class="form-group">
                            <label for="nama">New Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off" required>
                            <input type="hidden" value="<?= $row['id_guru']; ?>" id="id_user" name="id_user">
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


<script>
    var usernameInput = document.getElementById("username");

    usernameInput.onkeyup = function() {
    this.value = this.value.replace(/\s/g, ""); 
    };
</script>