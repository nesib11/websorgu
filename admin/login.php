<?php

session_start();
require 'config.php';
if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "uhrtKekonXzOXb9") {
  header("location:index.php");
} else if (isset($_COOKIE["cerez"])) {
  $sorgu = $baglan->query("select kadi from kullanicilar");
  while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    if ($_COOKIE["cerez"] == md5("aa" . $sonuc['kadi'] . "bb")) {
      $_SESSION["Oturum"] = "uhrtKekonXzOXb9";
      $_SESSION["kadi"] = $sonuc['kadi'];
      header("location:index.php");
    }
  }
}

$uyari = 0;
if (isset($_POST['txtKadi'])) {
  $txtKadi = strip_tags($_POST["txtKadi"]);
  $txtParola = strip_tags($_POST["txtParola"]);
  $sorgu = $baglan->query("SELECT parola FROM user WHERE kadi='$txtKadi'");
  $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
  if (empty($txtKadi) || empty($txtParola)) {
    $uyari = 1;
  } else if (!$sonuc) {
    $uyari = 2;
  } else if (empty($txtKadi) || empty($txtParola) || (md5(sha1('whois' . (md5('76' . $txtParola . '41'))))) == $sonuc["parola"]) {
    $_SESSION["Oturum"] = "uhrtKekonXzOXb9"; //oturum oluşturma
    $_SESSION['kadi'] = $txtKadi;
    $_SESSION["LoginIP"] = $_SERVER["REMOTE_ADDR"];
    $_SESSION["UserAgent"] = $_SERVER["HTTP_USER_AGENT"];
    $random = (rand() . rand());
    if (isset($_POST["ckbHatirla"])) {
      setcookie("cerez", md5("whois" . $txtKadi . $random), time() + (60 * 60 * 24 * 7));
    }
    header("location:index.php");
  } else {
    $uyari = 2;
  }
}

?>
<!--
=========================================================
* Soft UI Dashboard - v1.0.6
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Giriş
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Yönetim Paneline Hoşgeldiniz</h3>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <label>Kullanıcı Adı</label>
                    <div class="mb-3">
                      <input type="text" name="txtKadi" class="form-control" placeholder="Kullanıcı Adı" aria-label="text" aria-describedby="text-addon">
                    </div>
                    <label>Şifre</label>
                    <div class="mb-3">
                      <input type="password" name="txtParola" class="form-control" placeholder="Şifre" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="ckbHatirla" type="checkbox" id="ckbHatirla" checked="">
                      <label class="form-check-label" for="ckbHatirla">Beni Hatırla</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Giriş Yap</button>
                    </div>
                  </form>
                </div>


              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.6"></script>
</body>

</html>