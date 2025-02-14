<?php 
if (isset($_GET['page']) == 'editfoto' && isset($_GET['id'])) { ?>
<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header bg-info">
				<h6 class="card-title">Edit Foto dari WebCam</h6>
			</div>
			<div class="card-body">
			<form action="admin/proses/proses_editfoto.php" method="post">
		      <div class="row">
		          <div class="col-md-6">
		              <div id="my_camera"></div>
		              <br/>
		              <!-- <input type="button" value="Ambil Foto" onClick="take_snapshot()"> -->
		              <button type="button" class="btn btn-secondary" onclick="take_snapshot()"><i class="fas fa-camera"></i> Ambil Foto</button>
		              <button type="submit" name="simpanfoto" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="admin.php?page=editmaster_data&id=<?= $_GET['id']; ?>" class="btn btn-primary mt-1"><i class="fas fa-step-backward"></i> Kembali</a>
		              <input type="hidden" name="image" class="image-tag">
		              <input type="hidden" name="id_brg" value="<?= $_GET['id']; ?>">
		          </div>

		          <div class="col-md-6">
		              <div id="results">Your captured image will appear here...</div>
		          </div>

		      </div>
		     </form>
			</div>
		</div>
	</div>
</div>	
<?php }
?>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">

    Webcam.set({
        width: 250,
        height: 250,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

</script>
