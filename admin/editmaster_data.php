<?php 
if (isset($_GET['id'])) {
	$sql = mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$_GET['id']."'");
  	$row = mysqli_fetch_array($sql);
}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info">
				<h6 class="card-title">Edit Data Master</h6>
			</div>
			<div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="col-sm-4">
						<img src="dist/upload_img/<?= $row['gambar_brg']; ?>" width="320px" height="320px" class="rounded">
						<a href="?page=editfoto&id=<?= $row['id_brg']; ?>" class="btn bg-secondary m-1">Ubah Foto</a> <a href="?page=editfilefoto&id=<?= $row['id_brg']; ?>" class="btn bg-secondary m-1">Ubah dari file</a>
					</div>
					<div class="col-sm-8">
						<table class="table table-sm table-striped table-valign-middle table-hover">
							<thead>
								<tr>
									<th class="col-3">Barcode</th>
									<td>
									<input type="text" name="id_brg" value="<?= $row['id_brg']; ?>" hidden>
									<input type="text" name="barcode_brg" class="form-control" value="<?= $row['barcode_brg']; ?>">
									</td>
								</tr>
								<tr>
									<th class="col-3">Nama barang</th>
									<td><input type="text" name="nama_brg" class="form-control" value="<?= $row['nama_brg']; ?>"></td>
								</tr>
								<tr>
									<th class="col-3">Tgl masuk barang</th>
									<td><input type="date" name="tgl_masuk_brg" class="form-control" value="<?= $row['tgl_masuk_brg']; ?>"></td>
								</tr>
								<tr>
									<th class="col-3">No. Rak</th>
									<td>
										<select class="form-control" name="norak_brg">
										<?php 
										$norak = mysqli_query($koneksi, "select * from tbl_norak");
										while ($dt = mysqli_fetch_array($norak)) { 
										if ($row['norak_brg'] == $dt['id_norak']) {
											$select = 'selected';
										}else{
											$select = '';
										}
										?>
											<option value="<?= $dt['id_norak']; ?>" <?= $select; ?>><?= $dt['nomor_norak']; ?></option>	
										<?php }
										?>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-3">Spesifikasi barang</th>
									<td><textarea type="text" name="spesifikasi_brg" class="form-control"><?= $row['spesifikasi_brg']; ?></textarea></td>
								</tr>
								<tr>
									<th class="col-3">Kategori</th>
									<td>
										<select class="form-control" name="kategori_brg">
										<?php 
										$norak = mysqli_query($koneksi, "select * from tbl_kategori");
										while ($dt = mysqli_fetch_array($norak)) { 
										if ($row['id_kategori'] == $dt['id_kategori']) {
											$select = 'selected';
										}else{
											$select = '';
										}
										?>
											<option value="<?= $dt['id_kategori']; ?>" <?= $select; ?>><?= $dt['nama_kategori']; ?></option>	
										<?php }
										?>
										</select>
									</td>
								</tr>
								<tr>
									<th class="col-3">Jumlah barang</th>
									<td><input type="number" name="jumlah_brg" class="form-control" value="<?= $row['jumlah_brg']; ?>"></td>
								</tr>
							</thead>
						</table>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm('Yakin ingin menyimpan perubahan data ini?')"><i class="fas fa-save"></i> Simpan</button>
							<a href="admin.php?page=master_data" class="btn btn-primary"><i class="fas fa-step-backward"></i> Kembali</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header bg-danger">
								<h6 class="card-title">Klik tombol dibawah untuk menghapus data</h6>
							</div>
							<div class="card-body">
								<a href="?page=editmaster&delete=<?= $row['id_brg']; ?>" class="btn btn-outline-danger" onclick="return confirm('Data ini memiliki stok <?= $row['jumlah_brg']." pcs, "; ?> Jika klik ok, maka data akan terhapus.')">Hapus data ini</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['simpan'])) {
	$id_brg = $_POST['id_brg'];
	$barcode_brg = $_POST['barcode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$tgl_masuk_brg = $_POST['tgl_masuk_brg'];
	$norak = $_POST['norak_brg'];
	$spesifik_brg = $_POST['spesifikasi_brg'];
	$kategori_brg = $_POST['kategori_brg'];
	$jumlah_brg = $_POST['jumlah_brg'];

	$sql = mysqli_query($koneksi, "update tbl_barang set barcode_brg = '".$barcode_brg."', nama_brg = '".$nama_brg."', norak_brg = '".$norak."', tgl_masuk_brg = '".$tgl_masuk_brg."', spesifikasi_brg = '".$spesifik_brg."', id_kategori = '".$kategori_brg."', jumlah_brg = '".$jumlah_brg."' where id_brg = '".$id_brg."'");

	if ($sql) {
		echo "<script>
		alert('Data perubahan berhasil disimpan');
		document.location.href = '?page=editmaster&id=".$id_brg."';
		</script>";
	}else{
		echo "<script>
		alert('Data perubahan gagal disimpan');
		document.location.href = '?page=editmaster&id=".$id_brg."';
		</script>";
	}
}else if (isset($_GET['delete'])) {
	$id_brg = $_GET['delete'];

	$sql = mysqli_query($koneksi, "delete from tbl_barang where id_brg = '".$id_brg."'");

	if ($sql) {
		echo "<script>
		alert('Data berhasil dihapus');
		document.location.href = '?page=database';
		</script>";
	}else{
		echo "<script>
		alert('Data gagal dihapus');
		document.location.href = '?page=database';
		</script>";
	}
}
?>