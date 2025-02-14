<?php 
include "../../koneksi.php";

if (isset($_POST['simpanambil'])) {
	$id_brg = $_POST['id_brg'];
	$barcode_brg = $_POST['barcode_brg'];
	$nama_guru = $_POST['nama_guru'];
	$tgl_brg_keluar = $_POST['tgl_brg_keluar'];
	$jumlah_brg = $_POST['jumlah_brg'];
	$alamat_ruang = $_POST['alamat_ruang'];
	$tujuan_gunabarang = $_POST['tujuan_gunabarang'];

	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));

	$sql = mysqli_query($koneksi, "insert into tbl_ambil(id_ambil, id_brg, nama_guru, tgl_brg_keluar, jumlah_brg, alamat_ruang, tujuan_gunabarang) values('','".$id_brg."','".$nama_guru."','".$tgl_brg_keluar."','".$jumlah_brg."','".$alamat_ruang."','".$tujuan_gunabarang."')");
	
	$jenis_activ = "Ambil";
	$waktu_sekarang = date('h:i:s');
	$hist = mysqli_query($koneksi, "insert into tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) values('','".$jenis_activ."','".$id_brg."', '".$brg['nama_brg']."','".$jumlah_brg."','".$tgl_brg_keluar."','".$waktu_sekarang."');");

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