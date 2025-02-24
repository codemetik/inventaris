<?php 
if (isset($_GET['id'])) {
  $sql = mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$_GET['id']."'");
  $row = mysqli_fetch_array($sql);
?>
<div class="row">
  <div class="col-sm-4 card p-3">
    <img src="dist/upload_img/<?= $row['gambar_brg']; ?>" alt="<?= $row['nama_brg']; ?>" width="100%" class="img-circle img-fluid rounded">
  </div>
	<div class="col-sm-8 card p-3">
    <table class="table table-striped table-valign-middle table-hover table-dark rounded">
      <thead>
        <tr>
          <th class="col-3">Barcode</th>
          <td>: <?= $row['barcode_brg']; ?></td>
        </tr>
        <tr>
          <th class="col-3">Nama Barang</th>
          <td>: <?= $row['nama_brg']; ?></td>
        </tr>
        <tr>
          <th class="col-3">Tgl Masuk Barang</th>
          <td>: <?= $row['tgl_masuk_brg']; ?></td>
        </tr>
        <tr>
          <th class="col-3">Spesifikasi Barang</th>
          <td>: <?= $row['spesifikasi_brg']; ?></td>
        </tr>
        <tr>
          <th class="col-3">Kategori Barang</th>
          <td>
          <?php
          $catrg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_kategori where id_kategori = '".$row['id_kategori']."'"));
          echo ": ".$catrg['nama_kategori'];
          ?>  
          </td>
        </tr>
        <tr>
          <?php 
          $pin = mysqli_fetch_array(mysqli_query($koneksi, "select id_brg, sum(jumlah_pinjam) as jml_pinjam from tbl_pinjaman where id_brg = '".$row['id_brg']."'"));
          if (isset($pin['id_brg']) == $row['id_brg']) {
            $jml = $pin['jml_pinjam'];
            $sisa = $row['jumlah_brg'] - $pin['jml_pinjam'];
          }else{
            $jml = "0";
            $sisa ="0";
          }
          ?>
          <th class="col-3">Jumlah Barang</th>
          <td>: <?= $row['jumlah_brg']; ?> (diPinjam: <?= $jml." = ".$sisa; ?>)</td>
        </tr>
      </thead>
    </table>
    <div class="form-group">
<!--       ?page=detail&up=ambil&id=<?= $row['id_brg']; ?> -->
      <a href="" class="btn bg-indigo mt-2" data-toggle="modal" data-target="#modal-indigo"><i class="fas fa-level-down-alt"></i> Ambil</a>
<!--       ?page=detail&up=pinjam&id=<?= $row['id_brg']; ?> -->
      <a href="" class="btn btn-info mt-2" data-toggle="modal" data-target="#modal-info"><i class="fas fa-box"></i> Pinjam</a>
      <a href="admin.php" class="btn btn-primary mt-2"><i class="fas fa-step-backward"></i> Kembali</a>
    </div>
	</div>
</div>


<div class="modal fade" id="modal-indigo">
  <div class="modal-dialog">
    <div class="modal-content bg-indigo">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-level-down-alt"></i> Ambil Barang/Alat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="admin/proses/proses_ambil.php" method="post">
          <div class="row">
            <div class="col-sm-6 card p-3 bg-secondary">
              <div class="form-group" hidden>
                <input type="text" name="id_brg" value="<?= $row['id_brg']; ?>" readonly>
                <input type="text" name="barcode_brg" value="<?= $row['barcode_brg']; ?>">
              </div>
              <div class="form-group">
                <label>Nama User</label>
                <select class="select2 form-control form-control-sm" name="id_user" required>
                  <?php 
                  $user = mysqli_query($koneksi, "select * from tb_user");
                  while ($r = mysqli_fetch_array($user)) {
                    echo "<option value='".$r['id_user']."'>".$r['nama_lengkap']."</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tgl barang keluar</label>
                <input type="date" name="tgl_brg_keluar" class="form-control form-control-sm" value="<?= date('Y-m-d'); ?>" required>
              </div>
              <div class="form-group">
                <label>Jumlah brg keluar</label>
                <input type="number" name="jumlah_brg" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="col-sm-6 card bg-secondary p-3">
              <div class="form-group">
                <label>Alamat ruang penggunaan</label>
                <select class="form-control" name="alamat_ruang" required>
                  <option value="C1">Ruang C1</option>
                  <option value="C2">Ruang C2</option>
                  <option value="C3">Ruang C3</option>
                  <option value="C4">Ruang C4</option>
                  <option value="C5">Ruang C5</option>
                  <option value="C6">Ruang C6</option>
                  <option value="Intruktur">Instruktur</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tujuan Penggunaan Barang</label>
                <textarea name="tujuan_gunabarang" class="form-control form-control-sm" placeholder="..." required></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="simpanambil" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
              </div>
              <div class="form-group">
                <!-- ?page=detail&id=<?= $row['id_brg']; ?> -->
                <a href="" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-step-backward"></i> Batal</a>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-light">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-box"></i> Pinjam Barang/Alat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="admin/proses/proses_pinjam.php" method="post">
          <div class="row">
            <div class="col-sm-6 card p-3 bg-secondary">
              <div class="form-group" hidden>
                <label>Barcode Barang</label>
                <input type="text" name="barcode_brg" class="form-control form-control-sm" value="<?= $row['barcode_brg']; ?>" readonly>
                <input type="hidden" name="id_brg" value="<?= $row['id_brg']; ?>">
              </div>
              <div class="form-group">
                <label>Nama Peminjam</label>
                <select class="select2 form-control form-control-sm" name="id_user" required>
                  <?php 
                  $use = mysqli_query($koneksi, "select * from tb_user");
                  while ($row = mysqli_fetch_array($use)) {
                    echo "<option value='".$row['id_user']."'>".$row['nama_lengkap']."</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tgl Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control form-control-sm" value="<?= date('Y-m-d'); ?>" required>
              </div>
              <div class="form-group">
                <label>Jumlah Pinjam</label>
                <input type="number" name="jumlah_brg" class="form-control form-control-sm" placeholder="..." required>
              </div>
              <div class="form-group">
                  <label for="tgl_perkiraan_bali">Tgl Perkiraan dikembalikan</label>
                  <input type="date" name="tgl_perkiraan_balik" class="form-control" require>
              </div>
            </div>
            <div class="col-sm-6 card p-3 bg-secondary">
              <div class="form-group">
                <label>Pilih Organisasi</label>
                <select class="form-control" name="organisasi" required>
                  <option value="guru">Guru</option>
                  <option value="siswa">Siswa</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tujuan Penggunaan Barang</label>
                <textarea name="tujuan_gunabarang" class="form-control form-control-sm" placeholder="..." required></textarea>
              </div>
              <div class="form-group">
                <button type="submit" name="simpanpinjam" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
              </div>
              <div class="form-group">
                <!-- ?page=detail&id=<?= $row['id_brg']; ?> -->
                <a href="" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-step-backward"></i> Batal</a>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-light">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php 
}
?>