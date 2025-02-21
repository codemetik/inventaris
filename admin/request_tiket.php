<form action="admin/proses/proses_inputbarang.php" method="post">
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="row">
          <div class="col-md-6">
              <div id="my_camera"></div>
              <br/>
              <!-- <input type="button" value="Ambil Foto" onClick="take_snapshot()"> -->
              <button type="button" class="btn btn-secondary" onclick="take_snapshot()"><i class="fas fa-camera"></i> Ambil Foto</button>
              <input type="hidden" name="image" class="image-tag">
          </div>

          <div class="col-md-6">
              <div id="results" class="">Your captured image will appear here...</div>
          </div>

      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card text-sm p-3">
      
        <div class="form-group row">
          <label for="brcBrg" class="col-sm-4 col-form-label">Kode Barcode</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="brcBrg" name="barcode_brg" placeholder="..." autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="namaBrg" class="col-sm-4 col-form-label">Nama Barang</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="namaBrg" name="nama_brg" placeholder="..." required>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl" class="col-sm-4 col-form-label">TGL masuk barang</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" id="tgl" name="tgl_masuk_brg" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="spect" class="col-sm-4 col-form-label">Spesifikasi Barang</label>
          <div class="col-sm-8">
            <textarea type="text" class="form-control" id="spect" name="spesifikasi_brg" placeholder="..." required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="kategori" class="col-sm-4 col-form-label">Kategori Barang</label>
          <div class="col-sm-8">
            <select class="form-control" name="id_kategori">
              <option value="0">All Categori</option>
              <?php 
              $sql_catg = mysqli_query($koneksi, "select * from tbl_kategori");
              while ($rcatg = mysqli_fetch_array($sql_catg)) {
                echo "<option value='".$rcatg['id_kategori']."'>".$rcatg['id_kategori'].". ".$rcatg['nama_kategori']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Barang</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" id="jumlah" name="jumlah_brg" placeholder="..." required>
          </div>
          <div class="col-sm-3"><button class="btn btn-primary" name="simpan">Simpan</button></div>
        </div>
      
    </div>
  </div>
</div>
</form>

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