<?php 
require_once("../../koneksi.php");

if (isset($_POST['simpanprofile'])) {
	$id_user = $_POST['id_user'];

	$gbr = $_FILES['gambar']['name'];
	$tmp = $_FILES['gambar']['tmp_name'];
	$fotobaru = date('dmYHis').$gbr;
	$path = "../../dist/upload_img/".$fotobaru;

	if (move_uploaded_file($tmp, $path)) {
		
		$user = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_user where id_user = '".$id_user."'"));

		if (is_file("../../dist/upload_img/".$user['img_profile'])) unlink("../../dist/upload_img/".$user['img_profile']);

		$sql = mysqli_query($koneksi, "update tb_user set img_profile = '".$fotobaru."' where id_user = '".$id_user."'");

		if ($sql) {
			echo "<script>
			alert('Perubahan foto profile berhasil disimpan');
			document.location.href = '../../admin.php?page=profile';
			</script>";
		}else{
			echo "<script>
			alert('Perubahan foto profile gagal disimpan');
			document.location.href = '../../admin.php?page=profile';
			</script>";
		}
	}
	//ok	
}
?>