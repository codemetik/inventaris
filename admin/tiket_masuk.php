<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-nav">
				<h6 class="card-title text-bold float-left">Daftar Tiket Masuk</h6>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>ID Tiket</th>
							<th>User Peminjam</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
							<th>Status</th>
							<th>Tujuan Penggunaan</th>
							<th>Tgl Tiket</th>
							<th>Tgl Perkiraan Kembali</th>
							<th>Aksi Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = mysqli_query($koneksi, "select * from tbl_tiketuser x left join tbl_barang y on y.id_brg = x.id_brg left join tb_user z on z.id_user = x.id_user group by id_tiketuser desc");
						while ($row = mysqli_fetch_array($sql)) {
							?>
							<tr>
								<td><?= $row['id_tiketuser']; ?></td>
								<td><?= $row['nama_lengkap']; ?></td>
								<td><?= $row['nama_brg']; ?></td>
								<td><?= $row['jumlah']; ?></td>
								<td><?= $row['status']; ?></td>
								<td><?= $row['tujuan_gunabarang']; ?></td>
								<td><?= $row['tgl_pinjam']; ?></td>
								<td><?= $row['tgl_perkiraan_balik']; ?></td>
								<td>
								<?php 
								$btn = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_tiketuser where status = '".$row['status']."'"));
								if ($btn['status'] == 'disetujui') {
									echo "Dalam proses peminjaman";
								}else if($btn['status'] == 'dibatalkan'){ ?>
									<a href="admin.php?page=tiket_masuk&id=<?= $row['id_tiketuser']; ?>" class="btn btn-danger" onclick="return confirm('Klik ok, untuk lanjut hapus!.')"><i class="fas fa-trash"></i></a>
								<?php }else if($btn['status'] == 'terkirim'){ ?>
									<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-info<?= $row['id_tiketuser']; ?>"><i class="fas fa-angle-double-up"></i></a>
								<?php }
								?>
								</td>
							</tr>
							<div class="modal fade" id="modal-info<?= $row['id_tiketuser']; ?>">
							  <div class="modal-dialog">
							    <div class="modal-content bg-indigo">
							      <div class="modal-header">
							        <h6 class="modal-title"><i class="fas fa-angle-double-up"></i> Aksi Admin</h6>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span></button>
							      </div>
							      <div class="modal-body">
							        <form action="" method="post">
							        	<div class="form-group" hidden>
							        		<input type="text" name="id_tiketuser" value="<?= $row['id_tiketuser']; ?>">
							        	</div>
							        	<div class="form-group">
							        		<label for="tindakan">Tindakan</label>
							        		<select class="select2 form-control form-control-sm" name="status">
							        			<option value="disetujui">Setujui</option>
							        			<option value="dibatalkan">Batalkan</option>
							        		</select>
							        	</div>
							        	<div class="form-group">
							        		<button type="submit" name="ok" class="btn btn-primary">OK</button>
							        	</div>
							        </form>
							      </div>
							    </div>
							    <!-- /.modal-content -->
							  </div>
							  <!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['ok'])) {
	$id_tiketuser = $_POST['id_tiketuser'];
	$status = $_POST['status'];

	$tiket = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_tiketuser where id_tiketuser = '".$id_tiketuser."'"));
	if ($status == 'disetujui') {
		$up = mysqli_query($koneksi, "update tbl_tiketuser set status = '".$status."' where id_tiketuser = '".$id_tiketuser."'");
		$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$tiket['id_brg']."'"));
		$user = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_user where id_user = '".$tiket['id_user']."'"));
		if($user['id_organisasi'] == '1'){
			$organ = 'Guru';
		}else if($user['id_organisasi'] == '2'){
			$organ = 'Siswa';
		}
		$insert = mysqli_query($koneksi, "insert into tbl_pinjaman(id_pinjaman,	id_brg,	id_user, tgl_pinjam, jumlah_pinjam,	organisasi,	tujuan_gunabarang) values('','".$brg['id_brg']."','".$user['id_user']."','".$tiket['tgl_pinjam']."','".$tiket['jumlah']."','".$organ."','".$tiket['tujuan_gunabarang']."')");
		
		if ($up && $insert) {
			echo "<script>
			alert('TIKET BERHASIL DISETUJUI');
			document.location.href = 'admin.php?page=tiket_masuk';
			</script>";
		}else{
			echo "<script>
			alert('TIKET GAGAL DISETUJUI');
			document.location.href = 'admin.php?page=tiket_masuk';
			</script>";
		}

	}else if($status == 'dibatalkan'){
		$up = mysqli_query($koneksi, "update tbl_tiketuser set status = '".$status."' where id_tiketuser = '".$id_tiketuser."'");
		if ($up) {
			echo "<script>
			alert('TIKET BERHASIL DIBATALKAN');
			document.location.href = 'admin.php?page=tiket_masuk';
			</script>";
		}else{
			echo "<script>
			alert('TIKET GAGAL DIBATALKAN');
			document.location.href = 'admin.php?page=tiket_masuk';
			</script>";
		}
	}
}else if(isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = mysqli_query($koneksi, "delete from tbl_tiketuser where id_tiketuser = '".$id."'");

	if ($sql) {
		echo "<script>
		alert('DATA TIKET dibatalkan BERHASIL DIHAPUS');
		document.location.href = 'admin.php?page=tiket_masuk';
		</script>";
	}else{
		echo "<script>
		alert('DATA TIKET dibatalkan GAGAL DIHAPUS');
		document.location.href = 'admin.php?page=tiket_masuk';
		</script>";
	}

}
?>