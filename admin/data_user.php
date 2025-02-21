<div class="row">
	<div class="col-sm-12">
		
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-nav">
				<h6>Daftar User</h6>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-sm table-bordered table-hover text-smS">
					<thead>
						<tr>
							<th>No</th>
							<th>Id User</th>
							<th>Nama User</th>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th>No HP/WA</th>
							<th>Img Profile</th>
							<th>ID Level</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$sql = mysqli_query($koneksi, "select * from tb_user");
						while ($row = mysqli_fetch_array($sql)) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $row['id_user']; ?></td>
								<td><?= $row['nama_lengkap']; ?></td>
								<td><?= $row['user']; ?></td>
								<td><?= $row['pass']; ?></td>
								<td><?= $row['email']; ?></td>
								<td><?= $row['no_whatsapp']; ?></td>
								<td><?= $row['img_profile']; ?></td>
								<td><?= $row['id_level']; ?></td>
							</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>