<?php
// $host = "localhost";
// $user = "smkg6771";
// $pass = "smksapra2123";
// $db = "smkg6671_wadompet";

// $host = "localhost"; 
// $user = "smkg6671_paktaris"; 
// $pass = "paktaris"; 
// $db = "smkg6671_db_paktaris"; 

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_paktaris";

$koneksi = mysqli_connect($host, $user, $pass, $db) 
or die('Could not connect : ' . mysqli_connect_error());

date_default_timezone_set('Asia/Jakarta');

// mysqli_close($koneksi);

//mendapatkan kode urut tbl_pinjaman
$unik = mysqli_fetch_array(mysqli_query($koneksi, "select max(id_pinjaman) as kode from tbl_pinjaman"));
$intunik = (int) $unik['kode'];
$intunik++;
//echo $intunik;
?>