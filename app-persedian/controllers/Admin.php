<?php 

/**
* @author  : Ismarianto Putra 
* @Created : At  7-31-2018
* @copyright :Ismarianto Putra
*/
class Admin extends CI_controller
{

  function __construct()
  {
    parent::__construct();
 
    if ($this->session->userdata('admin') != TRUE) {
     $this->db->close();
     redirect(base_url('/'));
     exit();
   }elseif($this->config->item('copy') == ""){
    show_error('Anda Telah Melanggar Hak Cipta', 400);
    exit();
  }
}

public function index()
{
 $id=$this->session->userdata('id_admin'); 
 $x=array('judul' => 'Selamat Datang Di Halaman Administrator',
  'data_barang'=>$this->madmin->data_barang(),
  'barang_masuk'=>$this->madmin->penerimaan_barang(),
  'laporan_stok_barang'=>$this->madmin->data_barang(),
  'berita_barang_masuk'=>$this->madmin->data_barang_home(),
  'laporan_barang_masuk'=>$this->madmin->penerimaan_barang(),
  'admin'=>$this->db->get_Where('rn_admin',array('id_admin'=>$id)));
 admin_tpl('admin/home',$x);

}

public function data_barang($action='',$id=''){
/*data barang*/
 cek_session('admin');
  $this->form_validation->set_rules('kode_barang','Kode Barang','required|is_unique[rn_barang.kode_barang]');
  $this->form_validation->set_rules('nama_barang','Nama Barang','required');
  $this->form_validation->set_rules('harga_beli','Harga Beli','required');
  $this->form_validation->set_rules('harga_jual','Harg Jual','required');
  $this->form_validation->set_rules('id_suplier','Suplier Barang','required');

  if ($action == "add") {
    cek_session('admin');
    if (isset($_POST['kirim'])) {
       if($this->form_validation->run() == FALSE){
         $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-info">','</div>'));
        redirect(base_url('admin/data_barang/add'));

      }else{
        $harga_beli=str_replace(",", "",$this->input->post('harga_beli'));
        $harga_jual=str_replace(",", "",$this->input->post('harga_jual'));


        $data=array(
         'kode_barang'=>$this->input->post('kode_barang'),
         'nama_barang'=>$this->input->post('nama_barang'),
         'harga_beli'=>$harga_beli,
         'harga_jual'=>$harga_jual,
         'stok'=>$this->input->post('stok_barang'),
         'satuan'=>$this->input->post('satuan_barang'),
         'id_lokasi'=>$this->input->post('id_lokasi'),
         'id_kategori'=>$this->input->post('id_kategori'),
         'id_suplier'=>$this->input->post('id_suplier'),
         'tanggal_barang'=>date('Y-m-d'),
         'id_admin' =>$this->session->userdata('id_admin'));
      }
      $cek=$this->db->insert('rn_barang',$data);
      if ($cek) { 
        $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Barang Berhasil Di Tambah Kan.</div>');
        redirect(base_url('admin/data_barang'));
      }else{
        $this->session->set_flashdata('pesan','<div class="callout callout-danger">terjadi error Sql</div>');
        redirect(base_url('admin/data_barang'));
      } 


    }else{
      $x['kode_barang'] ='';
      $x['nama_barang']='';
      $x['harga_beli']='';
      $x['harga_jual']='';
      $x['stok']='';
      $x['satuan']='';
      $x['id_lokasi']='';
      $x['id_kategori']='';
      $x['id_suplier']='';
      $x['tanggal_barang']='';
      $x['id_admin']='';
      $x['form'] = TRUE;
      $x['judul'] ="Tambah Data Barang";
      $x['barang']=$this->madmin->data_barang();
      admin_tpl('admin/data_barang',$x);
    }
  }elseif($action == "edit"){
   if (empty($id)) {
     $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Error Sql Detect</div>');
     redirect(base_url('admin/data_barang'));   

   };

   if (isset($_POST['kirim'])) {

    if($this->form_validation->run() == FALSE){

      $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
      redirect(base_url('admin/data_barang/edit/'.$id));

    }else{

      $data=array(
       'kode_barang'=>$this->input->post('kode_barang'),
       'nama_barang'=>$this->input->post('nama_barang'),
       'harga_beli'=>$this->input->post('harga_beli'),
       'harga_jual'=>$this->input->post('harga_jual'),
       'stok'=>$this->input->post('stok_barang'),
       'satuan'=>$this->input->post('satuan_barang'),
       'id_lokasi'=>$this->input->post('id_lokasi'),
       'id_kategori'=>$this->input->post('id_kategori'),
       'id_suplier'=>$this->input->post('id_suplier'),
       'tanggal_barang'=>date('Y-m-d'),
       'id_admin' =>$this->session->userdata('id_admin'));
    }
    $cek= $this->db->update('rn_barang',$data,array('id_barang'=>$id));
    if ($cek) { 
      $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Barang Berhasil Di Edit.</div>');
      redirect(base_url('admin/data_barang'));
    }else{
      $this->session->set_flashdata('pesan','<div class="callout callout-danger">terjadi error Sql</div>');
      redirect(base_url('admin/data_barang'));
    } 
  }else{

    $data1=$this->db->get_where('rn_barang',array('id_barang'=>$id));
    $x['kode_barang'] =$data1->row()->kode_barang;
    $x['nama_barang']=$data1->row()->nama_barang;
    $x['harga_beli']=$data1->row()->harga_beli;
    $x['harga_jual']=$data1->row()->harga_jual;
    $x['stok']=$data1->row()->stok;
    $x['satuan']=$data1->row()->satuan;
    $x['id_lokasi']='';
    $x['id_kategori']='';
    $x['id_suplier']='';
    $x['tanggal_barang']=$data1->row()->tanggal_barang;
    $x['id_admin']='';
    $x['form']= TRUE;
    $x['judul'] ="Edit Data Barang";
    admin_tpl('admin/data_barang',$x);
  }
}elseif($action == "delete"){
 $this->db->delete('rn_barang',array('id_barang'=>$id));

}else{
  $x['form'] =FALSE;
  $x['judul'] ="Data Barang";
  $x['data_barang'] =$this->madmin->data_barang();
  admin_tpl('admin/data_barang',$x);
}

}

public function data_suplier($action='',$id=''){

  $this->form_validation->set_rules('nama_suplier','Nama Suplier','required');
  $this->form_validation->set_rules('alamat_suplier','Alamat Suplier','required');
  $this->form_validation->set_rules('no_hp','No handphone','required');

  if ($action == "add") {
   if (isset($_POST['kirim'])) {
    if ($this->form_validation->run() == TRUE) {
      $sql=array(
       'nama_suplier'=>$this->input->post('nama_suplier'),
       'alamat_suplier'=>$this->input->post('alamat_suplier'),
       'no_hp'=>$this->input->post('no_hp'),
       'no_rek'=>$this->input->post('no_rek'));
      $cek=$this->db->insert('rn_suplier',$sql);
      if ($cek) {
       $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan</div>');
       redirect(base_url('admin/data_suplier'));
     }else{
     }

   }else{
     $this->sessio->set_flashdata('pesan',form_validation('<div class="callout callout-danger">','</div>')); 
     redirect(base_url('admin/data_suplier/add'));
   }
 }else{
  $x['nama_suplier']=""; 
  $x['alamat_suplier']=""; 
  $x['no_hp']=""; 
  $x['no_rek']="";
  $x['form'] =TRUE;
  $x['judul'] ="Data Suplier Barang";
  admin_tpl('admin/data_suplier',$x);

}

}elseif($action == "edit"){
  if (empty($id)) {
    redirect(base_url('admin/data_suplier'));
  }

  if (isset($_POST['kirim'])) {

    if ($this->form_validation->run() == TRUE) {
      $sql=array(
       'nama_suplier'=>$this->input->post('nama_suplier'),
       'alamat_suplier'=>$this->input->post('alamat_suplier'),
       'no_hp'=>$this->input->post('no_hp'),
       'no_rek'=>$this->input->post('no_rek'));

      $cek=$this->db->update('rn_suplier',$sql,array('id_suplier'=>$id));
      if ($cek) {
       $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan</div>');
       redirect(base_url('admin/data_suplier'));
     }else{
     }

   }else{

     $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>')); 
     redirect(base_url('admin/data_suplier/edit/'.$id));
   }
 }else{
  $data=$this->db->get('rn_suplier',array('id_suplier'=>$id));
  $x['nama_suplier']=$data->row()->nama_suplier; 
  $x['alamat_suplier']=$data->row()->alamat_suplier; 
  $x['no_hp']=$data->row()->no_hp; 
  $x['no_rek']=$data->row()->no_rek;
  $x['form'] =TRUE;
  $x['judul'] ="Edit Suplier Barang";
  admin_tpl('admin/data_suplier',$x);
}

}elseif($action == "delete"){
  $this->db->delete('rn_suplier',array('id_suplier'=>$id));
  $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Berhasil Di Hapus.</div>');
  redirect(base_url('admin/data_suplier'));

}else{

  $x['suplier']=$this->madmin->data_suplier();
  $x['judul'] ="Data Suplier";
  $x['form'] =FALSE;
  admin_tpl('admin/data_suplier',$x); 
}

}
public function data_klien($action='',$id=''){
  if ($action == "add") { 

    if (isset($_POST['kirim'])) {
      $sql=array(
        'nama_client'=>$this->input->post('nama_client'),
        'perusahaan'=>$this->input->post('perusahaan'),
        'divisi'=>$this->input->post('divisi'),
        'no_telp'=>$this->input->post('no_telp'),
        'alamat'=>$this->input->post('alamat'),
        'tanggal_client'=>date('Y-m-d'),);

      $cek=$this->db->insert('rn_client',$sql);
      if ($cek) {
        $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan</div>');
        redirect(base_url('admin/data_klien'));
      }else{
        buat_alert('sqL error');
      }

    }else{
     $x['nama_client'] =""; 
     $x['perusahaan'] ="";
     $x['divisi'] ="";
     $x['no_telp'] ="";
     $x['alamat']="";
     $x['judul'] ="Tambah Data Klien";
     $x['form']  =TRUE;
     admin_tpl('admin/data_klien',$x);
   }

 }elseif($action == "edit"){

  if (empty($id)) {
   redirect(base_url('404'));
 }
 if (isset($_POST['kirim'])) {

  $sql=array(
    'nama_client'=>strip_tags($this->input->post('nama_client')),
    'perusahaan'=>strip_tags($this->input->post('perusahaan')),
    'divisi'=>strip_tags($this->input->post('divisi')),
    'no_telp'=>strip_tags($this->input->post('no_telp')),
    'alamat'=>strip_tags($this->input->post('alamat')),
    'tanggal_client'=>date('Y-m-d'),);

  $cek=$this->db->update('rn_client',$sql,array('id_client'=>$id));
  if ($cek) {
    $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Edit</div>');
    redirect(base_url('admin/data_klien'));

  }else{
    buat_alert('sqL error');
  }

}else{
  $data=$this->db->get_where('rn_client',array('id_client'=>$id));
  $x['nama_client'] =$data->row()->nama_client; 
  $x['perusahaan'] =$data->row()->perusahaan;
  $x['divisi'] =$data->row()->divisi;
  $x['no_telp'] =$data->row()->no_telp;
  $x['alamat']=$data->row()->alamat;
  $x['judul'] ="Edit Data Klien";
  $x['form']  =TRUE;
  admin_tpl('admin/data_klien',$x);
}

}elseif($action == "delete"){
  if (empty($id)) {
   redirect(base_url('404'));
 }
 $this->db->delete('rn_client',array('id_client'=>$id));
 $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Berhasil Di Haupus</div>');

 redirect(base_url('admin/data_klien'));

}else{
 $x['judul'] ="Data Klien";
 $x['form']  =FALSE;
 $x['sql']=$this->madmin->data_klien(); 
 admin_tpl('admin/data_klien',$x);
}

}


public function data_kelompok($action='',$id=''){
  if ($action == "add") {
    $this->form_validation->set_rules('nama_kategori','Nama Kategori','required|is_unique[rn_kategori.nama_kategori]');
    if (isset($_POST['kirim'])) {
     if ($this->form_validation->run() == FALSE) {
       $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-info">','</div>'));
       redirect(base_url('admin/data_kelompok'));
     }else{
       $sql=array(
         'nama_kategori'=>$this->input->post('nama_kategori'),
         'tanggal_kategori'=>date("Y-m-d"),);
       $cek=$this->db->insert('rn_kategori',$sql);
       if($cek){
        $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambah</div>');
        redirect(base_url('admin/data_kelompok'));
      }else{
        buat_alert('sql GAGAL');
      }
    }
  }else{
   $x = array('judul' =>'Data Kategori' ,
    'nama_kategori'=>'',
    'tanggal_kategori'=>'',
    'form'=>TRUE);

   admin_tpl('admin/kategori',$x);
 }
}elseif($action == "edit"){
  cek_table('kategori','id_kategori',$id);
  if (isset($_POST['kirim'])) {
   $sql=array(
     'nama_kategori'=>$this->input->post('nama_kategori'),
     'tanggal_kategori'=>date("Y-m-d"),);
   $cek=$this->db->update('rn_kategori',$sql,array('id_kategori'=>$id));
   if($cek){
    $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambah</div>');
    redirect(base_url('admin/data_kelompok'));
  }else{
    buat_alert('sql GAGAL');
  }
}else{
 $data=$this->db->get_where('rn_kategori',array('id_kategori'=>$id));
 $x = array('judul' =>'Data Kategori' ,
  'nama_kategori'=>$data->row()->nama_kategori,
  'tanggal_kategori'=>$data->row()->tanggal_kategori,
  'form'=>TRUE);
 admin_tpl('admin/kategori',$x);
}
}elseif($action == "delete"){
  $this->db->delete('rn_kategori',array('id_kategori'=>$id));
  $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Berhasil Di Hapus</div>');

  redirect(base_url('admin/data_kelompok'));
}else{

  $x = array('judul' =>'Data Kelompok Barang',
    'form' =>FALSE,
    'data'=>$this->madmin->datta_kelompok());
  admin_tpl('admin/kategori',$x);
}


}
public function lokasi_barang($action='',$id=''){

 if ($action == "add") {
   if (isset($_POST['kirim'])) {
    $sql=array(       
     'nama_lokasi'=>$this->input->post('nama_lokasi'),
     'gedung_utama'=>$this->input->post('gedung_utama'),
     'tanggal_lokasi'=>date("Y-m-d"),);
    $cek=$this->db->insert('rn_lokasi',$sql);
    if ($cek) {
      $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan</div>');
      redirect(base_url('admin/lokasi_barang'));
    }else{
     alert('SQl Error');
   }
 }else{
  $data = array('judul' =>'Lokasi Barang',
    'nama_lokasi'=>'',
    'gedung_utama'=>'',
    'tanggal_lokasi'=>'',
    'form'=>TRUE,);
  admin_tpl('admin/lokasi_barang',$data);
}

}elseif($action == "edit"){

  if (isset($_POST['kirim'])) {
    $sql=array(       
     'nama_lokasi'=>$this->input->post('nama_lokasi'),
     'gedung_utama'=>$this->input->post('gedung_utama'),
     'tanggal_lokasi'=>date("Y-m-d"),);
    $cek=$this->db->update('rn_lokasi',$sql,array('id_lokasi'=>$id));
    if ($cek) {
      $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambahkan</div>');
      redirect(base_url('admin/lokasi_barang'));
    }else{
     alert('SQl Error');
   }
 }else{
  $lokasi=$this->db->get_where('rn_lokasi',array('id_lokasi'=>$id));
  $data = array('judul' =>'Lokasi Barang',
    'nama_lokasi'=>$lokasi->row()->nama_lokasi,
    'gedung_utama'=>$lokasi->row()->gedung_utama,
    'tanggal_lokasi'=>$lokasi->row()->tanggal_lokasi,
    'form'=>TRUE,);
  admin_tpl('admin/lokasi_barang',$data);
}
}elseif($action == "delete"){
 $cek=$this->db->delete('rn_lokasi',array('id_lokasi'=>$id));
 if($cek){
  $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Berhasil Di Hapus.</div>');
  redirect(base_url('admin/lokasi_barang'));
}else{
}
}else{
  $x['data'] =$this->madmin->lokasi_barang();
  $x['judul'] ="Data Lokasi";
  $x['form']  =FALSE;
  admin_tpl('admin/lokasi_barang',$x);
}

}
public function purchase_order($action='',$id=''){

 if ($id) {
  cek_table('rn_purchase','kode_purchase',$id);
  $x['id']=$id;
  $data=$this->db->get_where('rn_purchase',array('kode_purchase'=>$id));    
  $x['kode_purchase']=$data->row()->kode_purchase;
  $x['suplier']=$data->row()->suplier;
  $x['alamat_sup']=$data->row()->alamat_sup;
  $x['barang_edit']=$this->madmin->get_barang_p($id);
  $x['id_barang']=$data->row()->id_barang;
  $x['tanggal_purchase']=$data->row()->tanggal_purchase;
  $x['detail']=$data->row()->detail;
  $x['jumlah']=$data->row()->jumlah;
  $x['aksi']="edit";
  $x['nama_suplier']=$data->row()->suplier;
  $x['suplier']=$this->madmin->data_suplier();
}else{
  $x['id']="";
  $x['kode_purchase']='';
  $x['suplier']="";
  $x['alamat_sup']="";
  $x['id_barang']="";
  $x['tanggal_purchase']="";
  $x['detail']="";
  $x['jumlah']="";
  $x['aksi']="add";
  $x['nama_suplier']="";
  $x['suplier']=$this->madmin->data_suplier();
}

if ($action == "add") {

 if (isset($_POST['kirim'])) {
   $this->form_validation->set_rules('id_barang','Silahkan Pilih Barang','required');
   $this->form_validation->set_rules('kode_purchase','Kode Purchase','required|is_unique[rn_purchase.kode_purchase]');

   if ($this->form_validation->run() == TRUE) {
    $tmp_purchasee=$this->db->get('tmp_purchase');
    foreach($tmp_purchasee->result_array() as $data){
      $sql=array(
        'kode_purchase'=>$this->input->post('kode_purchase'),
        'suplier'=>$this->input->post('suplier'),
        'alamat_sup'=>$this->input->post('alamat_sup'),
        'id_barang'=>$data['id_barang'],
        'tanggal_purchase'=>date('Y-m-d'),
        'detail'=>$this->input->post('detail'),
        'jumlah'=>$this->input->post('jumlah'));
      $cek=$this->db->insert('rn_purchase',$sql);
   }
  if($cek){
      $this->madmin->hapus_purchase(); 
      $this->session->set_flashdata('pesan','<div class="callout callout-success">Data Purchase Berhasil Ditambahkan .</div>');
      redirect(base_url('admin/purchase_order'));
    }else{
      $this->madmin->hapus_purchase(); 
      echo "SQL ERROR";
    }
  }else{
    $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-success">','</div>'));
    redirect(base_url('admin/purchase_order/add'));
  }

}else{
  $x['judul']="Tambah Data Purchase Order";
  $x['form']= TRUE;
  admin_tpl('admin/purchase_order',$x);
}

}elseif($action == "edit"){

 if (isset($_POST['kirim'])) {
 

    $tmp_purchasee=$this->db->get('tmp_purchase');
    if ($tmp_purchasee->num_rows() > 0 ) {
     
    foreach($tmp_purchasee->result_array() as $data){
      $sql=array(
        'kode_purchase'=>$this->input->post('kode_purchase'),
        'suplier'=>$this->input->post('suplier'),
        'alamat_sup'=>$this->input->post('alamat_suplier'),
        'id_barang'=>$data['id_barang'],
        'tanggal_purchase'=>date('Y-m-d'),
        'detail'=>$this->input->post('detail'),
        'jumlah'=>$data['jumlah'],);

      $cek=$this->db->update('rn_purchase',$sql,array('kode_purchase'=>$id));
      $this->db->delete('tmp_purchase',array('id_barang'=>$data['id_barang']));
    }
    $this->session->set_flashdata('pesan','<div class="callout callout-success">Data Purchase Berhasil Edit .</div>');
    redirect(base_url('admin/purchase_order'));
}else{
   $sql=array(
        'kode_purchase'=>$this->input->post('kode_purchase'),
        'suplier'=>$this->input->post('suplier'),
        'alamat_sup'=>$this->input->post('alamat_sup'),
        'detail'=>$this->input->post('detail'),);
      $cek=$this->db->update('rn_purchase',$sql,array('kode_purchase'=>$id));
      
      $this->session->set_flashdata('pesan','<div class="callout callout-success">Data Purchase Berhasil Edit .</div>');
      redirect(base_url('admin/purchase_order'));
}
 

}else{

  $x['judul'] ="Edit Data Purchase Order";
  $x['form']= TRUE;
  admin_tpl('admin/purchase_order',$x);
}

}elseif($action == "delete"){
  if(empty($id)){
    redirect('404');
  }
  $cek=$this->db->delete('rn_purchase',array('id_purchase'=>$id));
  if($cek){
    $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Berhasil Di Hapus.</div>');
    redirect(base_url('admin/purchase_order'));
  }else{
  }

}elseif($action == 'print'){
  cek_table('rn_purchase','kode_purchase',$id);
  $x['data']=$this->madmin->get_print_purchase($id);
  $x['sql_barang']=$this->madmin->get_barang_p($id);
  
  $x['print']="n";
  $x['judul']="Detail Purchase ";
  admin_tpl('admin/cetak/purchase_order_print',$x);
}elseif($action == 'det_print'){
  
  cek_table('rn_purchase','kode_purchase',$id);
  $x['data']=$this->madmin->get_print_purchase($id);
  $x['sql_barang']=$this->madmin->get_barang_p($id);
  $x['print']="n";
  $x['judul']="Detail Purchase ";
  $this->load->view('admin/cetak/purchase_pdf',$x);


}else{
  $x['sql'] =$this->madmin->purchase_order();
  $x['form'] =FALSE;
  $x['judul'] ="Purchase Order";
  admin_tpl('admin/purchase_order',$x);
}
}

/*bgaian purchase order ajaxx*/


function delete_data_pc(){
  $id=$this->input->post('id');
  $data=$this->db->get_where('rn_purchase',array('id_barang'=>$id));
  if ($data->num_rows() == 0 ) {
    echo "<div class='callout callout-info'>Tidak Dapat Menghapus Data Kurang Dari 0 Silahkan Edit Dan Ubah Data pertama</div>";
  }else{
  $this->db->delete('rn_purchase',array('id_barang'=>$id));
   echo "<div class='callout callout-success'>Barang Berhasil Di Hapus </div>";
  }
}
function load_purchase(){
  $id=$_GET['id'];
  $x['data']=$this->madmin->get_barang_p($id);
  $this->load->view('admin/purchase_order_list',$x);

}


/*end bagian purchase order */


 
public function barang_keluar($action='',$id=''){

 if ($action == "add") {
   if (isset($_POST['kirim'])) {
    $this->form_validation->set_rules('id_barang','Data Barang','required');
    $this->form_validation->set_rules('kode_transaksi','Kode Transaksi','required');
    $this->form_validation->set_rules('jumlah_keluar','Jumlah Barang','required|is_numeric');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
      redirect(base_url('admin/barang_keluar/add'));
    }else{ 
      $jumlah=$this->input->post('jumlah_keluar');
      $id_barang=$this->input->post('id_barang');
      $this->madmin->update_barang($jumlah,$id_barang);
      $sql=array(
       'kode_transaksi'=>$this->input->post('kode_transaksi'), 
       'id_barang'=>$this->input->post('id_barang'),  
       'jumlah_keluar'=>$this->input->post('jumlah_keluar'),  
       'penerima'=>$this->input->post('penerima'),  
       'id_admin'=>$this->session->userdata('id_admin'),  
       'alamat_penerima'=>$this->input->post('alamat_penerima'),
       'tanggal_keluar'=>date("Y-m-d"),);

      $cek=$this->db->insert('rn_barang_keluar',$sql);
      if ($cek) {
        $this->session->set_flashdata('pesan','<div class="callout callout-success">Data Barang Keluar Berhasil Di Tambah</div>');
        redirect(base_url('admin/barang_keluar'));
      }else{

      }
    }

  }else{

    $sql=array(
     'kode_transaksi'=>"", 
     'id_barang'=>"",  
     'jumlah_keluar'=>"",  
     'penerima'=>"",  
     'data_barang'=>$this->madmin->data_barang(),
     'aksi'=>'add',
     'alamat_penerima'=>"",
     'id_admin'=>$this->session->userdata('id_admin'),
     'judul' =>'Data Barang Keluar',
     'form'=>TRUE,  
     'tanggal_keluar'=>"");
    admin_tpl('admin/barang_keluar',$sql);
  }

}elseif($action == "edit"){
 cek_table('rn_barang_keluar','id_barang_keluar',$id);
 if (isset($_POST['kirim'])) {

  $this->form_validation->set_rules('id_barang','Data Barang','required');
  $this->form_validation->set_rules('kode_transaksi','Kode Transaksi','required');


  if ($this->form_validation->run() == FALSE) {
    $this->session->set_flashdata('pesan',validation_errors('<br /><hr /><div class="callout callout-danger">','</div>'));
    redirect(base_url('admin/barang_keluar/edit/'.$id));
  }else{ 

    $sql=array(
     'kode_transaksi'=>$this->input->post('kode_transaksi'), 
     'id_barang'=>$this->input->post('id_barang'),  
     'penerima'=>$this->input->post('penerima'),  
     'id_admin'=>$this->session->userdata('id_admin'),  
     'tanggal_keluar'=>date("Y-m-d"),
     'alamat_penerima'=>$this->input->post('alamat_penerima'),);

    $cek=$this->db->update('rn_barang_keluar',$sql,array('id_barang_keluar'=>$id));
    if ($cek) {
      $this->session->set_flashdata('pesan','<div class="callout callout-warning">Data Barang Keluar Berhasil Di Edit</div>');
      redirect(base_url('admin/barang_keluar'));
    }else{

    }
  }

}else{
  $data=$this->db->get_where('rn_barang_keluar',array('id_barang_keluar'=>$id));
  $sql=array(
   'kode_transaksi'=>$data->row()->kode_transaksi, 
   'id_barang'=>"",  
   'data_barang'=>$this->madmin->data_barang(),
   'aksi'=>'edit',
   'jumlah_keluar'=>$data->row()->jumlah_keluar,  
   'penerima'=>$data->row()->penerima,  
   'alamat_penerima'=>$data->row()->alamat_penerima,
   'id_admin'=>$this->session->userdata('id_admin'),
   'judul' =>'Edit Barang Keluar',
   'form'=>TRUE,  
   'tanggal_keluar'=>"");
  admin_tpl('admin/barang_keluar',$sql);
}
}elseif($action == "delete"){

 $cek=$this->db->delete('rn_barang_keluar',array('id_barang_keluar'=>$id));
 if ($cek) {
  $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Barang Keluar Berhasil Di Hapus</div>');
  redirect(base_url('admin/barang_keluar'));
}else{
  buat_alert('sql Error');
}

}else{
  $x['sql'] =$this->madmin->barang_keluar();
  $x['judul']='Data Barang Keluar';
  $x['form'] =FALSE;
  admin_tpl('admin/barang_keluar',$x);

}

}

public function cari_id_barang()
{
 $id=$this->input->post('id');
 $sql=$this->db->get_where('rn_barang',array('id_barang'=>$id))->result_array();
 echo json_encode($sql);  
}
/*bagian laporan system*/

public function laporan_stok_barang($action='',$dari='',$sampai=''){
  if ($action == "cetak") {
    $x['dari']   = $dari;
    $x['sampai'] = $sampai;
    $x['data_barang'] =$this->madmin->laporan_stok_barang($dari,$sampai);
    $this->load->view('admin/cetak/laporan_data_barang',$x); 

  }else{
   if (isset($_POST['kirim'])) {
    $x['dari']=$this->input->post('dari');
    $x['sampai']=$this->input->post('sampai');
    $x['cari'] =FALSE;
    $x['judul'] ="Hasil Laporan Stok Barang";
    $x['data_barang'] =$this->madmin->laporan_stok_barang($x['dari'],$x['sampai']);
    admin_tpl('admin/laporan_data_barang',$x);

  }else{
    $x['cari'] =TRUE;
    $x['judul'] ="Laporan Stok Barang";
    admin_tpl('admin/laporan_data_barang',$x);
  }

}

}

public function laporan_barang_keluar($action='',$dari='',$sampai=''){
 if ($action == "cetak") {

  $x['dari']   = $dari;
  $x['sampai'] = $sampai;
  $x['sql'] =$this->madmin->laporan_barang_keluar($dari,$sampai);
  $this->load->view('admin/cetak/barang_keluar_print',$x); 

}else{
 if (isset($_POST['kirim'])) {
  $x['dari']=$this->input->post('dari');
  $x['sampai']=$this->input->post('sampai');
  $x['cari'] =FALSE;
  $x['judul'] ="Laporan Barang Keluar";
  $x['sql'] =$this->madmin->laporan_barang_keluar($x['dari'],$x['sampai']);
  admin_tpl('admin/laporan_barang_keluar',$x);

}else{
  $x['cari'] =TRUE;
  $x['judul'] ="Laporan Barang Keluar";
  admin_tpl('admin/laporan_barang_keluar',$x);
}
}

}
public function cetak_faktur_keluar($action='',$id=''){

  if ($action == "cetak") {
   if (empty($id)) {
    redirect(base_url('/404'));
  } 
  $x['sql']   =$this->madmin->cetak_faktur_keluar($id);
  $x['judul'] ="Data Faktur keluar";
  $this->load->view('admin/cetak/faktur_keluar',$x);
}else{
  $x['sql']   =$this->madmin->barang_keluar();  
  $x['judul'] ="Cetak Fakur Keluar";
  admin_tpl('admin/faktur_barang_keluar',$x);
}
}

public function profil()
{
  if($this->session->userdata('rian') != true){
     $this->session->set_flashdata('pesan','<div class="callout callout-danger">Silahkan donasi Untuk Aksi edit data</div>');
     redirect(base_url('admin/hak_akses'));
    exit();  
  }
 

  $id=$this->session->userdata('id_admin');
  $data=$this->db->get_where('rn_admin',array('id_admin'=>$id));
  if (isset($_POST['kirim'])) {
    $this->form_validation->set_rules('username','Username','required|is_unique[rn_admin.username]');
    $this->form_validation->set_rules('nama','Nama','required');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('email','Email','required|valid_email');
    
   if ($this->form_validation->run() == TRUE) {
      if (empty($_FILE['foto']['name'])) {
        $sql=array(       
          'username'=>$this->input->post('username'),
          'password'=>md5($this->input->post('password')),
          'email'=>$this->input->post('email'),
          'nama'=>$this->input->post('nama'),);
        $db=$this->db->update('rn_admin',$sql,array('id_admin'=>$id));
        if ($db) {
         $this->session->set_flashdata('pesan','<div class="callout callout-info">Profil Berhasil Di Perbaharui. </div>');
         redirect(base_url('admin/profil'));
       }else{
        $this->session->set_flashdata('pesan','<div class="callout callout-warning">Profil Gagal Permintaan Query Bermalah.</div>');
        redirect(base_url('admin/profil'));
      } 
    }else{
      $config['file_name'] ='foto'.time();
      $config['upload_path']="./assets/file/";
      $config['allowed_types']  = 'gif|jpg|png';
      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto') == TRUE ) {
       $sql=array(       
        'username'=>$this->input->post('username'),
        'password'=>md5($this->input->post('password')),
        'email'=>$this->input->post('email'),
        'foto'=>$this->upload->file_name,
        'nama'=>$this->input->post('nama'),);
       $db=$this->db->update('rn_admin',$sql,array('id_admin'=>$id));

       if ($db) {
         $this->session->set_flashdata('pesan','<div class="callout callout-info">Profil Berhasil Di Perbaharui. </div>');
         redirect(base_url('admin/profil'));
       }else{
        $this->session->set_flashdata('pesan','<div class="callout callout-warning">Profil Gagal Permintaan Query Bermalah.</div>');
        redirect(base_url('admin/profil'));
      } 
    }else{
      $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info">','</div>'));
      redirect(base_url('admin/profil'));
    }
  }

}else{
 $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
 redirect(base_url('admin/profil'));

}
}else{
  $x = ['judul'=>'Data Profil',
  'username'=>$data->row()->username,
  'email'=>$data->row()->email,
  'foto'=>$data->row()->foto,
  'nama'=>$data->row()->nama];
  admin_tpl('admin/profil',$x);      
}
}

public function hak_akses($action='',$id='')
{
 if ($action == "add") {
     
   if (isset($_POST['kirim'])) {

    $this->form_validation->set_rules('username','Username','required|is_unique[rn_admin.username]');
    $this->form_validation->set_rules('nama','Nama','required');
    if ($this->form_validation->run() == TRUE) {

      $config['file_name'] ='foto'.time();
      $config['upload_path']="./assets/file/";
      $config['allowed_types']        = 'gif|jpg|png';
      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto') == TRUE ) {
       $sql=array(       
        'username'=>$this->input->post('username'),
        'password'=>md5($this->input->post('password')),
        'email'=>$this->input->post('email'),
        'level'=>$this->input->post('level'),
        'foto'=>$this->upload->file_name,
        'nama'=>$this->input->post('nama'),);
       $db=$this->db->insert('rn_admin',$sql);
       if ($db) {
        if ($this->session->userdata('id_admin') == $id) {
          $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di Tambah</div>');
          redirect(base_url('admin/hak_akses'));
        } else{
         $this->session->set_flashdata('pesan','<div class="callout callout-danger">Data Berhasil Di Tambah</div>');
         redirect(base_url('admin/hak_akses/add'));
       }
     }
   }else{
     $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info">','</div>'));
     redirect(base_url('admin/hak_akses/add'));
   }

 }else{
  $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
  redirect(base_url('admin/hak_akses/add'));
}

}else{
 $x['form'] ='y'; 
 $x['username']="";
 $x['nama']="";
 $x['email']='';
 $x['gambar']="";
 $x['aksi'] ='add';
 $x['jk']="";
 $x['judul']="Hak Akses";
 $x['aksi']="add";
 admin_tpl('admin/hak_akses',$x);
}

}elseif($action =="edit"){
  if($this->session->userdata('rian') != true){
     $this->session->set_flashdata('pesan','<div class="callout callout-danger">Silahkan donasi Untuk Aksi edit data</div>');
     redirect(base_url('admin/hak_akses'));
    exit();  
  }
 

  /*$id=$this->session->userdata('id_admin');*/
  $data=$this->db->get_where('rn_admin',array('id_admin'=>$id));   
  if (isset($_POST['kirim'])) {

    $this->form_validation->set_rules('username','Username','required|is_unique[rn_admin.username]');
    $this->form_validation->set_rules('nama','Nama','required');
    if ($this->form_validation->run() == TRUE) {

      $config['file_name'] ='foto'.time();
      $config['allowed_types'] ='png|jpg';
      $config['upload_path']="./assets/file";
      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto') == TRUE ) {
       @unlink('./assets/gambar/'.$data->row()->gambar);
       $sql=array(       
        'username'=>$this->input->post('username'),
        'password'=>md5($this->input->post('password')),
        'email'=>$this->input->post('email'),
        'level'=>$this->input->post('level'),
        'foto'=>$this->upload->file_name,
        'nama'=>$this->input->post('nama'),);
       $db=$this->db->update('rn_admin',$sql,array('id_admin'=>$id));
       if ($db) {

        if ($this->session->userdata('id_admin') == $id) {
         $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di edit password Anda Di Ubah Menjadi'.$this->input->post('password').'</div>');
         redirect(base_url('admin/hak_akses/edit/'.$id));
       } else{
         $this->session->set_flashdata('pesan','<div class="callout callout-info">Data Berhasil Di edit</div>');
         redirect(base_url('admin/hak_akses/'));
       }

     }else{
      buat_alert('sql ERROR');
    }

  }else{
   $this->session->set_flashdata('pesan',$this->upload->display_errors('<div class="callout callout-info">','</div>'));
   redirect(base_url('admin/hak_akses/edit/'.$id));
 }

}else{
  $this->session->set_flashdata('pesan',validation_errors('<div class="callout callout-danger">','</div>'));
  redirect(base_url('admin/hak_akses/edit/'.$id));
}

}else{
 $x['form'] ='y'; 
 $x['username']=$data->row()->username;
 $x['nama']=$data->row()->nama;
 $x['email']=$data->row()->email;
 $x['gambar'] =$data->row()->foto;     
 $x['judul']="Hak Akses";
 $x['aksi']="add";
 admin_tpl('admin/hak_akses',$x);
}

}elseif($action =="delete"){
if($this->session->userdata("rian") == "12"){

redirect(base_url('admin/hak_akses'));
exit();


}

 if ($this->session->userdata('id_admin') == $id){
  $this->session->set_flashdata('pesan','<div class="callout callout-danger">Anda Tidak Dapat Menghapus Anda Sendiri</div>');
  redirect(base_url('admin/hak_akses'));
}else{
 $data=$this->db->get_where('rn_admin',array('id_admin'=>$id)); 
 @unlink('assets/gambar/'.$data->row()->gambar);
 $this->db->delete('rn_admin',array('id_admin'=>$id));
 $this->session->set_flashdata('pesan','<div class="callout callout-danger">Berhasil Di Hapus</div>');
 redirect(base_url('admin/hak_akses'));
}
}else{
  $x['form'] ='n'; 
  $x['judul']="Hak Akses";
  $x['data']=$this->db->get('rn_admin');
  admin_tpl('admin/hak_akses',$x);
}
}

public function keluar($value='')
{
 $this->session->sess_destroy();
 redirect(base_url('/?rn_=log'));

}


public function identitas($action='',$id='')
{

  if ($action == "edit") {
  cek_table('rn_setting','parameter',$id);
    if (isset($_POST['kirim'])) {
  if ($this->session->userdata('rian') != true) {
    $this->session->set_flashdata('pesan','<div class="callout callout-danger"><i class="fa fa-info"></i>Maaf Aksi Tidak Di Izinkan Silahkan Donasi Untuk Sourcode</div>');
    redirect(base_url('admin/identitas'));
    exit();
    $this->db->close();
  }


      $this->form_validation->set_rules('parameter','Parameter','required');
      $this->form_validation->set_rules('nilai','Nilai','required');
      
      if ($this->form_validation->set_rules() == FALSE) {

      }else{
       $sql=array('nilai'=>strip_tags($this->input->post('nilai')),);
       $cek=$this->db->update('rn_setting',$sql,array('parameter'=>$id));      
       if($cek){
        $this->session->set_flashdata('pesan','<div class="callout callout-info">Dat Berhasil Di Perbaharui</div>');
        redirect(base_url('admin/identitas'));
      }else{
        echo "ERROR";
      } 
    } 
  }else{
   $x['form']  ='y';
   $x['data']  = $this->db->get_where('rn_setting',array('parameter'=>$id)); 
   $x['parameter']=$x['data']->row()->parameter;
   $x['nilai']=$x['data']->row()->nilai;
   $x['judul'] ="Identitas Aplikasi";
   admin_tpl('admin/identitas',$x);
 }
}else{   
 $x['form']  ='n';
 $x['data']  = $this->db->get('rn_setting'); 
 $x['judul'] ="Identitas Aplikasi";
 admin_tpl('admin/identitas',$x);
 
}
}
/*temporer barang ---*/
public function tmp_barang($action='')
{
  if ($action =='delete') {

    $id=$this->input->post('id');
    $this->db->delete('tmp_purchase',array('id_barang'=>$id));

  }else{
    $id=$this->input->post('id');
    $cek= $this->db->get_Where('tmp_purchase',array('id_barang'=>$id));
    if ($cek->num_rows() > 0) {
      echo'<div class="callout callout-warning">Data Barang Di Pilih Sudah Ada</div>';
    }else{  
     $data=['id_barang'=>$this->input->post('id')];
     $this->db->insert('tmp_purchase',$data);
   }
 }
}

public function list_tmp()
{
 $this->load->view('admin/list_tmp');
}

/*ajax cari data*/

function cari_suplier(){
 $id_sp=$this->input->post('id_sp');
 $data=$this->db->get_where('rn_suplier',array('id_suplier'=>$id_sp))->result_array();
 echo json_encode($data);
}


function noting_404(){
  $x['judul'] ="Halaman Tidak Di Di Temukan Atau Parameter Salah ";
  admin_tpl('404',$x);
}

/*end ajax function*/
}


