<?php 
require_once("../../koneksi.php");

if (isset($_POST['simpanfoto'])) {
	$id_brg = $_POST['id_brg'];

	$img = $_POST['image'];
	$folderPath = "../../dist/upload_img/";
	$image_parts = explode(";base64,", $img);
	$image_type_aux = explode("image/", $image_parts[0]);
	$image_type = $image_type_aux[1];
	$image_base64 = base64_decode($image_parts[1]);
	$fileName = uniqid() . '.png';
	$file = $folderPath . $fileName;
	file_put_contents($file, $image_base64);

	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));

	if (is_file("../../dist/upload_img/".$brg['gambar_brg'])) unlink("../../dist/upload_img/".$brg['gambar_brg']);

	$sql = mysqli_query($koneksi, "update tbl_barang set gambar_brg = '".$fileName."' where id_brg = '".$id_brg."'");

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
?>