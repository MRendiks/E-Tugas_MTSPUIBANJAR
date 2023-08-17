<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="R17 Dashboard Creator">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo-pui.png'); ?>" />

    <!-- tiny -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.js" integrity="sha512-JbRQ4jMeFl9Iem8w6WYJDcWQYNCEHP/LpOA11LaqnbJgDV6Y8oNB9Fx5Ekc5O37SwhgnNJdmnasdwiEdvMjW2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="<?= base_url('assets/templates/'); ?>assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url('assets/templates/'); ?>assets/css/style.css">
    <script src="<?= base_url('assets/tinymce/js/tinymce/'); ?>tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet"
        href="<?= base_url('assets/templates/'); ?>assets/css/lib/datatable/dataTables.bootstrap.min.css" />

    <style>
    #weatherWidget .currentDesc {
        color: #ffffff !important;
    }

    .traffic-chart {
        min-height: 335px;
    }

    #flotPie1 {
        height: 150px;
    }

    #flotPie1 td {
        padding: 3px;
    }

    #flotPie1 table {
        top: 20px !important;
        right: -10px !important;
    }

    .chart-container {
        display: table;
        min-width: 270px;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #flotLine5 {
        height: 105px;
    }

    #flotBarChart {
        height: 150px;
    }

    #cellPaiChart {
        height: 160px;
    }
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">Main</li>
                    <li class="<?= ($page == 'dashboard') ? 'active' : ''; ?>">
                        <a href="<?= base_url('guru/dashboard'); ?>"><i class="menu-icon fa fa-laptop"></i><b>Dashboard</b> </a>
                    </li>
                
                    <li class="menu-title">Menages Kelas</li>
                    <li class="<?= ($page == 'kelas') ? 'active' : ''; ?>">
                        <a class="mt-0" href="<?= base_url('guru/kelas'); ?>"><i class="menu-icon fa fa-book"></i><b>Data Kelas</b></a>
                    </li>
                    <li class="<?= ($page == 'nilai') ? 'active' : ''; ?>">
                        <a class="mt-0" href="<?= base_url('guru/nilai'); ?>"><i class="menu-icon fa fa-book"></i><b>Data Nilai</b></a>
                    </li>
                    <li class="<?= ($page == 'tugas') ? 'active' : ''; ?>">
                        <a class="mt-0" href="<?= base_url('guru/tugas'); ?>"><i class="menu-icon fa fa-book"></i><b>Data Tugas</b></a>
                    </li>
                    <li class="<?= ($page == 'materi') ? 'active' : ''; ?>">
                        <a class="mt-0" href="<?= base_url('guru/materi'); ?>"><i class="menu-icon fa fa-book"></i><b>Data Materi</b></a>
                    </li>
                    <li class="<?= ($page == 'password') ? 'active' : ''; ?>">
                        <a class="mt-0" data-toggle="modal"data-target="#passwordguru" href="#"><i class="menu-icon fa fa-book"></i><b>Ganti Password</b></a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </aside>
    <!-- /#left-panel -->

    <!-- modal change password -->
    <?php foreach ($guru as $row) : ?>
        <div class="modal fade" id="passwordguru" tabindex="-1" role="dialog"
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
                        <form method="POST" action="<?= base_url('guru-update-password-guru'); ?>">
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

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <span class="navbar-brand flat-color-1"><b>MTs PUI Banjarsari</b></span>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="row">
                        <div class="col mt-3">
                            <p>Hallo <b><?= $user['nama_guru']; ?></b> you are <span class="text-info"><?= $user['title_guru']; ?></span></p>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle" width="200" height="40"
                                src="<?= base_url('assets/img/logo-pui.png'); ?>" alt="Photo Profile">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link text-danger" href="<?= base_url('logout'); ?>"><i
                                    class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

       