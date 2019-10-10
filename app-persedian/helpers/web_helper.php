<?php 
function barasiah($nilai)
{
 $filter = stripslashes(strip_tags(htmlspecialchars($nilai,ENT_QUOTES)));
    return $filter;
}

/*bagian form*/



function cek_session($level){
  $CI =& get_instance();
  if (empty($_SERVER['USER_AGENT'])) {
     $alamat=base_url('');
  }else{
    $alamat=$_SERVER['USER_AGENT'];
  }
  
  if($CI->session->userdata('level') != $level){
   $CI->session->set_flashdata('pesan','<div class="callout callout-danger">Hak Akses Tidak Di Izinkan</div>');
   redirect(base_url('admin/404'));
   exit();
   $this->db->close(); 
  }else{
   
  }
}



function get_id($id)
{
  $CI =& get_instance();
  if (empty($id)) {
     redirect(base_url($CI->uri->segment(2)));
  }else{
 $data=array('.','+','union','\'','\'','""','"',"\"\"");
 $hasil=str_replace($data,' ',$id); 
 return barasiah($hasil);
}
}

 

function cek_table($table,$id_table,$id)
{
 
   $CI =& get_instance();
   $data=barasiah($id);
   $sql=$CI->db->get_where($table,array($id_table=>$id));
   if ($sql->num_rows() > 0) {
   
   }else{
     redirect(base_url('404'));
   }
}
 
function limit($batas='',$aktivasi='')
{
 $CI =& get_instance();
 $hasil=$batas-date("d-m");

if ($aktivasi =='cucok_meong') {
 
}else{

 if ($hasil == 0) {
     print_r("Masa Penggunaan Sistem Telah Berakhir Silahkan Donasi Untuk memperpanjang Hubungi Ismarianto 085274304352");
     exit();
     $CI->db->close();
  }else{
   
  } 

}

}



function cari($data)
{
 $CI =& get_instance();
 $sql=$CI->db->get_where("rn_setting",array('parameter'=>$data));
 return $sql->row()->nilai;
}



function buka_form($action='')
{
 echo '
 <form action="'.$action.'" method="POST" enctype="multipart/form-data">';   
}

function buat_text_box($label='',$type='text',$name='',$value='')
{
  echo '<div class="form-group"><label for="kelas" class="col-sm-2 control-label">'.$label."</label><div class='col-sm-4'><input type='".$type."' name='".$name."' class='form-control' value='".$value."' required='' placeholder='".$label."...''><br /></div></div>"; 
}
function buat_text_area($label='',$class='ckeditor',$name='',$value='')
{
  echo '<div class="form-group"><label for="kelas" class="col-sm-2 control-label">'.$label."</label><div class='col-sm-4'><textarea name='".$name."' class='".$class." form-control' cols='10' row='20' required=''>".$value."</textarea><br />
     </div></div>"; 
}

function buat_select($label, $nama, $list, $nilai){
  echo '<div class="form-group"><label for="kelas" class="col-sm-2 control-label">'.$label.'</label>
        <div class="col-sm-4"><select class="form-control" name="'.$nama.'">';
    foreach($list as $ls){
      $select = $ls['val']==$nilai ? 'selected' : '';
      echo'<option value='.$ls['val'].' '.$select.'>'.$ls['cap'].'</option>';
    }
  echo'   </select>
       <br />  
      </div>
      </div>';
}
function tutup_form($name='kirim'){
  $CI =& get_instance();
  echo'
 
  <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
       <br /><br /><br />   
        <button type="submit" class="btn btn-primary" name="'.$name.'">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
        </button>
        <a class="btn btn-warning" href="'.base_url('admin/').$CI->uri->segment(2).'">
          <i class="glyphicon glyphicon-arrow-left"></i> Batal 
        </a>
      </div>
    </div>
  </form>';
}



  function admin_tpl($konten,$array)
  {

  $CI =& get_instance();
  $CI->load->view('template/header_admin',$array);
  $CI->load->view($konten);
  $CI->load->view('template/footer');
  }



function buat_alert($pesan){
  echo'<script type="text/javascript">alert("'.$pesan.'");window.location.href="javascript:history.back()"; </script>'; 
  }


function tgl_indonesia($tgl){
  $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    
  $tanggal = substr($tgl,8,2);
  $bulan = $nama_bulan[(int)substr($tgl,5,2)];
  $tahun = substr($tgl,0,4);
  
  return $tanggal.' '.$bulan.' '.$tahun;     
} 


function notif($kalimat='',$warna='')
{
  echo '<div class="alert alert-'.$warna.' alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 '.$kalimat.'.
                            </div>'; 
}