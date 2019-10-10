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

<a href="<?= base_url('admin/laporan_barang_keluar/cetak/'.$dari.'/'.$sampai) ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan PDF</a>
<a href="<?= base_url('eksport/excel_barang_keluar/'.$dari.'/'.$sampai) ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan Excel</a>
<hr />
 <table id="example1" class="table table-bordered table-striped">
    <thead>
  <tr>
    <th>No.</th>
    <th>Kode Transaksi</th>
    <th>Tanggal</th>
    <th>Kode Barang </th>
    <th>Nama Penerima </th>
    <th>Jumlah Barang</th>
    <th>Operator </th>
     
    </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($sql->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= $sq['kode_transaksi'] ?></td>
      <td><?= $sq['tanggal_keluar'] ?></td>
      <td><?= $sq['kode_barang'] ?></td>
      <td><?= $sq['penerima'] ?></td>
      <td><?= $sq['jumlah_keluar'] ?></td>
      <td><?= strip_tags($sq['nama']) ?></td>
      
       
      </tr>
    <?php $no++;endforeach; ?>


    </tbody>
  </table>
<?php endif; ?>