<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">

        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center"><b><span id="current-time"></span></b></h2>

                            <script>
                                function updateTime() {
                                    const currentTime = new Date();
                                    const options = {
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        second: 'numeric',
                                        timeZone: 'Asia/Jakarta',
                                        hour12: false
                                    };
                                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    const formattedTime = days[currentTime.getDay()] + ', ' + currentTime.toLocaleString('en-US', options);
                                    document.getElementById("current-time").textContent = formattedTime + ' WIB';
                                }

                                setInterval(updateTime, 1000);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widgets  -->
        <div class="row">
            <!-- news -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-news-paper"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('tb_pelajaran')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Pelajaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- company -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-home"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('tb_kelas')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Kelas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- careers -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-notebook"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('stb_tugas')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Tugas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- events -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('tb_guru')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Guru</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- direksi -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('tb_siswa')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Siswa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- candidate -->
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?= $this->db->get('tb_orangtua')->num_rows(); ?></span></div>
                                    <div class="stat-heading">Wali</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <div class="clearfix"></div>
        <!-- Orders -->
        
    </div>
</div>