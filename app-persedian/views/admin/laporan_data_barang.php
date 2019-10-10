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

<a href="<?= base_url('admin/laporan_stok_barang/cetak/'.$dari.'/'.$sampai) ?>"  target="_blank" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a>
<hr />
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Stok</th>
		<th>Satuan</th>
	    <th>Lokasi</th>
	    
	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($data_barang->result_array() as $data): ?>
      
      <tr>
      <td><?= $no ?></td>
      <td><?= $data['kode_barang'] ?></td>
      <td><?= $data['nama_barang'] ?></td>
      <td><?= $data['stok'] ?></td>
      <td><?= $data['satuan'] ?></td>
      <td><?= $data['nama_lokasi'] ?></td>
      
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>



<?php endif; ?>