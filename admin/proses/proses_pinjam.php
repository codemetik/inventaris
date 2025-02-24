<?php 
include "../../koneksi.php";

if (isset($_POST['simpanpinjam'])) {
	$id_brg = $_POST['id_brg'];
	$barcode_brg = $_POST['barcode_brg'];
	$id_user = $_POST['id_user'];
	$tgl_pinjam = $_POST['tgl_pinjam'];
	$tgl_perkiraan_balik = $_POST['tgl_perkiraan_balik'];
	$jumlah_brg = $_POST['jumlah_brg'];
	$organisasi = $_POST['organisasi'];
	$tujuan_gunabarang = $_POST['tujuan_gunabarang'];

	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));

	$sql = mysqli_query($koneksi, "insert into tbl_pinjaman(id_pinjaman, id_brg, id_user, tgl_pinjam, jumlah_pinjam, organisasi, tujuan_gunabarang) values('".$intunik."','".$id_brg."','".$id_user."','".$tgl_pinjam."','".$jumlah_brg."','".$organisasi."','".$tujuan_gunabarang."')");

	$jenis_activ = "Pinjam";
	$waktu_sekarang = date('h:i:s');
	$hist = mysqli_query($koneksi, "insert into tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) values('','".$jenis_activ."','".$id_brg."', '".$brg['nama_brg']."','".$jumlah_brg."','".$tgl_pinjam."','".$waktu_sekarang."');");
	$hist_pinjam = mysqli_query($koneksi, "insert into tbl_history_pinjam(id_histpinjam, id_pinjaman, id_brg, id_user, jumlahbrg_pinjam, jumlahbrg_kembali, tujuan_gunabarang, tgl_pinjam, tgl_perkiraan_balik, tgl_kembali) values('','".$intunik."','".$id_brg."','".$id_user."','".$jumlah_brg."','','".$tujuan_gunabarang."','".$tgl_pinjam."', '".$tgl_perkiraan_balik."', '')");
	if ($sql && $hist) {
		echo "<script>
		alert('Data perubahan berhasil disimpan');
		document.location.href = '../../admin.php?page=detailbarang&id=".$id_brg."';
		</script>";
	}else{
		echo "<script>
		alert('Data perubahan gagal disimpan');
		document.location.href = '../../admin.php?page=detailbarang&id=".$id_brg."';
		</script>";
	}
}
?>