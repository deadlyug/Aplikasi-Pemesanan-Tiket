			<!-- start footer Area -->		
			<?php $this->load->view('components/footer'); ?>
			<!-- End footer Area -->	

			<script src="<?php echo base_url();?>assets/assets/js/vendor/jquery-2.2.4.min.js"></script>
			<script src="<?php echo base_url();?>assets/assets/js/vendor/bootstrap.min.js"></script>			
  			<script src="<?php echo base_url();?>assets/assets/js/easing.min.js"></script>			
			<script src="<?php echo base_url();?>assets/assets/js/superfish.min.js"></script>	
			<script src="<?php echo base_url();?>assets/assets/js/jquery.ajaxchimp.min.js"></script>
			<script src="<?php echo base_url();?>assets/assets/js/jquery.magnific-popup.min.js"></script>	
			<script src="<?php echo base_url();?>assets/assets/js/owl.carousel.min.js"></script>			
			<script src="<?php echo base_url();?>assets/assets/js/main.js"></script>

			<script>
	    $(document).ready(function() {
	        // Untuk sunting
	        $('#edit-data').on('show.bs.modal', function (event) {
	            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
	            var modal          = $(this)
 
	            // Isi nilai pada field
	            modal.find('#id').attr("value",div.data('id'));
	        });
	    });
	</script>	

		</body>
	</html>



