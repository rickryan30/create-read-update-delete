<!-- footer -->

        <script src="<?php echo base_url;?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url;?>assets/js/popper.min.js"></script>
        <script src="<?php echo base_url;?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url;?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url;?>assets/js/bootstrap-datetimepicker.js"></script>

        <script type="text/javascript" src="<?php echo base_url;?>assets/js/sweetalert2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url;?>assets/js/pagination.js"></script>
        <script type="text/javascript" src="<?php echo base_url;?>assets/js/custom_controller_public.js"></script>
		
    <!-- javascript goes here  -->
    <script>
      var base_url = "<?php echo base_url();?>create-read-update-delete/"; 

      $(document).ready( function () {
			    $('#myTable').DataTable();
          $('[data-tooltip="tooltip"]').tooltip();
      });
		</script>
    <!-- end of javascript -->
    </body>
</html>