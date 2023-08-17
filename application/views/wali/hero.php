
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MTs PUI Banjarsari</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Luthfi Imron" />

    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo-pui.png'); ?>" />

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.css" integrity="sha512-yX1R8uWi11xPfY7HDg7rkLL/9F1jq8Hyiz8qF4DV2nedX4IVl7ruR2+h3TFceHIcT5Oq7ooKi09UZbI39B7ylw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/aos.css">
    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/rangeslider.css">

    <link rel="stylesheet" href="<?= base_url('assets/wali/'); ?>css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar" role="banner">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-11 col-xl-2">
            <h2 class="mb-0 site-logo"><a href="<?= base_url(''); ?>" class="text-white h3 mb-0">
              <img src="<?= base_url('assets/img/logo-pui.png'); ?>" alt="Logo MTs PUI" class="logo-img" width="35"> <b>MTs PUI</b></a>
            </h2>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="<?= base_url('login'); ?>"><span>Login</span></a></li>
              </ul>
            </nav>
          </div>
          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
          </div>
        </div>
      </div>
    </header>

    <div class="site-blocks-cover overlay" style="background-image: url(<?= base_url('assets/img/mtspui-bg.png'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">
            
            <div class="row justify-content-center mb-4">
              <div class="col-md-10 text-center">
                <h1 class="h2" data-aos="fade-up">MTs PUI Banjarsari <span class="typed-words"></span></h1>
                <h3 class="text-light h5" data-aos="fade-up">Masukan Data Siswa dan Dapatkan Notifikasi <a href="#tatacara" style="color:#58c25a;">Lihat Tatacara ?</a></h3>
              </div>
            </div>

            <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
            <form method="post" action="<?= base_url('validasi'); ?>">
              <div class="row align-items-center">
                <div class="col-lg-12 col-xl-5 no-sm-border border-right">
                  <div class="wrap-icon">
                    <input type="number" class="form-control" name="nisn" required autocomplete="off" placeholder="Masukkan NISN">
                  </div>
                </div>
                <div class="col-lg-12 col-xl-5">
                  <div class="select-wrap">
                    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                    <select class="form-control" id="id_kelas" name="id_kelas" required>
                      <option selected disabled>Pilih Kelas</option>
                      <?php foreach ($kelas as $row) : ?>
                        <option value="<?= $row['id_kelas']; ?>"><?= $row['nama_kelas']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-xl-2 ml-auto text-right">
                  <input type="submit" class="btn text-white btn-primary" value="Search">
                </div>
              </div>
            </form>
            </div>

          </div>
        </div>
      </div>
    </div>  

    <div class="site-section" id="tatacara">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Cara Kerja</h2>
            <p class="color-black-opacity-5">Ikuti langkah-langkah dibawah ini untuk dapat terhubung</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="<?= base_url('assets/wali/'); ?>images/step-2.svg" alt="icon ajax" class="img-fluid">
              </div>
              <span class="number">1</span>
              <h3>Masukan Data Siswa</h3>
              <p>Masukan NISN dan Kelas dari siswa, untuk identifikasi</p>
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="<?= base_url('assets/wali/'); ?>images/step-1.svg" alt="icon ajax" class="img-fluid">
              </div>
              <span class="number">2</span>
              <h3>Klik Start di channel Telgram</h3>
              <p>selanjutnya akan di arahkan ke channel telegram dan klik start / mulai, dan akan mendapatkan Chat ID</p>
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
            <div class="how-it-work-step">
              <div class="img-wrap">
                <img src="<?= base_url('assets/wali/'); ?>images/step-3.svg" alt="icon ajax" class="img-fluid">
              </div>
              <span class="number">3</span>
              <h3>Kembali Ke Halaman utama</h3>
              <p>Masukan Chat ID yang didapatkan pada channel telegram ke halaman website, selesai.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="py-5 bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mr-auto mb-4 mb-lg-0">
            <h2 class="mb-3 mt-0 text-white">Yuk kita mulai...</h2>
            <p class="mb-0 text-white">koneksikan akun telegram anda dengan sistem kami</p>
          </div>
          <div class="col-lg-4">
            <p class="mb-0"><a target="_blank" href="https://t.me/NotifikasiTugasSekolah_bot" class="btn btn-outline-white text-white btn-md px-5 font-weight-bold btn-md-block">Channel Telegram</a></p>
          </div>
        </div>
      </div>
    </div>
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-12 text-md-center text-left">
            <p>
          &copy; <?= date('Y'); ?> <strong class="text-black"></strong> All Rights Reserved. MTs PUI Banjarsari</a>
          </p>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <script src="<?= base_url('assets/wali/'); ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/jquery-ui.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/popper.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/jquery.stellar.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/jquery.countdown.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/jquery.magnific-popup.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/bootstrap-datepicker.min.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/aos.js"></script>
  <script src="<?= base_url('assets/wali/'); ?>js/rangeslider.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.js" integrity="sha512-JbRQ4jMeFl9Iem8w6WYJDcWQYNCEHP/LpOA11LaqnbJgDV6Y8oNB9Fx5Ekc5O37SwhgnNJdmnasdwiEdvMjW2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  

  <script src="<?= base_url('assets/wali/'); ?>js/typed.js"></script>
            <script>
            var typed = new Typed('.typed-words', {
            strings: ["Prestasi"," Unggul"," Creative", " Solidaritas"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
            });
            </script>

  <?php if($this->session->flashdata("message")): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var message = '<?= $this->session->flashdata("message"); ?>';
            var icon = '<?= ($this->session->flashdata("message_type") == "success") ? "success" : "error"; ?>';

            Swal.fire({
                html: message,
                icon: icon,
                showConfirmButton: false,
                timer: 3000 
            });
        });
    </script>
  <?php endif; ?>

  <script src="<?= base_url('assets/wali/'); ?>js/main.js"></script>
  
  </body>
</html>