<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-1ß">
                        <a href="<?= base_url(''); ?>" class="app-brand-link gap-2">
                            <img src="<?= base_url('assets/img/logo-pui.png'); ?>" alt="logo MTs PUI"
                                class="logo">
                            <style>
                            .logo {
                                width: 120px;
                            }
                            </style>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="text-center">
                        <h4 class="mb-2">Validasi Data</h4>
                        <p class="mb-4">Jangan Lupa Kunjungi channel telegram <br> Dapatkan <a target="_blank" href="https://t.me/NotifikasiTugasSekolah_bot" class="text-primary">Chat ID</a></p>
                    </div>

                    <!-- flash data -->
                    <?= $this->session->flashdata('message'); ?>

                    <!-- login -->
                    <form id="formAuthentication" class="mb-3" action="<?= base_url('validasi-siswa'); ?>" method="POST">

                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $siswa->nisn; ?>" readonly />
                        </div>
                        <?php
                            $name = $siswa->nama_siswa;
                            $maskedName = preg_replace('/\b(\w)\w*\b/', '$1***', $name);
                        ?>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Nama Siswa</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="text" id="nama" class="form-control" name="nama" aria-describedby="nama" value="<?= $maskedName; ?>" readonly />
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="namawali">Nama Anda<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="text" id="namawali" class="form-control" name="namawali" aria-describedby="namawali" required/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="birthday">Tanggal Kelahiran Siswa<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="date" id="birthday" class="form-control" name="birthday" aria-describedby="birthday"  required/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="chatid">Chat ID<span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="number" id="chatid" class="form-control" name="chatid" aria-describedby="chatid"  required/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Validasi</button>
                        </div>

                        <div class="mb-3">
                            <a target="_blank" href="https://t.me/NotifikasiTugasSekolah_bot" class="btn btn-success d-grid w-50" type="submit">Channel Telegram</a>
                        </div>

                    </form>
                    <!-- end login -->

                </div>
            </div>
        </div>
    </div>
</div>