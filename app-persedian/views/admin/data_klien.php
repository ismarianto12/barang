<?php  if($form == FALSE):
 echo $this->session->flashdata('pesan');
 ?>

<a href="<?= base_url('admin/data_klien/add') ?>" class="btn bg-maroon btn-flat margin"><i class="fa fa-plus"></i>Tambah Data</a>
<hr />
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Nama Client</th>
		<th>Company  </th>
		<th>Divisi</th>
		<th>No Telp</th>
	  <th>Alamat</th>
    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($sql->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= strip_tags($sq['nama_client']) ?></td>
      <td><?= strip_tags($sq['perusahaan']) ?></td>
      <td><?= strip_tags($sq['divisi']) ?></td>
      <td><?= strip_tags($sq['no_telp']) ?></td>
      <td><?= strip_tags($sq['alamat']) ?></td>
      <td><a href="<?= base_url('admin/data_klien/edit/'.
      $sq['id_client']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/data_klien/delete/'.
      $sq['id_client']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>

<?php elseif($form == TRUE):  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Nama Client','text','nama_client',$nama_client);
buat_text_area('Perusahaan','','','perusahaan',$perusahaan);
buat_text_box('Divisi','text','divisi',$divisi);
buat_text_box('Nomor Hanphone/Telp','number','no_telp',$no_telp);
buat_text_area('Alamat','','','alamat',$alamat);

tutup_form();
 endif; ?>	

