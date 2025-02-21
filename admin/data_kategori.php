<div class="row">
	<div class="col-sm-12">
		
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-nav">
				<h6>Daftar Kategori</h6>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Kategori</th>
							<th>Nama Kategori</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$sql = mysqli_query($koneksi, "select * from tbl_kategori");
						while ($row = mysqli_fetch_array($sql)) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $row['id_kategori']; ?></td>
								<td><?= $row['nama_kategori']; ?></td>
								<td><a href="" class="btn btn-primary">Edit</a></td>
							</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>