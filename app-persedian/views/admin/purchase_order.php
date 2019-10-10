<?php  if($form == FALSE): ?>
  <?= $this->session->flashdata('pesan') ?>
  <a href="<?= base_url('admin/purchase_order/add') ?>" class="btn bg-green btn-flat margin"><i class="fa fa-plus"></i>Tambah Data Purchase</a>

  <hr />
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Kode Purchase</th>
        <th>Tanggal</th>
        <th>Nama Suplier</th>
        <th>Jumlah Barang / Persatuan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($sql->result_array() as $data):
             $jumlah =$this->madmin->hitung_data($data['kode_purchase'])->row_array(); 
        ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $data['kode_purchase'] ?></td>
        <td><?= $data['tanggal_purchase'] ?></td>
        <td><?= $data['suplier'] ?></td>
        <td><?= $jumlah['total_barang'] ?>/ <b><?= $data['satuan'] ?></b></td>
        <td>
          <a href="<?= base_url('admin/purchase_order/edit/'.$data['kode_purchase']) ?>" class="btn bg-olive btn-flat margin"><i class="fa fa-edit"></i></a>
          <a href="<?= base_url('admin/purchase_order/print/'.$data['kode_purchase']) ?>" target="_blank" class="btn bg-yellow btn-flat margin"><i class="fa fa-print"></i>Cetak Data</a> 
          <?php if($this->session->userdata('level') == "user"): ?>
          
          <?php else: ?>
          <a href="<?= base_url('admin/purchase_order/delete/'.$data['kode_purchase']) ?>" class="btn bg-red btn-flat margin"><i class="fa fa-trash"></i></a>
          <?php endif; ?>
          </td>
        </tr>
        <?php $no++;endforeach; ?>
 
      </tbody>
    </table>

  <?php elseif($form == TRUE):  ?>


    <script type="text/javascript">
      $(function(){ 
        $('#load_barang').load('<?= base_url('admin/list_tmp') ?>');    
        $('.tmp_barang').html('<input type="text" id="barang_modal" class="form-control" placeholder="Cari Data Barang ...">');

        $('#barang_modal').click(function(){
          $('#myModal').modal('show');
        });

        $('.id_barang').click(function(){
          $('#myModal').modal('hide');
          var id =$(this).val();
          $.ajax({ 
            url:'<?= base_url('admin/tmp_barang') ?>',
            type:'POST',
            data : 'id='+id,
            success:function(data){
              $('#load_barang').load('<?= base_url('admin/list_tmp') ?>');      
              $('#notif').html(data);
            },
            error:function(data){
               console.log(data);
            }
          });
          /*manampilkan data kategori*/
        });
      });

    function hapus(id) {
      
     if (confirm('Anda Yakin Menghapus Data Ini ?')) {
          $.ajax({ 
            url:'<?= base_url('admin/tmp_barang/delete') ?>',
            type:'POST',
            data : 'id='+id,
            success:function(data){
              $('#load_barang').load('<?= base_url('admin/list_tmp') ?>');      
            },
           
          });
     }

  }
  
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i>Data Barang </h3>
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
            <?php
            $no=1; foreach($this->madmin->data_barang()->result_array() as $data): ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $data['kode_barang'] ?></td>
              <td><?= $data['nama_barang'] ?></td>
              <td><?= $data['stok'] ?></td>
              <td><?= $data['satuan'] ?></td>
              <td><?= $data['nama_lokasi'] ?></td>
              <td> 
                <input class="id_barang" type="radio" value="<?= $data['id_barang'] ?>"> Pilih
              </td>
            </tr>
            <?php $no++;endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<hr /> 

<!-- moda purchase  -->


<div class="modal fade" id="supliermodal" tabindex="-1" role="dialog" aria-labelledby="supliermodalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="supliermodalLabel"><i class="fa fa-cube"></i>Data Suplier </h3>
      </div>
      <div class="modal-body">
     
<hr />

<table id="tabel1" class="table table-bordered table-striped">
    <thead>
  <tr>
    <th>No.</th>
    <th>Nama Suplier</th>
    <th>Alamat </th>
    <th>Handphone</th>
    <th>No rekening</th>
    <th>Aksi</th>
  </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($suplier->result_array() as $spr): ?>
      <tr>
      <td><?= $no ?></td>
      <td><?= $spr['nama_suplier'] ?></td>
      <td><?= $spr['alamat_suplier'] ?></td>
      <td><?= $spr['no_hp'] ?></td>
      <td><?= $spr['no_rek'] ?></td>
      <td> <input class="pilih_sp" type="radio" value="<?= $spr['id_suplier'] ?>"> Pilih
      </td>
       
      </tr>
    <?php $no++;endforeach; ?>


    </tbody>
  </table>

      </div>
    </div>
  </div>
</div>

<!-- end mode purchase -->


<script type="text/javascript">
 $(function () {
    $('#tabel1').DataTable({
      'responsive' : false,
   });
 $('#tablex').DataTable({
      'responsive' : false,
   });
 });
 
 $(function(){
    $('.notif_suplier').hide();
    $('.cari_db').click(function(){
       $('#supliermodal').modal('show');
       $('.pilih_sp').click(function(){
         var id =$(".pilih_sp").val();
         $.ajax({
            url :'<?= base_url('admin/cari_suplier') ?>',
            type:'POST',
            data:'id_sp='+id,
            dataType:'JSON',
            asynch:false,
            chace:false,
          success:function(data){
            var i;
            for (var i = 0; i < data.length; i++) {
              $('#nama_suplier').val(data[i].nama_suplier);
              $('#alamat_suplier').val(data[i].alamat_suplier);
             }
            $('.notif_suplier').show();
            $('.notif_suplier').html('<div class="callout callout-warning">Suplier Di Tambahkan</div> <a href="" class="reset_p btn btn-info">Reset Pencarian</a>');
            $('.cari_db').hide(); 
            $('#supliermodal').modal('hide');
          },
         error:function(data){
          console.log(data);
         }    
             
         });  
        })
    });
  });
/*fungsi untuk hapus barang pada sebelumnya di order*/ 
 
$(function(){
 var csj='<?= $id ?>';
 $('.data_barang_edit').load('<?= base_url('admin/load_purchase/?id=') ?>'+csj);
});


function hapus_barang_sb(id,e){
  var csj='<?= $id ?>';
   $.ajax({
         url:'<?= base_url('admin/delete_data_pc') ?>',
         type:"POST",
         data:"id="+id,
         chace: false,
        success:function(data){
          $('.data_barang_edit').load('<?= base_url('admin/load_purchase/?id=') ?>'+csj);
          $('.notifikasi_barang').html(data);
         }, 
        error:function(data){
          console.log(data);
        }

   });  
  e.PreventDefault();
}
</script>
<?= $this->session->flashdata('pesan'); ?>

<?php if($aksi == 'edit'): ?>
<div class="callout callout-info">Informasi Produk Yang Di Pesan Sebelumnya .</div>

<!-- menampilkan data barang yang pernah di belim sebelumnya... -->
<div class="notifikasi_barang"></div>
 <div class="data_barang_edit"></div>    
<!-- end sistem -->
<?php else: endif; ?>


<form action="" method="POST">
<table class="table table-striped"><tr><td>
<div id="notif"></div>
<div class="tmp_barang"></div>
<br />
<div id="load_barang"></div>
 </td>
</tr>
</table>
 <tt><div class="callout callout-warning"><i class="fa fa-exclamation-circle"></i><small>** ) Jika Ada Data Barang Baru Silahkan Tambah kan Data Barang Tersebut Pada Modul Data Master >> Data Barang Atau Pada link Berikut <a href="<?= base_url('admin/data_barang') ?>" target="_blank" class="btn btn-info">Data Master Barang </a></small></div></tt>
<hr />
<table class="table table-responsive">
 <tr><th>Kode Purchase</th><td colspan="4"><input type='text' name='kode_purchase' placeholder="Kode Purchase Order Barang ..." class='form-control' value='<?= $kode_purchase ?>' required=""></td></tr>
<tr><th>Nama Suplier</th><td><input type="text" name="suplier" id="nama_suplier" class="form-control" value="<?= $nama_suplier ?>" required=""></td><td>Cari Di Database <td><input type="text" class="cari_db form-control" placeholder="Cari Data Suplier Di Data Base">
<div class="notif_suplier"></div>
</td></td></tr>
<tr><th>Alamat Suplier</th><td><input type='text' name='alamat_sup' id="alamat_suplier" class='form-control' value='<?= $alamat_sup ?>' required=""></td></tr>
<tr><td>Keterangan Purchase <br /><small>** Catatan Purchase</small></td><td colspan='3'><textarea cols='20' row='20' name='detail' class='form-control' style='height:200px'><?= $detail ?></textarea></td></tr>

 <tr><td><button type="submit" name="kirim" class="btn btn-info"><i class="fa fa-save"></i> Simpan Data</button>
         <button type="reset"  class="btn btn-danger"><i class="fa fa-save"></i> Batal </button></td></tr>
 </table> 
</form>
  
<?php endif; ?>	

 