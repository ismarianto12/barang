 <?php
 $gos=isset($_GET['gos']) ? $_GET['gos'] :''; 
  if($gos == "Berhasil"){
   echo '<div class="callout callout-info">Selamat Datang Di Halaman Administrator</div>';
   
  }else{

  }


  ?>
  <div class="row">

  <div class="callout callout-warning">
    Aplikasi persedian barang gudang di gunakan untuk pencatatan barang tersedia pada gudang perusahaan atau distributor , 
    mencatat laporan dan kegiatan transaksi pembelian barang masuk dan barang keluar serta barang yang akan di pesan perusahaan atau distributor

  </div>


 	<br /><br />
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $data_barang->num_rows() ?></h3>
              <p>Data Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?= base_url('admin/data_barang') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $barang_masuk->num_rows() ?></h3>
              <p>Data Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?= base_url('admin/penerimaan_barang') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $laporan_stok_barang->num_rows() ?></h3>
              <p>Laporan Stok Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="<?= base_url('admin/laporan_stok_barang') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $laporan_barang_masuk->num_rows() ?></h3>
              <p>Laporan Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-clone"></i>
            </div>
            <a href="<?= base_url('admin/laporan_barang_masuk') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          </div>
        <!-- ./col -->
<hr />
 
     
<div class="col-md-6">
        <div class="callout callout-success"><i class="fa fa-arrow-circle-right"></i>Informasi Server</div>
       <?php 
       $id=$this->session->userdata('id_admin');
       $admin=$this->db->get_where('rn_admin',array('id_admin'=>$id)); ?>
       <table class="table">
         <tr><td>IP addres</td><td><?= $_SERVER['REMOTE_ADDR'] ?></td></tr>        
         <tr><td>BROWSER YANG SEDANG DI PAKAI</td><td><?= $_SERVER['HTTP_USER_AGENT'] ?></td></tr>        
         <tr><td>OS </td><td><?= $_SERVER['WINDIR'] ?></td></tr>        
         <tr><td>SERVER AKTIF</td><td><?= $_SERVER['SERVER_SIGNATURE'] ?></td></tr>        
               
       </table>
      </div>

      
 <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border  callout callout-danger">
              <h3 class="box-title"><i class="fa fa-arrow-circle-right"></i>Detail Informasi Perusahaan</h3>
            </div>
            <div class="box-body">
           <table class="table table-bordered table-striped">
    <thead>
  <tr>
    
    <th>Informasi Perusahaan </th>
     
  </tr>
  </thead>
<tbody>
  <?php 
  $data=$this->db->get('rn_setting');
  $no=1; foreach($data->result() as $data): ?>
 <tr>
   
    <td><?= $data->nilai ?></td>
     
 </tr>
   <?php $no++; endforeach; ?>
</tbody>

</table>       
   

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        

        </div>

      