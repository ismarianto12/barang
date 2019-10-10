
</div>
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; <a href=""><?= $this->config->item('copy') ?></a>.</strong> All rights
  reserved.
</footer>

<script src="<?= base_url('assets/rn') ?>/dist/js/jquery.min.js"></script> 
<script src="<?= base_url('assets/rn') ?>/dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/rn') ?>/dist/js/bootstrap.min.js"></script> 
<script src="<?= base_url('assets/rn') ?>/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/rn') ?>/plugins/datatables.net-bs/js/jquery.dataTables.min.js"></script> 
<script src="<?= base_url('assets/rn') ?>/dist/js/jquery.nestable.js"></script>
<script src="<?= base_url('assets/rn') ?>/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assets/rn') ?>/dist/js/responsive.js"></script>
<script src="<?= base_url('assets/rn') ?>/plugins/datatables.net-bs/js/jquery.slimscroll.min.js"></script>
<script>

  $(function () {

    $("#tanggal1").datepicker({
      format:'yyyy-mm-dd'
    });

    $("#tanggal2").datepicker({
      format:'yyyy-mm-dd'
    });

    $("#tanggal").datepicker({
      format:'yyyy-mm-dd'
    });
  });


  $(function () {
    $('#example1').DataTable({
      'responsive' : true,
   })
    
    
  })

  $(document).ready(function(){
    $(".fa-trash").click(function(){
      if (!confirm(" Ingin menghapus ini?")){
        return false;
      }
    });
  });
</script>


</body>
</html>

