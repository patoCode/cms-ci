<?php $this->load->view('frontend/head'); ?>
<body>
	<?php if($categoria->num_rows() > 0): ?>
	<div class="container">
		<h3><?php echo $categoria->row()->categoria; ?></h3>
		<ul class="list-unstyled">
			<?php
				if(count($publicaciones) > 0):
					foreach ($publicaciones as $publicacion): ?>
					<li>
						<ul class="list-unstyled">
							<li><?php echo $publicacion->titulo;?></li>
							<li><?php echo $publicacion->descripcion;?></li>
						</ul>
					</li>
					<hr>
			<?php
				   endforeach;
				endif;
			?>
		</ul>
	</div>
	<?php endif; ?>
</body>