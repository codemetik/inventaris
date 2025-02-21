<?php 
include '../../koneksi.php';
if (isset($_GET['delete'])) {
	$id_brg = $_GET['delete'];
	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));
	if (is_file("../../dist/upload_img/".$brg['gambar_brg'])) unlink("../../dist/upload_img/".$brg['gambar_brg']);

	$sql = mysqli_query($koneksi, "delete from tbl_barang where id_brg = '".$id_brg."'");

	if ($sql) {
		echo "<script>
		alert('Data berhasil dihapus');
		document.location.href = '../../admin.php?page=master_data';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal dihapus');
		document.location.href = '../../admin.php?page=master_data';
		</script>";
	}
}
?>