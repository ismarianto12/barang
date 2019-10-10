<?php if($form != "y"){ ?>

<a href="<?= base_url('admin/hak_akses/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Hak Akses</a>
<br /><br /><br />

<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Username</th>
		<th>Nama</th>
		<th>Level</th>
		<th>Log Akses</th>
	    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
<?php $no=1; foreach($data->result_array() as $sql): ?>
<tr>
<td><?= $no ?></td>	
<td><?= strip_tags($sql['username']) ?></td>
<td><?= strip_tags($sql['nama'])?></td>
<td><?= strip_tags($sql['level'])?></td>
<td><?= strip_tags($sql['log']) ?></td>
<td><a href="<?= base_url('/admin/hak_akses/edit/'.$sql['id_admin']) ?>" class="btn btn-primary">Edit</a> &nbsp;&nbsp;
    <a href="<?= base_url('admin/hak_akses/delete/'.$sql['id_admin']) ?>" class="btn btn-danger">Hapus</a>
   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal<?= $no ?>">
                <i class="fa fa-eye"></i>Detail
              </button>
</tr>
</tbody>
<?php $no++; endforeach; ?>

	</table>
 
 <?php $no=1; foreach($data->result_array() as $data):
  
  ?>
<div class="modal fade" id="myModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"><div class="callout callout-info"><i class="fa fa-database"></i>  Detail Data Pegawai Dan Hak Akses</div></h4>
                        <br />
                        
                    </div>
                    <div class="modal-body">

 
<table class="table table-striped">
        <tr><th>Username</th><td><?= $data['username'] ?></td></tr>
        <tr><th>Nama</th><td><?= $data['nama'] ?></td></tr>
        <tr><th>Foto</th><td><img src="<?= base_url('/assets/file/'.$data['foto']) ?>" class="img-responsive" style="width: 150px;height: 150px">
   </td></tr>
	<tr><td>Email</td><td><?= $data['email'] ?></td></tr>
	<tr><td>Level Akses</td><td><?= $data['level'] ?></td></tr>

</table>
    </div>
                 <div class="modal-footer">
                 	 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-share"></i>Tutup Dialog </button>
                 </div>
             </div>
         </div>
     </div>

 <?php $no++; endforeach; ?>

<?php }elseif($form =="y"){ 
echo $this->session->flashdata('pesan');

buka_form();
buat_text_box('Username','','username',$username);
buat_text_box('Nama','','nama',$nama);
buat_text_box('Email','email','email',$email);
buat_text_box('Password','password','');

if ($this->uri->segment(4)) {
    echo "
<center>
    <img src='".base_url('/assets/file/'.$gambar)."' class='image-responsive' style='width:120px; height:120px'></center>";
}

buat_text_box('Foto','file','foto','');

$level[]=array('val'=>'admin','cap'=>'Administrator');
$level[]=array('val'=>'user','cap'=>'User');

buat_select('Level Akses','level',$level,'');
tutup_form($aksi);

}    ?>


