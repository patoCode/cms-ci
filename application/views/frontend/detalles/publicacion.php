<?php foreach ($publicacion as $p): ?>
	<h3><?php echo $p->titulo; ?></h3>
	<p>
		<?php echo $p->descripcion; ?>
	</p>
<?php endforeach; ?>