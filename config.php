<?php
// buat koneksi dengan MySQL
$link = mysqli_connect("localhost", "root", "","amolana");
// cek koneksi yang kita lakukan berhasil atau tidak
if ($link->connect_error) {
// jika terjadi error, matikan proses dengan die() atau exit();
   die('Maaf koneksi gagal: '. $link->connect_error);
}
?>
