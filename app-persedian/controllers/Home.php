<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
 function __construct()
 {
 	parent::__construct();
  if ($this->session->userdata('admin') == TRUE) {
     redirect(base_url('admin'));
  }; 

 }
	public function index()
	{
    $x['judul'] ="Login Aplikasi"; 
		$this->load->view('login',$x);
	}

public function login(){
        $username  = barasiah($this->input->post('username'));
        $password  = barasiah($this->input->post('password'));
     
         $admin=$this->mlogin->login_admin($username,md5($password));
            if($admin->num_rows() > 0 ){ 
             $session_admin = array('id_admin' => $admin->row()->id_admin,
                                    'username'=>  $admin->row()->username,
                                    'nama'=>      $admin->row()->nama,
                                    'log'=>       $admin->row()->log,
                                    'level'=>     $admin->row()->level,
                                    'admin'=>TRUE );             
 
              $this->session->set_userdata($session_admin);
              session_start();
              $_SESSION['KCFINDER']              = array();
              $_SESSION['KCFINDER']['disabled']  = false;
              $_SESSION['KCFINDER']['uploadURL'] = base_url('assets/data/');
              echo "Y";
             }else{
                  
            }  
     } 
 
public function error_404()
{
 $x['pesan'] ="Maaf halaman yang anda cari tidak di temukan"; 
 $this->load->view('404',$x); 
}

/*step one*/
function forgot_pass(){
  $ssc=isset($_GET['ssc']) ? $_GET['ssc'] : '';
   if (isset($_POST['kirim'])) { 
     $email=$this->input->post('email');
     /*periksa di database*/
     $periksa=$this->db->get_where('rn_admin',array('email'=>$email));
     if ($periksa->num_rows() > 0) {
      $this->load->library('email');
      $this->email->from('your@example.com', 'Your Name');
      $this->email->to('kotokareh@gmail.com');
      $this->email->cc('another@another-example.com');
      $this->email->bcc('them@their-example.com');
      $this->email->subject('Email Test');
      $this->email->message('Testing the email class.');
      $this->email->send();
       
      }else{
            $this->session->set_flashdata('pesan','<div class="alert alert-danger">Email Anda Tidak Cocok Dengan Database .. </div>');
            redirect(base_url('forgot_password.html?ssc='.$ssc)); 
      }
   }else{
       $x['judul'] = "Reset Password";
       $this->load->view('lupa_sandi',$x); 

   }
  

}
/*step two*/

function cek_ssc(){
  $ssc=isset($_GET['ssc']) ? $_GET['ssc'] : '';
   $safe=barasiah($ssc);
   if ($ssc) {
     if ($ssc == '') {
          redirect(base_url('forgot_password.html'));   
        }else{
          $cek=$this->db->get_where('rn_admin',array('id_reset'=>$safe));
          if ($cek->num_rows() > 0) {
              
          }else{
            $this->session->userdata('pesan','<div class="callout callout-info">Akun Login Tidak Di kenali Silahkan Coba Kembali</div>');
            redirect(base_url('forgot_password.html?ssc='.$ssc));  }
      }   
   }else{  


 }

}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */