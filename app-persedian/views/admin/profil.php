<?= $this->session->flashdata('pesan'); ?>
<small>** <i>Jika Foto Tidak Di Ganti Silahkan Di Kosongkan. </i></small>
<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table-striped">
	<tr><th>Username</th><td><input type="text" name="username" class="form-control" value="<?= $username ?>"></td></tr>
	<tr><th>Password</th><td><input type="password" name="password" class="form-control"></td></tr>
	<tr><th>Email</th><td><input type="email" name="email" class="form-control" value="<?= $email ?>"></td></tr>
	<tr><th>Foto</th><td>
		<img src="<?= base_url('assets/file/'.$foto) ?>" class="img-responsive" style="width: 150px;height: 100px">
        <input type="file" name="gambar" class="form-control" value="">
	</td></tr>
	<tr><th>Nama</th><td><input type="text" name="nama" class="form-control" value="<?= $nama ?>">
	</td></tr>
	<tr><th></th><td><button type="submit" name="kirim" class="btn btn-info"><i class="fa fa-profil"></i>Edit Profil</button></td></tr>
</table>
</form>
 