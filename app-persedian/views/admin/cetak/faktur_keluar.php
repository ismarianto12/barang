<?php   
// ob_start();
?>
 
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
    text-align: center;
    border-collapse: collapse;
    margin: 30px 100px 10px; 
}

.table th {
	background: #ddd;
	text-align: center;
}    
/*bagiam tabel satu*/


.table1 {
    margin-left:60px;

}
.table1 th,.table1 td{
     padding: 10px 10px 10px;
     border-bottom: 1px solid #ddd; 

}
.table1 tr{
     border-bottom: 1px solid #ddd; 
}

</style>

<div class="header"><?= strtoupper($this->madmin->identitas_('nama_perusahaan')); ?></div> 
 
<?= strtoupper($this->madmin->identitas_('jalan')); ?> 
 <br />
 No . Telp <?= cari("no_telp") ?> ,Email : <?= cari('email') ?>
<h3>DETAIL FAKTUR KELUAR </h3>
<hr /> 
 
<table class="table1">
  <tr>
    <th><div align="left">Kode Transaksi </div></th>
    <td>:</td>
    <td><?= $sql->row()->kode_transaksi ?></td>
  </tr>
  <tr>
    <th><div align="left">Tanggal </div></th>
    <td>:</td>
    <td><?= $sql->row()->tanggal_keluar ?></td>
  </tr>
  <tr>
    <th><div align="left">Nama Penerima </div></th>
    <td>:</td>
    <td><?= $sql->row()->penerima ?></td>
  </tr>

  <tr>
    <th><div align="left">Alamat</div></th>
    <td>:</td>
    <td><?= $sql->row()->alamat_penerima ?></td>
  </tr>
  <tr>
    <th><div align="left">Jumlah Barang </div></th>
    <td>:</td>
    <td><?= $sql->row()->jumlah_keluar ?> / <?= $sql->row()->satuan ?></td>
  </tr>
  <tr>
    <th scope="row"><div align="left">Data Barang </div></th>
    <td>:</td>
    </tr>
  <tr>
    <th colspan="2" scope="row"><div align="left"></div> </th>
  </tr>
</table>
<br />
<table class="table">
        <tr>
          <th scope="row">NO </th>
          <td>Kode Barang </td>
          <td>Nama</td>
          <td>Satuan</td> 
        </tr>
        <tr>
 <?php $j=0; $cek_barang=$this->db->get_where('rn_barang',array('id_barang'=>$sql->row()->id_barang))->row_array(); ?>
      <td><?= ++$j ?></td>
      <td><?= $cek_barang['kode_barang'] ?></td>
      <td><?= $cek_barang['nama_barang'] ?></td>    
      <td><?= $cek_barang['satuan'] ?></td> 
    </tr>
      </table>
 

 <?php
require_once(APPPATH.'/third_party/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Detail Faktur Keluar.pdf');
?>
