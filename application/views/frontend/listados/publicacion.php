<div class="col-md-7">
	<h4> <i class="fa fa-newspaper-o"></i> Publicaciones</h4>
	<?php if(count($elementos) > 0 ): ?>
		<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			  <tr style="border:0">
			    <th style="border:0;font-size:16.5px">Fecha</th>
			    <th style="border:0;font-size:16.5px">Publicaci&oacute;n</th>
			  </tr>
			</thead>
			<tbody>
			<?php
				foreach($elementos as $elemento):
					$fecha = explode('-',$elemento->fecha);
					setlocale(LC_TIME, 'spanish');
					$mes=ucfirst(strftime("%B",mktime(0, 0, 0, $fecha[1], 1, 2000)));
					$display_fecha = $mes.' '.$fecha[1];
			?>
				<tr style="border:0">
					<td style="border:0"><?php echo $display_fecha ?></td>
					<td style="border:0">
						<a href="<?php echo base_url(); ?>Publicacion/detalle/<?php echo $elemento->id_publicacion; ?>">
							<?php echo $elemento->titulo ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
	</div>
	<?php else: ?>
		<h5 style="margin-top:20px">
			No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
		</h5>
	<?php endif; ?>
</div>