<?php 
if (isset($_GET['page']) == 'editfile' && isset($_GET['id'])) { 
	$row = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$_GET['id']."'"));

	?>
<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header bg-info">
				<h6 class="card-title">Edit foto dari file</h6>
			</div>
			<div class="card-body">
				<form action="admin/proses/proses_editfile_foto.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<img src="dist/upload_img/<?= $row['gambar_brg']; ?>" id="output" height="190" width="200">
						<input type="file" accept="images/*" onchange="loadFile(event)" name="gambar" id="gambar" required>
						<input type="hidden" name="id_brg" value="<?= $row['id_brg']; ?>">
						<a href="" class="btn btn-secondary">Cencel</a>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="simpanfile"><i class="fas fa-save"></i> Simpan</button>
						<a href="admin.php?page=editmaster_data&id=<?= $_GET['id']; ?>" class="btn btn-primary"><i class="fas fa-step-backward"></i> Kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php }
?>

<script type="text/javascript">
	var loadFile = function(event){
		var output = document.getElementById('output');
		output.src=URL.createObjectURL(event.target.files[0]);
	}
</script>