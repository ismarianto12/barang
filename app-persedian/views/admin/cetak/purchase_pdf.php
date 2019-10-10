<link rel="stylesheet" href="<?= base_url() ?>assets/rn//bootstrap/css/bootstrap.min.css">
<?php 
  if($this->uri->segment(3) == 'det_print'){ 
   echo '
   <script>window.print()</script>
   <style type="text/css">
           a{display:none;
            }
            button{
              display:none;
            }
            .btn {
            	display:none;
            }

          </style>';
  }	
  include 'purchase_order_print.php';
?>
