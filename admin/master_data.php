<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-indigo">
				<h6 class="card-title">Data Barang Inventaris</h6>
			</div>
			<div class="card-body">
				
			<table id="example1" class="table table-bordered table-striped table-valign-middle table-hover table-dark">
				<thead>
					<tr>
						<th>Barcode</th>
						<th>Foto Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>diPinjam</th>
						<th>Sisa</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$sql = mysqli_query($koneksi, "select * from tbl_barang");
				while ($row = mysqli_fetch_array($sql)) { ?>
					<tr>
						<td><?= $row['barcode_brg']; ?></td>
						<td><img src="dist/upload_img/<?= $row['gambar_brg']; ?>" width="80px" height="80px" class="rounded"></td>
						<td><?= $row['nama_brg']; ?></td>
						<td><?= $row['jumlah_brg']; ?> pcs</td>
						
						<?php 
						$sqli = mysqli_query($koneksi, "select id_brg, sum(jumlah_pinjam) as jml_pinjam from tbl_pinjaman where id_brg = '".$row['id_brg']."'");
						$pin = mysqli_fetch_array($sqli);
						if (isset($pin['id_brg']) == $row['id_brg']) {
							echo "<td>".$pin['jml_pinjam']."</td>";
							$hasil = $row['jumlah_brg'] - $pin['jml_pinjam'];
							echo "<td>".$hasil."</td>";	
						}else{
							echo "<td>0</td>";
							echo "<td>".$row['jumlah_brg']."</td>";
						}
						?>
						<td><a href="?page=editmaster_data&id=<?= $row['id_brg']; ?>" class="btn bg-cyan">Edit</a></td>
					</tr>
				<?php }
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>Barcode</th>
						<th>Foto Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>diPinjam</th>
						<th>Sisa</th>
						<th>Edit</th>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
	</div>
</div>