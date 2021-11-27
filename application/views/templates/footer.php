  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1.0
    </div>
    <strong>Copyright &copy; Bake and Wrap - <?php echo date('Y') ?>.</strong> All rights reserved.
  </footer>

  <script type="text/javascript">
    $( document).ready( function(e) {

      if($('.dataTable'))
      {
        $('.dataTable').DataTable();
      }
    })
  </script>

  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchBrandData',
    'order': []
  });
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>
