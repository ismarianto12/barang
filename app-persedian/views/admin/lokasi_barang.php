 <?php  if($form == FALSE):
 echo $this->session->flashdata('pesan');
 ?>

<a href="<?= base_url('admin/lokasi_barang/add') ?>" class="btn bg-maroon btn-flat margin"><i class="fa fa-plus"></i>Tambah Data</a>
<hr />
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Nama Lokasi </th>
		<th>Gedung Utama</th>
		<th>Tanggal Lokasi</th>
    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($data->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= $sq['nama_lokasi'] ?></td>
      <td><?= $sq['gedung_utama'] ?></td>
      <td><?= tgl_indonesia($sq['tanggal_lokasi']) ?></td>
      <td><a href="<?= base_url('admin/lokasi_barang/edit/'.
      $sq['id_lokasi']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/lokasi_barang/delete/'.
      $sq['id_lokasi']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>

<?php elseif($form == TRUE):  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Nama Lokasi','text','nama_lokasi',$nama_lokasi);
buat_text_box('Gedung Utama','text','gedung_utama',$gedung_utama);
tutup_form();
 endif; ?>	


         
<!-- id_project
kode_project
nama_project
tanggal_order
tanggal_kirim
id_client
kontak
status -->
