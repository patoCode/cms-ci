<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1><i class="fa fa-file"></i> Archivos Publicados</h1>
                <p>Publicaciones de la comunidad</p>
            </div>
            <div class="col-sm-6">
                <!-- <ul class="breadcrumb pull-right">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Portfolio</li>
                </ul> -->
            </div>
        </div>
    </div>
</section>
<div class="row">
	<div class="container" style="margin-top:50px;min-height:485px;">
		<div class="col-md-12">
			<?php if(count($elementos) > 0): ?>
				<ul class="list-unstyled">
				<?php foreach($elementos as $elemento): ?>
					<li>
						<a href="<?php echo base_url().$elemento->path_server.$elemento->path_archivo;?>" target="_blank">
							<i class="fa fa-archive"></i>
							<?php echo $elemento->archivo; ?>
						</a>
						<?php
							$datetime1 = date_create($elemento->fecha);
							$datetime2 = date_create(date("Y-m-d H:i:s"));
							$dias = date_diff($datetime1, $datetime2,true)->format('%a');

							if($dias <= 2):
								$class = 'label-success';
								if($dias == 1):
									$class = 'label-default';
								endif;

								$prefijo = ' día';
								if($dias > 1) $prefijo = ' dias';
						?>
								<span class="label <?php echo $class; ?>">
									<?php echo 'Hace '.$dias.$prefijo;?>
								</span>
							<?php endif; ?>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php else: ?>
				<h5 style="margin-top:20px">
					No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
				</h5>
			<?php endif; ?>
		</div>
	</div>
</div>