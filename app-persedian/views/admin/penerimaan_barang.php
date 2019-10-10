 <script type="text/javascript">
$(function(){
  $('.hasil_barang').html('<div class="callout callout-info"><i class="fa fa-refresh fa-spin"></i>Data Di Proses</div>');
	$('#id_barang').change(function(){
   var id = $('#id_barang').val();

		$.ajax({ 
	      url:'<?= base_url('/admin/cari_id_barang') ?>',
          type:'POST',
          data : 'id=' + id,
          dataType:'json',
          async : false,
          chace : false,
         
    success:function(data){
    var i;
    for(i=0; i< data.length; i++){
          $('.hasil_barang').html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i>Data Barang</div><table class="table table-striped"><tr><td>Kode Barang</td><td>'+data[i].nama_barang+'</td></tr><tr><td>Harga Beli</td><td>'+data[i].harga_beli+'</td></tr><tr><td>Harga Jual</td><td>'+data[i].harga_jual+'</td></tr><tr><td>Stok</td><td>'+data[i].stok+'</td></tr></table><hr /><br />');   
      }
          },  
        });

    return false;
   	});
/*manampilkan data kategori*/
});

 </script>

 <?php  if($form == FALSE):
 echo $this->session->flashdata('pesan');
 ?>

<a href="<?= base_url('admin/penerimaan_barang/add') ?>" class="btn bg-maroon btn-flat margin"><i class="fa fa-plus"></i>Tambah Data </a>
<hr />
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

<?php elseif($form == TRUE):  ?>
<div class="hasil_barang"></div>
	<?php  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Kode Transaksi','text','kode_transaksi',$kode_transaksi);
buat_text_box('Tanggal Masuk Barang','date','tanggal_masuk',$tanggal_masuk);
buat_text_box('Jumlah Masuk Barang','number','jumlah_masuk',$jumlah_masuk);
$client=$this->db->get('rn_barang');
foreach($client->result_array() as $sql1):
   $data[]=array('val'=>$sql1['id_barang'],'cap'=>$sql1['nama_barang']);
endforeach;
buat_select('Pilih Data Barang','id_barang',$data,'');
  
tutup_form();
 endif; ?>	


 