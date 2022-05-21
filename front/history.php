<?php
error_reporting(0); session_start();
if ($_SESSION['status'] == 'login' and $_SESSION['username'] <> "") {
include "../config.php";
include "../equipment.php";

$id_client = $_SESSION['id'];

function terapis($id_terapis){
  global $link;
  $cek_terapis = mysqli_query($link, "SELECT * from terapis where id_terapis = '$id_terapis'");
  $hasil_cek = mysqli_fetch_array($cek_terapis);
  $a = $hasil_cek['kode_terapis'];
  return $a;
}

function terapis2($id_terapis){
  global $link;
  $cek_terapis = mysqli_query($link, "SELECT * from terapis where id_terapis = '$id_terapis'");
  $hasil_cek = mysqli_fetch_array($cek_terapis);
  $b = $hasil_cek['file_name'];
  return $b;
}

function status_transfer($status_transfer){
  global $link;

  if ($status_transfer == 0) {
      echo "<a href='upload.php'><button class='genric-btn danger circle arrow' >Belum Transfer</button></a>";
  }elseif($status_transfer == 1){
    echo "<button class='genric-btn success circle'>Sudah Transfer</button>";
  }else{
    echo "error 12345";
  }
}

?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head> 
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!-- Start Header Area -->
        <header class="header_area sticky-header">
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light main_box">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="index_login.php"><img src="img/amolana.png" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item "><a class="nav-link" href="index_login.php">Home</a></li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                     aria-expanded="false">Terapis</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="category.php">List Terapis</a></li>
                                    </ul>
                                </li>
                                
                                
                                <li class="nav-item active" ><a class="nav-link" href="history.php">History</a></li>
                                <li class="nav-item"><a class="nav-link" href="upload.php">Keranjang</a></li>
                                <li class="nav-item"><a class="nav-link" href="../controller/login/logout.php">LOGOUT</a></li>
                                <font color="blue"><li class="nav-item"><a class="nav-link" href="#">HI <?= $_SESSION['name'] ?></a></li></font>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="search_input" id="search_input_box">
                <div class="container">
                    <form class="d-flex justify-content-between">
                        <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                        <button type="submit" class="btn"></button>
                        <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                    </form>
                </div>
            </div>
        </header>
        <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>History Pesanan</h1>
                 </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Terapis</th>
                                <th scope="col">Kode Pesanan</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Detail Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $selek_data = mysqli_query($link, "select * from pesan where id_client = '$id_client' order by id_pesanan DESC");

                        $cek_keranjang = mysqli_num_rows($selek_data);
                               if ($cek_keranjang)
                               {
                                while($data = mysqli_fetch_array($selek_data)){
                            ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="../images/<?= terapis($data['id_terapis']) ?>/<?= terapis2($data['id_terapis']) ?>" alt="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= $data['kode_pesanan'] ?></h5>
                                </td>
                                <td>
                                    <h5><?= $data['nama_pemesan'] ?></h5>
                                </td>
                                <td nowrap="">
                                    <h5><?= rupiah($data['price']) ?></h5>
                                </td>
                                <td nowrap="">
                                    <h5><?= status_transfer($data['status_transfer']) ?></h5>
                                </td>
                                <td nowrap="">
                                    <a href="../view/pemesanan/print_out.php?id_pesanan=<?=$data['id_pesanan']?>" title="Print" target='_blank'>
                                      <span class="fa fa-print"></span>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php }else{
                            echo '<tr bgcolor="#fff">
                                        <td align="center" colspan="100" align="center">Tidak Ada Pemesan</td>
                                    </tr>
                                    ';
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

   <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Alamat Dan Kontak</h6>
                        <p>
                            Komplek Lumbung Rezeki, Jl. Teuku Umar No.7, Lubuk Baja Kota, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444, No. Telp : (0778) 452940.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>

<?php
    }else{
      echo "<script>alert('Anda tidak memiliki hak akses!!'); window.location='login.php'</script>";
    }
?>