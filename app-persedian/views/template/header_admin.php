<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/bootstrap/css/bootstrap.min.css">
  <script src="<?= base_url('assets') ?>/ckeditor/ckeditor.js"></script>
  <script src="<?= base_url('assets') ?>/ckeditor/styles.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/bootstrap/font-awesome/css/font-awesome.min.css">
  <link rel="icon" href="<?= base_url('assets/rn/dist/img/favicon.ico') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" /> 
   <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/dist/css/responsive_tbl.css">
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/dist/css/skins/_all-skins.min.css">
  <script src="<?= base_url('assets/rn/') ?>/bootstrap/js/jquery-1.11.2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/rn/') ?>/dist/css/datepicker.css"> 
  <script src="<?= base_url('assets/rn/') ?>/dist/js/sweetalert.js"></script>
  <script src="<?= base_url('assets/rn/') ?>/dist/js/Chart.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <script type="text/javascript">
   function keluar(){

    swal({
      title: "Anda Yakin Untuk Keluar?",
      text: "Keluar Dari Halaman Administrator Untuk Mengakhiri Session Anda ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Sedang mengalihkan", {
          icon: "success",
        });
        window.location.href = "<?= base_url('admin/keluar') ?>";

      } else {

        swal({
          title: "Anda Membatalkan Keluar Dari Halaman Administrator",
          icon: "success",
          button: "Tutup Dialog",
        });
      }
    });


  }


</script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Administrator</b><i>Panel</i></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <?php $Data_user=$this->db->get_where('rn_admin',array('id_admin'=>$this->session->userdata('id_admin'))); ?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <?= ucfirst($this->session->userdata('nama')) ?>
             </a>
             <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?= $this->session->userdata('nama') ?> 
                  <small>Login Terakhir Anda <?= $this->session->userdata('log') ?></small>
                  <img src="<?= base_url('assets/file/'.$Data_user->row()->foto) ?>" class="img-circle image-responsive" style="width: 100px;height: 100px">
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">

              </li>
              <!-- Menu Footer-->
              <li class="user-footer">

               <div class="pull-left">
                <a href="<?= base_url('admin/profil') ?>" class="btn btn-default btn-flat">Profil</a>
              </div>

              <div class="pull-right">
                <button onclick="return keluar()" class="btn btn-default btn-flat">Sign out</button>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>

        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li>
        <a href="<?= base_url('admin') ?>">
          <i class="fa fa-home"></i>
          <span>Beranda</span>
        </a>
      </li>


      <?php if($this->session->userdata('level') == "admin"): ?>
        <li class="treeview">
          <a href="">
            <i class="fa fa-cube"></i>
            <span>Data Master</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin\data_suplier') ?>"><i class="fa fa-circle-o"></i>Data Suplier</a></li>
            <li><a href="<?= base_url('admin\data_klien') ?>"><i class="fa fa-circle-o"></i>Data Klien</a></li>
            <li><a href="<?= base_url('admin\data_kelompok') ?>"><i class="fa fa-circle-o"></i>Data Kelompok Barang</a></li>
            <li><a href="<?= base_url('admin\lokasi_barang') ?>"><i class="fa fa-circle-o"></i>lokasi Barang</a></li>

          </ul>
        </li>


        <li class="treeview">
          <a href="">
            <i class="fa fa-cubes"></i>
            <span>Transaksi Barang Masuk</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\data_barang') ?>"><i class="fa fa-circle-o"></i>Data Barang </a></li>
           </ul>
        </li>
         <li><a href="<?= base_url('admin/purchase_order') ?>"><i class="fa fa-reorder"></i><span>Purchase Order</span> </a></li>
        <li class="treeview">
           <a href="">
            <i class="fa fa-list-ol"></i>
            <span>Transaksi Barang Keluar</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin/barang_keluar') ?>"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
            <li><a href="<?= base_url('admin/cetak_faktur_keluar') ?>"><i class="fa fa-circle-o"></i>Cetak Faktur Keluar</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-list-ol"></i>
            <span>Laporan </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin/laporan_stok_barang') ?>"><i class="fa fa-circle-o"></i>Stok Barang </a></li>
            <li><a href="<?= base_url('admin/laporan_stok_barang') ?>"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
            <li><a href="<?= base_url('admin/laporan_barang_keluar') ?>"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
             
          </ul>
        </li>


        <li class="treeview">
          <a href="">
            <i class="fa fa-wrench"></i>
            <span>Setting</span>
            <i class="fa fa-angle-left"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin\identitas') ?>"><i class="fa fa-user"></i>Identitas</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-list"></i>
            <span>Grafik</span>
            <i class="fa fa-angle-left"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('grafik\penerimaan_barang') ?>"><i class="fa fa-list"></i>Penerimaan Barang</a></li>
            <li><a href="<?= base_url('grafik\barang_keluar') ?>"><i class="fa fa-list"></i>Barang Keluar</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="">
            <i class="fa fa-user"></i>
            <span>Data Hak Akses</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin\hak_akses') ?>"><i class="fa fa-circle-o"></i>Hak akses</a></li>
          </ul>
        </li>


      <?php elseif($this->session->userdata('level') == "user"): ?>

       <li><a href="<?= base_url('admin/cetak_faktur_keluar') ?>"><i class="fa fa-list"></i>Cetak Faktur Keluar</a></li>
       <li><a href="<?= base_url('admin/laporan_stok_barang') ?>"><i class="fa fa-cubes"></i>Stok Barang </a></li>
       <li><a href="<?= base_url('admin/laporan_barang_keluar') ?>"><i class="fa fa-clone"></i>Barang Keluar</a></li>
       <li><a href="<?= base_url('admin/cetak_faktur_keluar') ?>"><i class="fa fa-cubes"></i>Faktur Barang Keluar</a></li>
       <li><a href="<?= base_url('admin/purchase_order') ?>"><i class="fa fa-reorder"></i><span>Purchase Order</span> </a></li>
     <?php endif; ?>

   </ul>
 </section>
 </aside>
 <div class="content-wrapper">
  <section class="content" style="background:  #fff;"> 
    <div class="row">
      <div class="col-xs-12">
        <div class="box">


          <section class="content-header">
            <h1>
             <i class="fa fa-cubes"></i><?= $judul ?> 
            </h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Administrator</a></li>
              <li class="active"><?= $judul ?></li>
            </ol>
          </section>
          <br /><br />


