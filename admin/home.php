<div class="row">
  <div class="col-sm-12 p-2">
    <div class="row">
      <div class="col-sm-6">
      <form action="" method="post">
      <div class="input-group">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="search ..." autofocus>
        <button type="submit" class="btn-primary"><i class="fas fa-search"></i></button>
      </div>
      </form>
      </div>
      <div class="col-sm-6">
      <form action="" method="post">
      <div class="input-group">
        <select class="select2 form-control form-control-sm" name="kategori">
          <option value="">---Pilih---</option>
          <?php 
          $query = mysqli_query($koneksi, "select * from tbl_kategori");
          while ($ro = mysqli_fetch_array($query)) {
            echo "<option value='".$ro['id_kategori']."'>".$ro['nama_kategori']."</option>";
          }
          ?>
        </select>
        <button type="submit" class="btn-primary"><i class="fas fa-search"></i></button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 p-0">
    <div class="row">
        <?php 
        if (isset($_POST['search'])) {
          $sql = mysqli_query($koneksi, "select * from tbl_barang where barcode_brg like '%".$_POST['search']."%' or nama_brg like '%".$_POST['search']."%'");
        }else if(isset($_POST['kategori'])){
          $sql = mysqli_query($koneksi, "select * from tbl_barang where id_kategori = '".$_POST['kategori']."' order by id_brg desc");
        }else{
          $sql = mysqli_query($koneksi, "select * from tbl_barang order by id_brg desc");
        }
        while ($row = mysqli_fetch_array($sql)) { 
        ?>
        <div class="col-sm-2">
          <div class="card">
            <div class="card-body">
              <img src="dist/upload_img/<?= $row['gambar_brg']; ?>" class="card-img-top">
            </div>
            <div class="card-footer bg-radian">
              <span><?= $row['nama_brg']; ?></span>
              <a href="admin.php?page=detailbarang&id=<?= $row['id_brg']; ?>" class="btn btn-primary float-right">Detail</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>    
  </div>
</div>