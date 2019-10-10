 <?php  if($form == FALSE):
 echo $this->session->flashdata('pesan');
 ?>

<a href="<?= base_url('admin/data_kelompok/add') ?>" class="btn bg-maroon btn-flat margin"><i class="fa fa-plus"></i>Tambah Data Kategori Barang</a>
<hr />

<div class="callout callout-danger">Perhatian Sebelum Menghapus Data Kategori Barang Terlebih Dahulu Di Backup XLS .Pada Pada Modul Barang , 
Menghapus Kategori Barang Dapat Menghapus Semua Barang dengan Kategori Yang Di hapus.</div>

<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Nama Kategori </th>
		<th>Tanggal Update</th>
		<th>Status</th>
	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($data->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= $sq['nama_kategori'] ?></td>
      <td><?= tgl_indonesia($sq['tanggal_kategori']) ?></td>
      <td><a href="<?= base_url('admin/data_kelompok/edit/'.
      $sq['id_kategori']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/data_kelompok/delete/'.
      $sq['id_kategori']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>

<?php elseif($form == TRUE):  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Nama Kategori','text','nama_kategori',$nama_kategori);
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
