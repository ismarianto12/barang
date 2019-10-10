<?php  if($form == FALSE): echo $this->session->flashdata('pesan');?>
<a href="<?= base_url('admin/barang_keluar/add') ?>" class="btn bg-green btn-flat margin"><i class="fa fa-plus"></i>Tambah Data Barang Keluar</a>
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
		<th>Aksi</th>
  	</tr>
	  </thead>
	  <tbody>
    <?php $no=1; foreach($sql->result_array() as $sq): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= strip_tags($sq['kode_transaksi']) ?></td>
      <td><?= strip_tags($sq['tanggal_keluar']) ?></td>
      <td><?= strip_tags($sq['kode_barang']) ?></td>
      <td><?= strip_tags($sq['penerima']) ?></td>
      <td><?= strip_tags($sq['stok']) ?> / <b><?= strip_tags($sq['satuan']) ?></b></td>
      <td><?= strip_tags($sq['nama']) ?></td>
      <td><a href="<?= base_url('admin/barang_keluar/edit/'.
      $sq['id_barang_keluar']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
      <a href="<?= base_url('admin/barang_keluar/delete/'.
      $sq['id_barang_keluar']) ?>" class="btn bg-maroon  btn-flat margin"><i class="fa fa-trash"></i>
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


	  </tbody>
	</table>

<?php elseif($form == TRUE):  ?>

 
<script type="text/javascript">
   function reset_pencarian(){
     $('.hasil_barang').html('');  
   }


  $(function(){
  $('#reset_pencarian').click(function(e){
    e.preventDefault();
    reset_pencarian(); 
  }); 

  $('.hasil_barang').html('<input type="text" id="barang_modal" class="form-control" placeholder="Cari Data Barang ...">');
   $('#barang_modal').click(function(){
    $('#myModal').modal('show');
    });

   $('.id_barang').click(function(){
   $('#myModal').modal('hide');
   var id = $(this).val();
    $.ajax({ 
        url:'<?= base_url('/admin/cari_id_barang') ?>',
          type:'POST',
          data : {id : id},
          dataType:'json',
          async : false,
          chace : false,
         
    success:function(data){
    var i;
    for(i=0; i< data.length; i++){
          $('.hasil_barang').html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i>Data Barang</div><table class="table table-striped"><tr><td>Kode Barang</td><td>'+data[i].nama_barang+'</td></tr><tr><td>Harga Beli</td><td>'+data[i].harga_beli+'</td></tr><tr><td>Harga Jual</td><td>'+data[i].harga_jual+'</td></tr><tr><td>Stok</td><td>'+data[i].stok+'</td></tr></table><input type="hidden" name="id_barang" value='+data[i].id_barang+'><button class="btn btn-success" id="reset_pencarian"><i class="fa fa-search"></i>Reset Pencarian</button>');   
      }
          },  
        });

    return false;
    });
  
/*manampilkan data kategori*/
});
</script>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-database"></i>Data Barang </h3>
                  </div>
                  <div class="modal-body">
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
      <td><?= $data['kode_barang'] ?></td>
      <td><?= $data['nama_barang'] ?></td>
      <td><?= $data['stok'] ?></td>
      <td><?= $data['satuan'] ?></td>
      <td><?= $data['nama_lokasi'] ?></td>
      <td> 
      <input type="radio" class="id_barang" value="<?= $data['id_barang'] ?>"> Pilih
      </td>
    
      </tr>
    <?php $no++;endforeach; ?>


    </tbody>
  </table>

                </div>
              </div>
            </div>
          </div>
               

<div class="clearfix"></div>
<?= $this->session->flashdata('pesan'); ?>
	<?php  
echo $this->session->flashdata('pesan');
buka_form();
buat_text_box('Kode Transaksi','text','kode_transaksi',$kode_transaksi);
buat_text_box('Tanggal Keluar Barang','date','tanggal_keluar',$tanggal_keluar);
if($aksi == "edit"){
  echo '<tr><td></td><td><div class="callout callout-warning">Data Jumlah Barang Keluar Tidak Bisa Di Edit</div>
     </td></tr>';
}elseif($aksi == "add"){
buat_text_box('Jumlah Barang Keluar','number','jumlah_keluar',$jumlah_keluar);
}
buat_text_box('Nama Penerima','text','penerima',$penerima);
$client=$this->db->get('rn_barang');
foreach($client->result_array() as $sql1):
   $data[]=array('val'=>$sql1['id_barang'],'cap'=>$sql1['nama_barang']);
endforeach;
echo "<tr><th>Cari Data Barang</th><td><div class='hasil_barang'></div></td></tr>";
buat_text_area('Alamat Penerima','','','alamat_penerima',$alamat_penerima);
tutup_form();
 endif; ?>	


 