<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
				<h1><i class="fa fa-video-camera"></i> Videoteca</h1>
				<p>Videos publicados en la comunidad</p>
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

			<?php if(count($elementos)>0):?>
				<ul class="list-unstyled">
					<?php foreach($elementos as $elemento): ?>
					<li>
						<a href="<?php echo base_url().PATH_FILE_RRHH.$elemento->path_archivo; ?>">
							<i class="fa fa-video-camera"></i>
							<?php echo $elemento->archivo ?>
						</a>
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

