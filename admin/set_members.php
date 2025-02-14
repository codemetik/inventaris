<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-indigo">
				<h6 class="card-title">Daftar barang atau alat yang tidak kembali</h6>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-sm table-striped table-valign-middle table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Tgl Pengambilan</th>
							<th>Foto Barang</th>
							<th>Barcode</th>
							<th>Nama Barang</th>
							<th>di Ambil</th>
							<th>Jumlah</th>
							<th>Tujuan Penggunaan</th>
							<th>Alamat Ruang</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = mysqli_query($koneksi, "select id_ambil, y.id_brg, tgl_brg_keluar, gambar_brg, x.barcode_brg, nama_brg, y.jumlah_brg as diambil, x.jumlah_brg as sisa, tujuan_gunabarang, alamat_ruang from tbl_barang x inner join tbl_ambil y on y.id_brg = x.id_brg order by id_brg desc");
						while ($row = mysqli_fetch_array($sql)) { ?>
							<tr>
								<td>No</td>
								<td><?= $row['tgl_brg_keluar']; ?></td>
								<td><img src="dist/upload_img/<?= $row['gambar_brg']; ?>" width="90px" height="90px"></td>
								<td><?= $row['barcode_brg']; ?></td>
								<td><?= $row['nama_brg']; ?></td>
								<td><?= $row['diambil']; ?></td>
								<td><?= $row['sisa'] ?></td>
								<td><?= $row['tujuan_gunabarang']; ?></td>
								<td><?= $row['alamat_ruang']; ?></td>
								<td><a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger"><i class="fas fa-clock"></i> Batalkan</a></td>
							</tr>
							<div class="modal fade" id="modal-danger">
						        <div class="modal-dialog">
						        <form action="" method="post">
						          <div class="modal-content bg-danger">
						            <div class="modal-header">
						              <h4 class="modal-title">Batal Ambil Barang/Alat</h4>
						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                <span aria-hidden="true">&times;</span></button>
						            </div>
						            <div class="modal-body">
						            	<div class="form-group" hidden>
						            		<input type="text" name="id_ambil" class="form-control" value="<?= $row['id_ambil'] ?>">
						            		<input type="text" name="id_brg" class="form-control" value="<?= $row['id_brg']; ?>">
						            	</div>
							              <div class="form-group">
							              	<label>Jumlah Barang yg batal Ambil</label>
							              	<input type="text" name="jumlah_brg" class="form-control" autofocus>
							              </div>
						            </div>
						            <div class="modal-footer justify-content-between">
						              <button type="submit" class="btn btn-outline-light" name="simpanbatal">Simpan</button>
						            </div>
						          </div>
						          <!-- /.modal-content -->
						        </form>
						        </div>
						        <!-- /.modal-dialog -->
						      </div>
						      <!-- /.modal -->
						<?php }
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Tgl Pengambilan</th>
							<th>Foto Barang</th>
							<th>Barcode</th>
							<th>Nama Barang</th>
							<th>di Ambil</th>
							<th>Jumlah</th>
							<th>Tujuan Penggunaan</th>
							<th>Alamat Ruang</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['simpanbatal'])) {
	$id_ambil = $_POST['id_ambil'];
	$id_brg = $_POST['id_brg'];
	$jumlah_brg = $_POST['jumlah_brg'];

	$row = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_ambil where id_brg = '".$id_brg."' and id_ambil = '".$id_ambil."'"));
	if ($jumlah_brg == $row['jumlah_brg']) {
		//jika jumlah pinjam dikembalikan semua
		$tambah = mysqli_query($koneksi, "update tbl_barang set jumlah_brg = jumlah_brg + '".$jumlah_brg."' where id_brg = '".$id_brg."'");
		$query = mysqli_query($koneksi, "delete from tbl_ambil where id_ambil = '".$row['id_ambil']."'");
	}else if($jumlah_brg < $row['jumlah_brg']){
		//jika jumlah pinjam dikembalikan kurang dari jumlah pinjam di awal
		$tambah = mysqli_query($koneksi, "update tbl_barang set jumlah_brg = jumlah_brg + '".$jumlah_brg."' where id_brg = '".$id_brg."'");
		$query = mysqli_query($koneksi,"update tbl_ambil set jumlah_brg = jumlah_brg - '".$jumlah_brg."' where id_ambil = '".$row['id_ambil']."'");
	}else if($jumlah_brg > $row['jumlah_brg']){
		echo "<script>
		alert('Jumlah yang dibatalkan melebihi jumlah ambil di awal!');
		document.location.href = 'admin.php?page=set_members';
		</script>";
	}

	if ($tambah && $query) {
		echo "<script>
		alert('Data Berhasil Disimpan');
		document.location.href = 'admin.php?page=set_members';
		</script>";
	}else{
		echo "<script>
		alert('Data Gagal Disimpan');
		document.location.href = 'admin.php?page=set_members';
		</script>";
	}
}
?>