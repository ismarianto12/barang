<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Kode Transaksi</th>
		<th>Tanggal Keluar</th>
		<th>Nama Penerima </th>
		<th>Alamat</th>
		<th>Jumlah Barang</th>
		<th>Operator </th>
		<th>Aksi</th>
  	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($sql->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= strip_tags($sq['kode_transaksi']) ?></td>
      <td><?= strip_tags($sq['tanggal_keluar']) ?></td>
      <td><?= strip_tags($sq['penerima']) ?></td>
      <td><?= strip_tags($sq['alamat']) ?></td>
      <td><?= strip_tags($sq['jumlah_keluar']) ?></td>
      <td><?= strip_tags($sq['nama']) ?></td>
      <td><a href="<?= base_url('admin/cetak_faktur_keluar/cetak/'.
      $sq['id_barang_keluar']) ?>" target="_blank" class="btn bg-olive btn-flat margin"><i class="fa fa-print"></i></a>
      </td>
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>