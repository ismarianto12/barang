<?php  if($form == FALSE):
 echo $this->session->flashdata('pesan');
 ?>

<a href="<?= base_url('admin/data_suplier/add') ?>" class="btn bg-maroon btn-flat margin"><i class="fa fa-plus"></i>Tambah Data Suplier</a>
<hr />
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Nama Suplier</th>
		<th>Alamat </th>
		<th>Handphone</th>
		<th>No rekening</th>
	  <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($suplier->result_array() as $data): ?>
      
      <tr>
      <td><?= $no ?></td>
      <td><?= strip_tags($data['nama_suplier']) ?></td>
      <td><?= strip_tags($data['alamat_suplier']) ?></td>
      <td><?= strip_tags($data['no_hp']) ?></td>
      <td><?= strip_tags($data['no_rek']) ?></td>
      <td><a href="<?= base_url('admin/data_suplier/edit/'.$data['id_suplier']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/data_suplier/delete/'.$data['id_suplier']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>

<?php elseif($form == TRUE):  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('NAMA SUPLIER','text','nama_suplier',$nama_suplier);
buat_text_area('Alamat Suplier','','','alamat_suplier',$alamat_suplier);
buat_text_box('No Handphone','number','no_hp',$no_hp);
buat_text_box('Nomor Rekening','number','no_rek',$no_rek);
 
tutup_form();
 endif; ?>	
