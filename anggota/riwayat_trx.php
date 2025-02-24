<div class="row">
	<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-nav">
			<h1 class="card-title text-bold float-left">DAFTAR Alat PPLG yang sedang dipinjam</h1>
		</div>
		<div class="card-body">
		<table id="example1" class="table table-sm table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Tgl Pinjam</th>
					<th>Status</th>
					<th>Ket Penggunaan</th>
					<th>Tgl Perkiraan Balik</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//$tiket = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_tiketuser where id_user = '".$user['id_user']."'"));
				$no=1;
				$sql = mysqli_query($koneksi, "select * from tbl_pinjaman x inner join tbl_barang y on y.id_brg = x.id_brg where id_user = '".$user['id_user']."' and status != 'dikembalikan'");
				while ($row = mysqli_fetch_array($sql)) { 
					$riwpin = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_history_pinjam where id_pinjaman = '".$row['id_pinjaman']."'"));
					?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $row['nama_brg']; ?></td>
						<td><?= $row['jumlah_pinjam']; ?></td>
						<td><?= $row['tgl_pinjam']; ?></td>
						<td><?= $row['status']; ?></td>
						<td><?= $row['tujuan_gunabarang']; ?></td>
						<td><?= $riwpin['tgl_perkiraan_balik']; ?></td>
					</tr>
				<?php }
				?>
			</tbody>
		</table>
		</div>
	</div>
	</div>
</div>