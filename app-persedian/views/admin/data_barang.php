<?php  if($form == FALSE): ?>
  <?= $this->session->flashdata('pesan') ?>
  <a href="<?= base_url('admin/data_barang/add') ?>" class="btn bg-red btn-flat margin"><i class="fa fa-plus"></i>Tambah Data</a>
  <a href="<?= base_url('eksport/excel') ?>" class="btn bg-green btn-flat margin"><i class="fa fa-plus"></i>Eksport Data Ke Excel</a>
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
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($data_barang->result_array() as $data): ?>
     <tr>
      <td><?= $no ?></td>
      <td><?= strip_tags($data['kode_barang']) ?></td>
      <td><?= strip_tags($data['nama_barang']) ?></td>
      <td><?= strip_tags($data['stok']) ?></td>
      <td><?= strip_tags($data['satuan'])?></td>
      <td><?= strip_tags($data['nama_lokasi']) ?></td>
      <td><a href="<?= base_url('admin/data_barang/edit/'.$data['id_barang']) ?>" class="btn bg-purple btn-flat margin"><i class="fa fa-edit"></i></a>
       <button onclick='return hapus(<?= $data['id_barang'] ?>)' class="btn bg-red btn-flat margin"><i class="fa fa-trash"></i></button>
     </td>
     
   </tr>
   <?php $no++;endforeach; ?>


 </tbody>
</table>

<?php elseif($form == TRUE): error_reporting(0);  ?>

  <script type="text/javascript">
  // file currency.js
   
  function currency(value, separator) {
        if (typeof value == "undefined") return "0";
        if (typeof separator == "undefined" || !separator) separator = ",";
     
        return value.toString()
                    .replace(/[^\d]+/g, "")
                    .replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
  }
  window.addEventListener('keyup', function(e) {
        var el = e.target;
        if (el.classList.contains('format_koma')) {
              el.value = currency(el.value, el.getAttribute('data-separator'));
        }
    false 
  });
</script>

<?php 
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Kode Barang','text','kode_barang',$kode_barang);
buat_text_box('Nama Barang','text','nama_barang',$nama_barang);
?>

<div class="form-group"><label for="kelas" class="col-sm-2 control-label">Harga Beli</label><div class="col-sm-4"><input type="text" name="harga_beli" class="format_koma form-control" value="<?= $harga_beli ?>" data-separator=","><br></div></div>

<div class="form-group"><label for="kelas" class="col-sm-2 control-label">Harga Jual</label><div class="col-sm-4"><input type="text" name="harga_jual" class="form-control" value="Harga Jual" required="" placeholder="Harga Jual..."><br></div></div>

 

<?php 

  buat_text_box('Stok Barang','number','stok_barang',$stok);
  buat_text_box('Satuan Barang','text','satuan_barang',$satuan);
  $data_lokasi=$this->db->get('rn_lokasi');
  if($data_lokasi->num_rows() > 0 ):
  foreach($data_lokasi->result_array() as $sql):
   $data[]=array('val'=>$sql['id_lokasi'],'cap'=>$sql['nama_lokasi']);
 endforeach;
  else:
    $sql[]="0";
  endif;

 buat_select('Lokasi Posisi Barang','id_lokasi',$data,'');

 $data_kategori=$this->db->get('rn_kategori');
 foreach($data_kategori->result_array() as $sql1):
   $data1[]=array('val'=>$sql1['id_kategori'],'cap'=>$sql1['nama_kategori']);
 endforeach;
 buat_select('Kategori Barang','id_kategori',$data1,'');


 $rn_suplier=$this->db->get('rn_suplier');
 foreach($rn_suplier->result_array() as $sql2):
   $data2[]=array('val'=>$sql2['id_suplier'],'cap'=>$sql2['nama_suplier']);
 endforeach;

 buat_select('Suplier Barang','id_suplier',$data2,'');
 tutup_form();
 
 endif; ?>	
