<!--
=========================================================
* Web Tools - v1.0.8
=========================================================
* Product Page:  https://www.creative-tim.com/product/soft-ui-design-system 
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com
 =========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="tr" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>Domain Sorgula</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/soft-design-system.css?v=1.0.8" rel="stylesheet" />
</head>

<body class="index-page">
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="index.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
              Web Tools
            </a>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="whois.php">
                    Domain Whois
                  </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="ip.php">
                    IP
                  </a>
                </li>
              </ul>
            </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <header class="header-2">
    <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/curved-images/curved.jpg')">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 text-center mx-auto">
            <h1 class="text-white pt-3 mt-n5">Whois Sorgulama</h1>
            <br>
            <form action="" method="POST">
              <div class="col-md-auto">
                <input class="form-control" type="text" name="domain" id="domain" placeholder="Domain Giriniz">
              </div>
              <br>
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0">Sorgula</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
          </g>
        </svg>
      </div>
    </div>
  </header>
  <br>
  <?php
  if (isset($_POST['domain'])) {
    require_once 'admin/config.php';
    $sorgu = $baglan->query("SELECT * FROM api");
    $veri = $sorgu->fetch(PDO::FETCH_ASSOC);
    $apiKey = $veri['api_key'];

    // log
    $domainName = strip_tags(trim($_POST['domain']));
    $zaman = date('H:i:s d.m.Y');
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $baglan->query("INSERT INTO whois_logs (sorgu, ip_adresi, user_agent, zaman) VALUES ('$domainName','$ip', '$user_agent','$zaman')");
    // sorgu 

    $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService"
      . "?domainName={$domainName}&apiKey={$apiKey}&outputFormat=JSON";
    $veri = json_decode(file_get_contents($url), true);
    // Göster 
    echo "<center><h3>" . $domainName . "</h3></center>";
    echo "<div class='container-fluid py-4'>
    <div class='row'>
    <div class='col-md-5 mx-auto'>
    <div class='card'>
    <div class='card-body'>";

    //
    echo "<h4 class='card-title'>Registrar Bilgileri</h4>";
    echo "<b>Kayıt Firması: </b>" . ($veri["WhoisRecord"]["registrarName"]) . "<br>";
    echo "<b>IANA ID: </b>" . ($veri["WhoisRecord"]["registrarIANAID"]) . "<br>";
    echo "<b>Kötüye kullanım bildirimi e-mail: </b>" . ($veri["WhoisRecord"]["contactEmail"]);
    echo "</div>
    </div>
    </div>
    <div class='col-md-4 mx-auto'>
        <div class='card'>
    <div class='card-body'>";
    //
    echo "<h4 class='card-title'>Önemli Tarihler</h4>";
    //
    $parca = explode("T", ($veri["WhoisRecord"]["createdDate"]));
    $parca2 = explode("-", ($parca[0]));
    echo "<b>Kayıt Tarihi: </b>" . $parca2[2] . "-" . $parca2[1] . "-" . $parca2[0] . "<br>";
    //
    $parca = explode("T", ($veri["WhoisRecord"]["updatedDate"]));
    $parca2 = explode("-", ($parca[0]));
    echo "<b>Güncelleme Tarihi: </b>" . $parca2[2] . "-" . $parca2[1] . "-" . $parca2[0] . "<br>";
    //
    date_default_timezone_set('Europe/Istanbul');
    $parca = explode("T", ($veri["WhoisRecord"]["expiresDate"]));
    $parca2 = explode("-", ($parca[0]));
    $sonlanma_tarihi = strtotime($parca[0]);
    $tarih = date("Y-m-d");
    $bugun = strtotime($tarih);
    $fark = ($sonlanma_tarihi - $bugun) / 86400;
    if ($fark > 0){
      $kalan_gun = " ($fark" . " gün kaldı)";
    } else {
      $kalan_gun = "";
    }
    echo "<b>Sonlanma Tarihi: </b>" . $parca2[2] . "-" . $parca2[1] . "-" . $parca2[0] . $kalan_gun;
    echo "</div>
    </div>
    </div>
    </div>
    <br><br>
    <div class='row'>
    
    <div class='col-md-5 mx-auto'>
        <div class='card'>
    <div class='card-body'>";
    //
    echo "<h4 class='card-title'>Domain Sahibi Bilgileri</h4>";

    echo "<b>Adı Soyadı: </b>" . ($veri["WhoisRecord"]["registrant"]["name"]) . "<br>";
    echo "<b>Şirketi: </b>" . ($veri["WhoisRecord"]["registrant"]["organization"]) . "<br>";
    echo "<b>Sokak: </b>" . ($veri["WhoisRecord"]["registrant"]["street1"]) . "<br>";
    echo "<b>Şehir: </b>" . ($veri["WhoisRecord"]["registrant"]["city"]) . "<br>";
    echo "<b>Bölge Kodu: </b>" . ($veri["WhoisRecord"]["registrant"]["state"]) . "<br>";
    echo "<b>Posta Kodu: </b>" . ($veri["WhoisRecord"]["registrant"]["postalCode"]) . "<br>";
    echo "<b>Ülke: </b>" . ($veri["WhoisRecord"]["registrant"]["country"]) . "<br>";
    echo "<b>Ülke Kodu: </b>" . ($veri["WhoisRecord"]["registrant"]["countryCode"]) . "<br>";
    echo "<b>Telefon: </b>" . ($veri["WhoisRecord"]["registrant"]["telephone"]);
    echo "</div>
    </div><br><br>";
    //
    echo "<div class='card'>
    <div class='card-body'>";
    echo "<h4 class='card-title'>Nameserver (NS) Bilgileri</h4>";
    $ns = ($veri["WhoisRecord"]["nameServers"]["rawText"]);
    echo nl2br(str_replace(" ", "PHP_EOL", $ns));
    //
    echo "</div>
    </div><br><br>";
    echo "<div class='card'>
    <div class='card-body'>";
    echo "<h4 class='card-title'>IP Adresi</h4>";
    $ip_sorgu = json_decode(file_get_contents("http://ip-api.com/json/$domainName"), true);
    echo $ip_sorgu["query"];
    echo "</div>
    </div>
    </div>
    <div class='col-md-4 mx-auto'>
        <div class='card'>
    <div class='card-body'>";
    //
    echo "<h4 class='card-title'>Domain üzerindeki korumalar</h4>";
    $durum = ($veri["WhoisRecord"]["status"]);
    $transfer = "clientTransferProhibited";
    $delete = "clientDeleteProhibited";
    $update = "clientUpdateProhibited";
    if (strstr($durum, $transfer)) {
      echo "<b>Transfer Koruması</b>" . "<div class='w-15'><center><div class='text-bg-success  p-2'><b class='text-white'>Aktif</b></div></center></div>";
    }
    if (strstr($durum, $delete)) {
      echo "<b>Silinme Koruması</b>" . "<div class='w-15'><center><div class='text-bg-success  p-2'><b class='text-white'>Aktif</b></div></center></div>";
    }
    if (strstr($durum, $update)) {
      echo "<b>Güncellenme Koruması</b>" . "<div class='w-15'><center><div class='text-bg-success  p-2'><b class='text-white'>Aktif</b></div></center></div>";
    }
    //

    echo "</div>
    </div>
    </div>
    </div>
    </div>";
  }
  ?>
  <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
  <footer class="footer pt-5 mt-5">
    <hr class="horizontal dark mb-5">
    <div class="container">
      <div class="row">
        <div class="text-center">
          <h6 class="text-gradient text-primary font-weight-bolder">Web Tools</h6>
        </div>
        <div class="col-12">
          <div class="text-center">
            <p class="my-4 text-sm">
              Tüm hakları sakladır. Copyright ©
              <script>
                document.write(new Date().getFullYear())
              </script>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
  <script src="./assets/js/plugins/countup.min.js"></script>
  <script src="./assets/js/plugins/choices.min.js"></script>
  <script src="./assets/js/plugins/prism.min.js"></script>
  <script src="./assets/js/plugins/highlight.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
  <script src="./assets/js/plugins/rellax.min.js"></script>
  <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
  <script src="./assets/js/plugins/tilt.min.js"></script>
  <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
  <script src="./assets/js/plugins/choices.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="./assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="./assets/js/soft-design-system.min.js?v=1.0.8" type="text/javascript"></script>
  <script type="text/javascript">
    if (document.getElementById('state1')) {
      const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
      if (!countUp.error) {
        countUp.start();
      } else {
        console.error(countUp.error);
      }
    }
    if (document.getElementById('state2')) {
      const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
      if (!countUp1.error) {
        countUp1.start();
      } else {
        console.error(countUp1.error);
      }
    }
    if (document.getElementById('state3')) {
      const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
      if (!countUp2.error) {
        countUp2.start();
      } else {
        console.error(countUp2.error);
      };
    }
  </script>
</body>

</html>