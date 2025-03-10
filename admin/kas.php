<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header bg-indigo">
        <h6 class="card-title">Daftar Barang diPinjam</h6>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-sm table-striped table-hover table-valign-middle">
          <thead>
            <tr>
              <th>No</th>
              <th>Tgl Pinjam</th>
              <th>Foto Brg</th>
              <th>Kode Barcode</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Tujuan Penggunaan</th>
              <th>Nama Peminjam</th>
              <th>Organisasi</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            $sql = mysqli_query($koneksi, "select * from tbl_pinjaman x inner join tbl_barang y on y.id_brg = x.id_brg where status != 'dikembalikan' group by id_pinjaman desc");
            while ($row = mysqli_fetch_array($sql)) { 
              $user = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_user where id_user = '".$row['id_user']."'"));
              ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['tgl_pinjam']; ?></td>
              <td><img src="dist/upload_img/<?= $row['gambar_brg']; ?>" width="90px" height="90px"></td>
              <td><?= $row['barcode_brg']; ?></td>
              <td><?= $row['nama_brg']; ?></td>
              <td><?= $row['jumlah_pinjam']; ?></td>
              <td><?= $row['tujuan_gunabarang']; ?></td>
              <td><?= $user['nama_lengkap']; ?></td>
              <td><?= $row['organisasi']; ?></td>
              <td><a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-success<?= $row['id_pinjaman']; ?>"><i class="fas fa-journal-whills"></i> Kembalikan</a></td>
            </tr>
                  <div class="modal fade" id="modal-success<?= $row['id_pinjaman']; ?>">
                    <div class="modal-dialog">
                    <form action="" method="post">
                      <div class="modal-content bg-success">
                        <div class="modal-header">
                          <h4 class="modal-title">Pengembalian Pinjaman</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group" >
                            <input type="text" name="id_pinjaman" class="form-control" value="<?= $row['id_pinjaman'] ?>">
                            <input type="text" name="id_brg" class="form-control" value="<?= $row['id_brg']; ?>">
                            <input type="text" name="id_user" class="form-control" value="<?= $user['id_user']; ?>">
                          </div>
                            <div class="form-group">
                              <label>Jumlah yg dikembalikan</label>
                              <input type="text" name="jumlah_brg" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="submit" class="btn btn-outline-light" name="simpankembali">Simpan</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </form>
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Tgl Pinjam</th>
              <th>Foto</th>
              <th>Barcode</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Tujuan Penggunaan</th>
              <th>Nama Peminjam</th>
              <th>Organisasi</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<?php 
if (isset($_POST['simpankembali'])) {
  $id_pinjaman = $_POST['id_pinjaman'];
  $id_brg = $_POST['id_brg'];
  $id_user = $_POST['id_user'];
  $jumlah_brg = $_POST['jumlah_brg'];

  $jenis_activ = "diKembalikan";
  $waktu_sekarang = date('h:i:s');
  $tgl_kembali = date('Y-m-d');

  $brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_barang where id_brg = '".$id_brg."'"));
  
  $row = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_pinjaman where id_pinjaman = '".$id_pinjaman."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'"));
  //jika ada tiket
  $sql_tiket = mysqli_num_rows(mysqli_query($koneksi, "select * from tbl_tiketuser where id_brg = '".$brg['id_brg']."' and id_user = '".$id_user."'"));

  if ($jumlah_brg == $row['jumlah_pinjam']) {
    //jika jumlah pinjam dikembalikan semua

    //jika ada tiket
    if($sql_tiket > 0){
      $eksekusi = mysqli_query($koneksi, "delete from tbl_tiketuser where id_brg = '".$brg['id_brg']."' and id_user = '".$id_user."'");
    }
    
    $query = mysqli_query($koneksi, "update tbl_pinjaman set jumlah_pinjam = jumlah_pinjam - '".$jumlah_brg."', status = 'dikembalikan' where id_pinjaman = '".$row['id_pinjaman']."'");    
    $hist = mysqli_query($koneksi, "insert into tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) values('','".$jenis_activ."','".$id_brg."', '".$brg['nama_brg']."','".$jumlah_brg."','".$tgl_kembali."','".$waktu_sekarang."')");
    $hist_pinjam = mysqli_query($koneksi, "update tbl_history_pinjam set jumlahbrg_kembali = jumlahbrg_kembali + '".$jumlah_brg."', tgl_kembali = '".$tgl_kembali."' where id_pinjaman = '".$id_pinjaman."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'");

  }else if($jumlah_brg < $row['jumlah_pinjam']){
    //jika jumlah pinjam dikembalikan kurang dari jumlah pinjam di awal
    
    //jika ada tikets
    if($sql_tiket > 0){
      $eksekusi = mysqli_query($koneksi, "delete from tbl_tiketuser where id_brg = '".$brg['id_brg']."' and id_user = '".$id_user."'");
    }
    
    $query = mysqli_query($koneksi,"update tbl_pinjaman set jumlah_pinjam = jumlah_pinjam - '".$jumlah_brg."', status = 'dipinjam' where id_pinjaman = '".$row['id_pinjaman']."'");
    $hist = mysqli_query($koneksi, "insert into tbl_history(id_history, jenis_aktivitas, id_brg, nama_brg, jumlah_brg, tgl_history, waktu_history) values('','".$jenis_activ."','".$id_brg."', '".$brg['nama_brg']."','".$jumlah_brg."','".$tgl_kembali."','".$waktu_sekarang."');");
    $hist_pinjam = mysqli_query($koneksi, "update tbl_history_pinjam set jumlahbrg_kembali = jumlahbrg_kembali + '".$jumlah_brg."', tgl_kembali = '".$tgl_kembali."' where id_pinjaman = '".$id_pinjaman."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'");

  }else if($jumlah_brg > $row['jumlah_pinjam']){
    echo "<script>
    alert('Jumlah yang dikembalikan melebihi jumlah pinjaman di awal!');
    document.location.href = 'admin.php?page=kas';
    </script>";
  }

  if ($query && $hist) {
    $cekpin = mysqli_fetch_array(mysqli_query($koneksi, "select * from tbl_pinjaman where id_pinjaman = '".$id_pinjaman."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'"));
    if($cekpin['jumlah_pinjam'] == '0'){
      $up = mysqli_query($koneksi, "update tbl_pinjaman set status = 'dikembalikan' where id_pinjaman = '".$id_pinjaman."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'");
    }

    echo "<script>
    alert('Data Berhasil Disimpan');
    document.location.href = 'admin.php?page=kas';
    </script>";

  }else{
    echo "<script>
    alert('Data Gagal Disimpan');
    document.location.href = 'admin.php?page=kas';
    </script>";
  }
}
?>