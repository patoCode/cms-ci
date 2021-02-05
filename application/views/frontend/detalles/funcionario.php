<div class="background-gradient modal-func" style="min-height:300px;">
	<div class="modal-funcionario yellow-ende">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php foreach ($funcionario as $funcionario): ?>
		<h3 class="text-center"><?php echo $funcionario->nombres.' '.$funcionario->apellido_pat.' '.$funcionario->apellido_mat; ?></h3>
		<div class="col-md-5">
		<?php if($funcionario->path_foto != 'primera/-1' && $funcionario->path_foto != "" && $funcionario->path_foto != NULL && $funcionario->path_foto != "primera/hombrend.jpg"): ?>
				<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_FOTO_FUNCIONARIO.$funcionario->path_foto;?>)"></div>
		<?php else: ?>
				<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_FOTO_FUNCIONARIO;?>user_default.png)"></div>
		<?php endif; ?>
		</div>
		<div class="col-md-7" style="color:#7f8c8d">
			<strong>Cumplea&ntilde;os:</strong>
				<?php
					$hoy = date("Y-m-d");
					if($funcionario->cumpleanio == $hoy):
						$cumpleanios = 'Hoy';
					else:
						$nacimiento = explode('-',$funcionario->cumpleanio);
						setlocale(LC_TIME, 'spanish');
							$mes=ucfirst(strftime("%B",mktime(0, 0, 0, $nacimiento[1], 1, 2000)));
							$cumpleanios = $nacimiento[2].' de '.$mes;
					endif;
					echo $cumpleanios;
				?>
				<br>
			<strong>Correo:</strong> <?php echo $funcionario->email_ende ?><br>
			<strong>Unidad:</strong> <?php echo $funcionario->unidad_organizacional ?><br>
			<strong>Cargo:</strong> <?php echo $funcionario->cargo ?><br>
			<strong>Jefe Inmediato:</strong> <?php echo $funcionario->jefe_inmediato ?><br>
			<strong>Lugar de Trabajo:</strong> <?php echo $funcionario->lugar_trabajo ?><br>
			<strong>Interno:</strong> <?php echo $funcionario->interno ?><br>
			<strong>Celular:</strong> <?php echo $funcionario->celular ?><br>
		</div>
		<?php endforeach; ?>
	</div>
</div>