<?php 
$sqlkas = mysqli_query($koneksi, "select * from uang_kas");
$jmlkas = mysqli_fetch_array($sqlkas);

?>
<!-- =========================================================== -->
<div class="row">
  <div class="col-md-12 col-sm-6 col-12">
    <div class="info-box callout callout-grey">
      <span class="info-box-icon text-orange elevation-1"><i class="far fa-bell"></i></span>

      <div class="info-box-content">
        <!-- <span class="info-box-number">Ucapkan Selamat!</span> -->
        <div class="direct-chat-msg">
          <div class="direct-chat text-left" id="notifcat">
            <!-- show limit 1 -->
          </div>  
        </div> 
        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          <i class="fas fa-bell"></i> Notifikasi
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

</div>
<!-- /.row -->
<div class="row">
  <div class="col-sm-12">
  <div class="card">
    <div class="card-header bg-nav">
      <h1 class="card-title text-bold float-left">BUAT TIKET PINJAM ALAT</h1>
    </div>
    <div class="card-body">
    <form action="anggota/proses/proses_tiketuser.php" method="post">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <input type="text" name="id_user" value="<?= $user['id_user']; ?>" hidden>
            <input type="text" name="nama_user" class="form-control" value="<?= $user['nama_lengkap']; ?>" readonly>
          </div>
          <div class="form-group">
            <label>Pilih Barang</label>
            <select class="select2 form-control form-control-sm" name="id_brg" required>
              <option value="">---Pilih Barang---</option>
              <?php 
              $sql = mysqli_query($koneksi, "select * from tbl_barang");
              while ($row = mysqli_fetch_array($sql)) {
                echo "<option value='".$row['id_brg']."'>".$row['id_brg']." | ".$row['nama_brg']."</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="penggunaan">Tujuan Penggunaan</label>
            <textarea class="form-control" name="tujuan_gunabarang" required placeholder="..."></textarea>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="jumlah_brg">Jumlah Barang yg dipinjam</label>
            <input type="number" name="jumlah_brg" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="kembalikan">Perikaraan TGL Kembalikan barang</label>
            <input type="date" name="tgl_perkiraan_balik" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="kirimtiket">Kirim Tiket</button>
          </div>  
        </div>
      </div>
    </form>
    </div>
  </div>
  </div>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header bg-nav">
        <h6 class="card-title text-bold float-left">Tiket Anda</h6>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-sm table-bordered table-hover">
          <thead>
            <tr>
              <th>ID Tiket</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Tgl Pinjam</th>
              <th>Status</th>
              <th>Tujuan Penggunaan</th>
              <th>Tgl Perkiraan Balik</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql = mysqli_query($koneksi, "select * from tbl_tiketuser x inner join tbl_barang y on y.id_brg = x.id_brg order by x.id_brg desc");
            while ($row = mysqli_fetch_array($sql)) { ?>
              <tr>
                <td><?= $row['id_tiketuser']; ?></td>
                <td><?= $row['nama_brg']; ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td><?= $row['tgl_pinjam']; ?></td>
                <td><?= $row['status']; ?></td>
                <td><?= $row['tujuan_gunabarang']; ?></td>
                <td><?= $row['tgl_perkiraan_balik']; ?></td>
              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>