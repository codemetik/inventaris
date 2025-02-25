<div class="row">
   <div class="col-md-12">
  <!-- Widget: user widget style 1 -->
  <div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-nav">
      <h3 class="widget-user-username"> <a href="" class="text-orange" data-toggle="modal" data-target="#modal-sm<?= $show['id_user']; ?>"><?= $show['nama_lengkap']; ?></a></h3>
      <h5 class="widget-user-desc"><?= $show['position']; ?></h5>
    </div>
    <div class="widget-user-image">
      <img class="img-circle elevation-2" src="dist/upload_img/<?= $show['img_profile']; ?>" alt="User Avatar" data-toggle="modal" data-target="#modal-profile<?= $show['id_user']; ?>">
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header">Username</h5>
            <span class="description-text"><input class="text-center form-control" type="text" value="<?= $show['user']; ?>" readonly></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header">Password</h5>
            <span class="description-text"><input class="text-center form-control" type="password" value="<?= $show['pass']; ?>" readonly></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">Email</h5>
            <span class="description-text"><?= $show['email']; ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">Tempat & Tgl Lahir</h5>
            <span class="description-text"><?= $show['temp_lahir']. ", ". $show['tgl_lahir']; ?></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">Alamat Lengkap</h5>
            <span class="description-text"><textarea class="form-control" readonly><?= $show['alamat_sekarang']; ?></textarea></span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <a href="#" class="btn elevation-2 btn-block" data-toggle="modal" data-target="#modal-sm-edit"><b><i class="fas fa-edit text-orange"></i> Edit Profile</b></a>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
  <!-- /.widget-user -->
  </div>
  <!-- /.col -->
</div>

<!-- modal foto profile -->
      <div class="modal fade" id="modal-profile<?= $show['id_user']; ?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <form action="admin/proses/proses_simpanfoto_profile.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
            	<div class="card-body">
            	  <div class="form-group" hidden>
                  <input type="text" name="id_user" value="<?= $show['id_user']; ?>">
                </div>
                <div class="form-group mb-1">
                  <label for="img">Ubah foto profile</label>
                  <!-- <input type="file" id="img" class="form-control"> -->
                  <input type="file" accept="images/*" onchange="loadFile(event)" name="gambar" id="gambar" required>
                </div>
            	</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="simpanprofile" class="btn btn-primary"><i class="fas fa-save"></i> Save Change</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


<!-- modal nama -->
      <div class="modal fade" id="modal-sm<?= $show['id_user']; ?>">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
          <form action="" method="post">
            <div class="modal-header">
            	<div class="card-body">
                <div class="form-group" hidden>
                  <input type="text" name="id_user" value="<?= $show['id_user']; ?>">
                </div>
            	  <div class="form-group mb-1">
                  <label for="nama">Nama</label>
                  <input type="text" id="nama" name="nama_lengkap" class="form-control" value="<?= $show['nama_lengkap']; ?>">
                </div>
                <div class="form-group mb-1">
                  <label for="position">Position</label>
                  <input type="text" id="position" name="position" class="form-control" value="<?= $show['position']; ?>" readonly>
                </div>
            	</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="simpannama" class="btn btn-primary"><i class="fas fa-save"></i> Save Change</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- modal edit -->
      <div class="modal fade" id="modal-sm-edit">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
          <form action="" method="post">
            <div class="modal-header">
            	<div class="card-body">
                <div class="form-group" hidden>
                  <input type="text" name="id_user" value="<?= $show['id_user']; ?>">
                </div>
            	  <div class="form-group mb-1">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" class="form-control" value="<?= $show['user']; ?>">
                </div>
                <div class="form-group mb-1">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control check" value="<?= $show['pass']; ?>">
                  <input type="checkbox" class="form-checkbox"> Show password
                </div>
                <div class="form-group mb-1">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="<?= $show['email']; ?>">
                </div>
                <div class="form-group mb-1">
                  <label for="tlahir">Tempat & Tanggal Lahir</label>
                  <input type="text" id="tempat" name="tempat" class="form-control" value="<?= $show['temp_lahir']; ?>">
                  <input type="date" id="tgllahir" name="tgllahir" class="form-control" value="<?= $show['tgl_lahir']; ?>">
                </div>
                <!-- <div class="form-group mb-1">
                  <label for="tglahir">Tanggal Lahir</label>
                  <input type="date" id="tglahir" class="form-control" value="">
                </div> -->
                <div class="form-group mb-1">
                  <label for="alamat">Alamat Lengkap</label>
                  <textarea type="text" id="alamat" name="alamat" class="form-control"><?= $show['alamat_sekarang']; ?></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="savedata" class="btn btn-primary"><i class="fas fa-save"></i> Save Change</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php

if(isset($_POST['savedata'])){
  $id_user = $_POST['id_user'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $tempat = $_POST['tempat'];
  $tgllahir = $_POST['tgllahir'];
  $alamat = $_POST['alamat'];

  $sql = mysqli_query($koneksi, "update tb_user set user = '".$username."', pass = '".$password."', email = '".$email."', temp_lahir = '".$tempat."', tgl_lahir = '".$tgllahir."', alamat_sekarang = '".$alamat."' where id_user = '".$id_user."'");

  if($sql){
    echo "<script>
    alert('Data berhasil disimpan');
    document.location.href = 'admin.php?page=profile';
    </script>";
  }else{
    echo "<script>
    alert('Data berhasil disimpan');
    document.location.href = 'admin.php?page=profile';
    </script>";
  }
}else if(isset($_POST['simpannama'])){
  $id_user = $_POST['id_user'];
  $nama_lengkap = $_POST['nama_lengkap'];

  $sql = mysqli_query($koneksi, "update tb_user set nama_lengkap = '".$nama_lengkap."' where id_user = '".$id_user."'");

  if($sql){
    echo "<script>
    alert('Data Nama berhasil disimpan');
    document.location.href = 'admin.php?page=profile';
    </script>";
  }else{
    echo "<script>
    alert('Data Nama gagal disimpan');
    document.location.href = 'admin.php?page=profile';
    </script>";
  }
}
?>

<script type="text/javascript">
	var loadFile = function(event){
		var output = document.getElementById('output');
		output.src=URL.createObjectURL(event.target.files[0]);
	}
</script>