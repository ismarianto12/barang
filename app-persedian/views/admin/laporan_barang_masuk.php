<?php if($cari == TRUE): ?>

<form action="" method="POST">
<div class="col-md-4">
	 <input type="date" name="dari" class="form-control" placeholder="Masukan awal Bulan ...">
</div>
<div class="col-md-4">
	 <input type="date" name="sampai" class="form-control" placeholder="Masukan Akhir Bulan ...">
</div>
<div class="col-md-4">
	<button class="tampilkan btn btn-info" name="kirim"><i class="fa fa-eye"></i>Tampilkan</button>
	</div>
</form>	
<div class="clearfix"></div>
<hr />
<br />


<?php elseif($cari == FALSE): ?>

<a href="<?= base_url('admin/laporan_barang_masuk/cetak/'.$dari.'/'.$sampai)
?>"   target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak
Laporan</a> <hr /> <?php   $dari= $this->input->post('dari') ?
tgl_indonesia($this->input->post('dari')) : 'Tidak ada tanggal yang di
entrikan silahkan ulangi ';  $sampai=$this->input->post('sampai') ?
tgl_indonesia($this->input->post('sampai')) : 'Tidak ada tanggal yang di
entrikan silahkan ulangi ';  ?> ** )<tt>Histori Laporan Data Barang Dari <?= $dari
?> / Sampai <?= $sampai ?></tt>
<br />

<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Kode Transaksi</th>
		<th>Tanggal</th>
		<th>Kode Barang </th>
		<th>Nama Barang </th>
		<th>Jumlah Masuk</th>
		<th>Satuan </th>
		<th>Aksi</th>
  	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($sql->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= $sq['kode_transaksi'] ?></td>
      <td><?= $sq['tanggal_masuk'] ?></td>
      <td><?= $sq['kode_barang'] ?></td>
      <td><?= $sq['nama_barang'] ?></td>
      <td><?= $sq['jumlah_masuk'] ?></td>
      <td><?= $sq['satuan'] ?></td>
      
      <td><a href="<?= base_url('admin/penerimaan_barang/edit/'.
      $sq['id_barang_masuk']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/penerimaan_barang/delete/'.
      $sq['id_barang_masuk']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>
<?php endif; ?>