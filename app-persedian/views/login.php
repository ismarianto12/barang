<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
  Login - Aplikasi </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('assets/rn') ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/rn/bootstrap/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/rn/dist/css/login.css') ?>">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <script src="<?= base_url('assets/rn/bootstrap/js/') ?>/jquery-1.11.2.min.js"></script> 
  <script src="<?= base_url('assets/rn/dist/js/') ?>/sweetalert.js"></script> 
  <script type="text/javascript">
    function base_url(){
       return "<?= base_url(); ?>";   
    }
  </script> 
 <script src="<?= base_url('assets/rn/dist/js') ?>/login.js"></script> 

</head>
<body>
    <div class="main-content-wrapper">
        <div class="login-area">
            <?= $this->session->flashdata('pesan') ?>
            <div class="login-header">
                <a href="" class="logo">
                   
                </a>
                <h5 class="title"><?= strip_tags(cari('nama_app')) ?> </h2>
                <h4><?= strip_tags(cari('nama_perusahaan')) ?> </h4>
            </div>
            <div class="login-content">
                <form id="login" class="form-horizontal">
                <div class="form-group">
                    <input type="text" class="input-field" name="username" placeholder="Email"
                    required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="input-field" name="password" placeholder="Password"
                    required>
                </div>
                <button class="btn btn-primary" name="login">Login<i class="fa fa-lock"></i></button>
             </form>

            <div class="login-bottom-links">
                <a href="<?= base_url('forgot_password.html') ?>" class="link">
                   Lupa Password ?
                </a>
            </div>
        </div>
    </div>
    <div class="image-area">
     </div>
</div>
 </body>
</html>
