<?php 
include "../../koneksi.php";

if (isset($_POST['kirimtiket'])) {

	$tgl_pinjam = date('Y-m-d');
	$id_brg = $_POST['id_brg'];
	$id_user = $_POST['id_user'];
	$nama_user = $_POST['nama_user'];
	$tujuan_gunabarang = $_POST['tujuan_gunabarang'];
	$jumlah_brg = $_POST['jumlah_brg'];
	$tgl_perkiraan_balik = $_POST['tgl_perkiraan_balik'];
	$status ='terkirim';

	$cekstok = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));
	if($jumlah_brg <= $cekstok['jumlah_brg']){
		$sql = mysqli_query($koneksi, "insert into tbl_tiketuser(id_tiketuser, id_user, id_brg, tgl_pinjam, tujuan_gunabarang, jumlah, status, tgl_perkiraan_balik) values('','".$id_user."','".$id_brg."','".$tgl_pinjam."','".$tujuan_gunabarang."', '".$jumlah_brg."', '".$status."','".$tgl_perkiraan_balik."')");
	}else if($jumlah_brg >= $cekstok['jumlah_brg']){
		echo "<script>
		alert('JUMLAH BARANG MELEBIHI JUMLAH YANG ADA SAAT INI');
		document.location.href = '../../anggota.php?page=home';
		</script>";
	}

	if ($sql) {
		echo "<script>
		alert('DATA TIKET BERHASIL DIKIRIM');
		document.location.href = '../../anggota.php?page=home';
		</script>";
	}else{
		echo "<script>
		alert('DATA TIKET GAGAL DIKIRIM');
		document.location.href = '../../anggota.php?page=home';
		</script>";
	}
}
?>