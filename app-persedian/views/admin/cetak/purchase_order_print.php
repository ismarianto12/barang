<div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <tt><i class="fa fa-info"></i> Catatan :
          <?= $data->row()->detail ?> 
        </tt>.
      </div>
    </div>

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i><?= cari('nama_perusahaan') ?>.
            <small class="pull-right">Tercetak Tanggal : <?= date('Y-m-d') ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari 
          <address>
            <strong><?= cari('nama_perusahaan') ?></strong><br>
            <?= cari('jalan') ?><br>  
            Phone: <?= cari('no_telp') ?><br>
            Email: <?= cari('email') ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Tujuan
          <address>
            <strong><?= $data->row()->suplier  ?></strong><br>
            <?= $data->row()->alamat_sup ?><br>
           </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Purchase Order No .<?= $data->row()->kode_purchase ?></b><br>
          <br>
        </div>
       </div>
      <!-- /.row -->

      <!-- Table of content item -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-responsive">
              <thead>
              <tr>
              <th>No.</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Jumlah Pesanan Barang</th>
              <th>Harga Per Unit</th>
              <th>Sub Total</th>
              </tr>
              </thead>
              <tbody>
          <?php
           $tot_har='';
           $no=1; foreach($sql_barang->result_array() as $barang):
           $jumlah =$this->madmin->hitung_data($barang['kode_purchase'])->row_array(); 
           $subtotal=(int)$barang['jumlah'] * (int)$barang['harga_beli'];
           $tot_har += (int)$subtotal;
           $jum_barang = $jumlah['total_barang'];
           ?>
              <tr>
              <td><?= $no ?></td>
              <td><?= $barang['kode_barang'] ?></td>
              <td><?= $barang['nama_barang'] ?></td>
              <td><?= $barang['satuan'] ?></td>
              <td><?= $barang['jumlah'] ?> / <?= $barang['satuan'] ?></td>
              <td>Rp.<?= number_format((int)$barang['harga_beli'],0,',',','); ?></td>
              <td>Rp .<?= number_format((int)$subtotal,0,',',','); ?></td>
              </tr>
          <?php $no++; endforeach ?> 
              </tbody>
              </table>
           </div>
        </div>
       <div class="row">
         <div class="col-xs-6">
           <div class="table-responsive">
            <table class="table">
              <tbody><tr>
               <th style="width:50%">Total Item Barang Di Pesan:</th>
                <td><?= $jum_barang ?>/<?= $barang['satuan'] ?></td></tr>
                <tr>
                <th style="width:50%">Total Biaya:</th>
                <td>Rp. <?= number_format((int)$tot_har,0,',',',') ?></td></tr>
                <tr>
                <th>Operator :</th>
                <td><?= $this->session->userdata('nama') ?></td>
              </tr>
            </tbody></table>
          </div>
        </div>  
      </div>   
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?= base_url('admin/purchase_order/det_print/'.$barang['kode_purchase']) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
         </div>
      </div>
    </section>