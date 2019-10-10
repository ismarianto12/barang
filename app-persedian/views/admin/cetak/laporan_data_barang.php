<?php
 error_reporting(0);
 ob_start();
?>

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
<h4>Data Laporan Stok Barang Dari <?= tgl_indonesia($dari) ?> Sampai Dengan <?= tgl_indonesia($sampai) ?></h4> 
 <hr />
  <table class="table">
    <thead>
	<tr>
		<th>No.</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Stok</th>
		<th>Satuan</th>
		<th>Kategori Barang</th>
	    <th>Lokasi</th>
	    
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
      <td><?= $data['nama_kategori'] ?></td>
      <td><?= $data['nama_lokasi'] ?></td>
      
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
$html2pdf->Output('Laporan Data Barang.pdf');
?>
