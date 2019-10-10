<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    <?= $judul ?> </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('assets/rn') ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/rn/bootstrap/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/rn/dist/css/login.css') ?>">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <script src="<?= base_url('assets/rn/bootstrap/js/') ?>/jquery-1.11.2.min.js"></script> 
  <script src="<?= base_url('assets/rn/dist/js/') ?>/sweetalert.js"></script> 
 </head>
<body>
    <div class="main-content-wrapper">
        <div class="login-area">
            
            <div class="login-header">
                <a href="" class="logo">
                   
                </a>
                <h5 class="title"><?= cari('nama_app') ?> </h2>
                <h4><?= cari('nama_perusahaan') ?> </h4>
            </div>

<?php 
 $ssc=isset($_GET['ssc']) ? $_GET['ssc'] : '';
  if ($ssc != '') { ?>

 <?php }else{ ?>
       <div class="login-content">
                <form  action="" method="POST">
                <div class="form-group">
                   <input type="email" class="input-field" name="email" placeholder="Email"
                    required autocomplete="off">
                </div> 
                <button type="submit" name="kirim" class="btn btn-primary" name="login">Kirim Kode Verifikasi <i class="fa fa-lock"></i></button>
               </form>
                <?= $this->session->flashdata('pesan') ?>
            <?php } ?>
            <div class="login-bottom-links">
               <a href="<?= base_url() ?>" class="link">
                 Kembali Ke Halaman Utama 
                </a>
            </div>
        </div>
    </div>
    <div class="image-area">
     </div>
</div>
 </body>
</html>


 
 
 
 