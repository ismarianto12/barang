<table class="table table-bordered table-striped">
    <thead>
  <tr>
    <th>No.</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Satuan</th>
    <th>Jumlah Order</th>
    <th>Aksi</th>
  </tr>
    </thead>
    <tbody>
      <?php
    $data_barang=$this->db->query('SELECT * from rn_barang a,tmp_purchase b where a.id_barang=b.id_barang order by a.id_barang');
    $no=1; foreach($data_barang->result_array() as $data): ?> 
    <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
      <tr>
      <td><?= $no ?></td>
      <td><?= $data['kode_barang'] ?></td>
      <td><?= $data['nama_barang'] ?></td>
      <td><?= $data['satuan'] ?></td>
      <td><input type='number' name='jumlah' class='form-control' value='<?= $jumlah ?>' required=""></td>
      <td>
     <button onclick="return hapus(<?= $data['id_barang'] ?>)" class="btn bg-red btn-flat margin"><i class="fa fa-trash"></i></button>
      </td>
      </tr>
    <?php $no++;endforeach; ?>
    <?php if($data_barang->num_rows() == NULL): ?>
    <tr><td colspan="6"><div class="callout callout-info"><i class="fa fa-info"></i> Silahkan Cari Produk Pada Kotak pencarian</div></td>
    </tr>
  <?php endif; ?>
 </tbody>
      </table>
    