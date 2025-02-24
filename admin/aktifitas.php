<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-nav">
                <h6 class="card-title">DAFTAR AKTIFITAS</h6>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-sm table-hover table-bordered table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Hist</th>
                            <th>Jenis Akifitas</th>
                            <th>ID Brg</th>
                            <th>Nama Brg</th>
                            <th>Jumlah</th>
                            <th>Tgl & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $sql = mysqli_query($koneksi, "select * from tbl_history group by id_history desc");
                        while($row = mysqli_fetch_array($sql)){ ?>
                            <tr>
                                <td><?= $no++;?></td>
                                <td><?= $row['id_history']; ?></td>
                                <td><?= $row['jenis_aktivitas']; ?></td>
                                <td><?= $row['id_brg']; ?></td>
                                <td><?= $row['nama_brg']; ?></td>
                                <td><?= $row['jumlah_brg']; ?></td>
                                <td><?= $row['tgl_history']. " ".$row['waktu_history']; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>