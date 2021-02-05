<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1><i class="fa fa-file"></i> Biblioteca Digital de Capacitaciones</h1>
                <p>Bilioteca</p>
            </div>
            <div class="col-sm-4">
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
			<?php

				if(count($elementos) > 0):
				$cont = 0;
			?>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php foreach ($elementos as $key => $elemento): ?>
					<?php if(count($elemento) > 0 ): ?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading<?php echo $cont;?>">
								<h4 class="panel-title">
									<a <?php if($cont==0) echo 'class="collapsed"';?> role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cont;?>" aria-expanded="<?php if($cont==0) echo 'true'; else echo 'false'; ?>" aria-controls="collapse<?php echo $cont;?>">
									<?php echo $key ?>
										<span class="pull-right badge"><?php echo count($elemento);?></span>
									</a>
								</h4>
							</div>
							<div id="collapse<?php echo $cont;?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $cont;?>">
								<div class="panel-body">
									<ul class="list-unstyled">
										<?php foreach ($elemento as $ele): ?>
											<?php if($ele->path_archivo != '-2' ): ?>
											<li>
												<a href="<?php echo base_url().$ele->path_server.$ele->path_archivo; ?>" target="_blank">
													<i class="fa fa-archive"></i>
													<?php echo $ele->archivo; ?>
												</a>
											</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php
					$cont++;
					endforeach; ?>
				</div>
			<?php else: ?>
				<h5 style="margin-top:20px">
					No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
				</h5>
			<?php endif; ?>
		</div>
	</div>
</div>