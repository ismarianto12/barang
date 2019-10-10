<table class="table table-bordered table-striped">
    <thead>
  <tr>
    <th>No.</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Satuan</th>
    <th>Jumlah Pesanan Barang</th>
    <th>Aksi</th>
  </tr>
    </thead>
  <tbody><?php $no=1; foreach($data->result_array() as $barang): ?>
 <tr>
   <td><?= $no ?></td>
   <td><?= $barang['kode_barang'] ?></td>
   <td><?= $barang['nama_barang'] ?></td>
   <td><?= $barang['satuan'] ?></td>
   <td><?= $barang['jumlah'] ?> / <?= $barang['satuan'] ?></td>
   <td><button class="btn btn-warning" onclick="return hapus_barang_sb('<?= $barang['id_barang'] ?>')"><i class="fa fa-save"></i></button></td>
 </tr>

 <?php $no++; endforeach ?> 
 </tbody>
 </table>
 