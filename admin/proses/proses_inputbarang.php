<?php 

require_once("../../koneksi.php");

if (isset($_POST['simpan'])) {

$brc = $_POST['barcode_brg'];
$nama_brg = $_POST['nama_brg'];
$tgl_masuk_brg = $_POST['tgl_masuk_brg'];
$spec_brg = $_POST['spesifikasi_brg'];
$id_kategori = $_POST['id_kategori'];
$jumlah_brg = $_POST['jumlah_brg'];

$img = $_POST['image'];
$folderPath = "../../dist/upload_img/";
$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$fileName = uniqid() . '.png';
$file = $folderPath . $fileName;
file_put_contents($file, $image_base64);

// $jenis_activ = "Ambil";
// $waktu_sekarang = date('h:i:s');

// print_r($fileName);

$sql = mysqli_query($koneksi, "select * from tbl_barang where barcode_brg = '".$brc."'");
$cek = mysqli_num_rows($sql);
$data = mysqli_fetch_array($sql);

	if ($cek > 0) {
		$insert = mysqli_query($koneksi, "update tbl_barang set gambar_brg = '".$fileName."', jumlah_brg = '".$jumlah_brg + $data['jumlah_brg']."' where barcode_brg = '".$brc."'");

		// $hist = mysqli_query($koneksi, "insert into tbl_history(id_history, jenis_aktivitas, id_brg, jumlah_brg, tgl_history, waktu_history) values('','".$jenis_activ."','".$id_brg."','".$jumlah_brg."','".$tgl_brg_keluar."','".$waktu_sekarang."');");
	}else{
		$insert = mysqli_query($koneksi, "insert into tbl_barang(id_brg, barcode_brg, nama_brg, gambar_brg, tgl_masuk_brg, spesifikasi_brg, id_kategori, jumlah_brg) values('','".$brc."','".$nama_brg."','".$fileName."','".$tgl_masuk_brg."','".$spec_brg."','".$id_kategori."','".$jumlah_brg."')");
	}

	if ($insert) {
		echo "<script>
		alert('Data Berhasil Disimpan');
		document.location.href = '../../admin.php?page=home';
		</script>";
	}else{
		echo "<script>
		alert('Data Berhasil Disimpan');
		document.location.href = '../../admin.php?page=home';
		</script>";
	}



}
?>