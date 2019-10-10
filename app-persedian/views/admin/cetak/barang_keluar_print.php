<!DOCTYPE html>
<html>
<head>
  <title>Laporan Data Barang</title>
</head>


 <style type="text/css">
 
 body{
  width: 100%;
  text-align: center;
 }
 .header{
    font-size: 17px;
    color: #000;
    font-weight: bold;
 }


.table td, .table th {    
    border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    padding: 5px 10px 10px;
    
}

.table {
    border-collapse: collapse;
    width: 100%;
    margin: 30px 100px 10px; 
}

.table th {
  background: #ddd;
  text-align: center;
}    
 
</style>

<body>

<div class="header"><?= strtoupper($this->madmin->identitas_('nama_perusahaan')); ?></div> 
 
<?= strtoupper($this->madmin->identitas_('jalan')); ?> 
 <br />
 No . Telp <?= cari("no_telp") ?> ,Email : <?= cari('email') ?>

<br /><br /><br />
Data Laporan Barang Dari <?= tgl_indonesia($dari) ?> Sampai Dengan <?= tgl_indonesia($sampai) ?> 
 <hr />
 


 <table class="table">
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

    </body>
</html>                    
               
 <?php
require_once(APPPATH.'/third_party/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Laporan Data Barang Keluar.pdf');
?>
