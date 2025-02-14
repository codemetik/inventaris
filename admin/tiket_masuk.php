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
							<th>Tgl Tiket</th>
							<th>User Peminjam</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
							<th>Status</th>
							<th>Tujuan Penggunaan</th>
							<th>Tgl Perkiraan Kembali</th>
							<th>Aksi Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = mysqli_query($koneksi, "select * from tbl_tiketuser x inner join tbl_barang y on y.id_brg = x.id_brg inner join tb_user z on z.id_user = x.id_user order by tgl_pinjam desc");
						while ($row = mysqli_fetch_array($sql)) {
							?>
							<tr>
								<td><?= $row['id_tiketuser']; ?></td>
								<td><?= $row['tgl_pinjam']; ?></td>
								<td><?= $row['nama_lengkap']; ?></td>
								<td><?= $row['nama_brg']; ?></td>
								<td><?= $row['jumlah']; ?></td>
								<td><?= $row['status']; ?></td>
								<td><?= $row['tujuan_gunabarang']; ?></td>
								<td><?= $row['tgl_perkiraan_balik'] ?></td>
								<td>
									<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-info"><i class="fas fa-angle-double-up"></i></a>
								</td>
							</tr>
							<div class="modal fade" id="modal-info">
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
							        		<select class="select2 form-control form-control-sm">
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