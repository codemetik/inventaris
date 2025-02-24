<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-nav">
                <h6 class="card-title">DAFTAR RIWAYAT</h6>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-sm table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>ID Pinjaman</th>
                            <th>Jumlah Pinjam</th>
                            <th>Jumlah Kembali</th>
                            <th>Nama Peminjam</th>
                            <th>Tujuan Penggunaan</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $sql = mysqli_query($koneksi, "select * from tbl_history_pinjam");
                        while($row = mysqli_fetch_array($sql)){ ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['id_brg']; ?></td>
                                <td><?= $row['id_pinjaman'] ?></td>
                                <td><?= $row['jumlahbrg_pinjam']; ?></td>
                                <td><?= $row['jumlahbrg_kembali']; ?></td>
                                <td><?= $row['id_user']; ?></td>
                                <td><?= $row['tujuan_gunabarang']; ?></td>
                                <td><?= $row['tgl_pinjam']; ?></td>
                                <td><?= $row['tgl_kembali']; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>