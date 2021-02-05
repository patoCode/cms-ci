<?php $this->load->view('frontend/head'); ?>
<body>
	<?php $this->load->view('frontend/main-menu'); ?>

	<?php $this->load->view('frontend/listados/'.$lista); ?>

	<?php $this->load->view('frontend/widget-footer'); ?>

	<?php $this->load->view('frontend/footer'); ?>

</body>
</html>