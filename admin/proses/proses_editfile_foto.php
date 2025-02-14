<?php 
require_once("../../koneksi.php");

if (isset($_POST['simpanfile'])) {
	$id_brg = $_POST['id_brg'];

	$gbr = $_FILES['gambar']['name'];
	$tmp = $_FILES['gambar']['tmp_name'];
	$fotobaru = date('dmYHis').$gbr;
	$path = "../../dist/upload_img/".$fotobaru;

	if (move_uploaded_file($tmp, $path)) {
		
		$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));

		if (is_file("../../dist/upload_img/".$brg['gambar_brg'])) unlink("../../dist/upload_img/".$brg['gambar_brg']);

		$sql = mysqli_query($koneksi, "update tbl_barang set gambar_brg = '".$fotobaru."' where id_brg = '".$id_brg."'");

		if ($sql) {
			echo "<script>
			alert('Perubahan gambar berhasil disimpan');
			document.location.href = '../../admin.php?page=editmaster_data&id=".$brg['id_brg']."';
			</script>";
		}else{
			echo "<script>
			alert('Perubahan gambar gagal disimpan');
			document.location.href = '../../admin.php?page=editmaster_data&id=".$brg['id_brg']."';
			</script>";
		}
	}
	//ok	
}
?>