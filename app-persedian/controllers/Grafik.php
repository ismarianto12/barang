<?php 
 class Grafik extends CI_Controller
 {
 
  function __construct()
  {
    parent::__construct();
    // limit(08-12);
    // error_reporting(0);
     if ($this->session->userdata('admin') != TRUE) {
      $this->db->close();
      redirect(base_url('/'));
      exit();
    }elseif($this->config->item('copy') == ""){
      show_error('Anda Telah Melanggar Hak Cipta', 400);
      exit();
    }
  }
  
 function penerimaan_barang(){
   $x['data']=$this->madmin->grafik_barang();
   $x['judul'] = "Grafik Penerimaan Baarang";
   admin_tpl('admin/g_penerimaan_barang',$x);
 }

 function barang_keluar(){
  $x['data']=$this->madmin->grafik_barang_keluar();
  $x['judul'] ="Grafik Barang Keluar";
  admin_tpl('admin/g_barang_keluar',$x);

 }

  /*end class*/

  }