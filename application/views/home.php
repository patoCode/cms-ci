<?php $this->load->view('frontend/head'); ?>
<body onload="actualizaReloj()" >
	<?php $this->load->view('frontend/main-menu'); ?>
	<?php $this->load->view('frontend/bienvenida'); ?>
	<!-- INICIO CATEGORIAS -->
	<section id="services" class="emerald">
        <div class="container">
            <div class="row">
				<?php for($i=0;$i<count($categorias);$i++): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="media">
                        <div class="pull-left">
                            <i class="icon-angle-right icon-md"></i>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">
                            	<a href="#"><?php echo $categorias[$i][0]->categoria ?></a>
                            </h3>
                            <?php
								$j = 0;
								$cant = count($categorias[$i][1]);
							?>
							<?php if($cant > 5): ?>
								<span style="color:#34495e;font-weight:bold;font-style:italic;"><?php echo $cant; ?> archivos</span>
							<?php endif; ?>
							<ul class="list-unstyled lista-archivos">
							<?php foreach ($categorias[$i][1] as $archivo) : ?>
								<li>
									<a href="<?php echo base_url().$archivo->path_server.$archivo->path_archivo; ?>">
										<?php echo $archivo->archivo ?>
									</a>
								</li>
							<?php $j++;
								if($j>=5) break;
							endforeach;?>
							</ul>
                            <a href="<?php echo base_url(); ?>Listado/archivo/<?php echo $categorias[$i][0]->id_categoria; ?>" class="ver-mas ver-todos">
								VER TODOS <i class="fa fa-angle-right"></i>
							</a>
                        </div>
                    </div>
                </div><!--/.col-md-4-->
                <?php endfor; ?>
            </div>
        </div>
    </section>
	<!-- FIN CATEGORIAS -->

	<!-- PUBLICACIONES -->
	<section id="testimonial">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-12">
	                <div class="center">
	                    <h2>Publicaciones y Avisos</h2>
	                    <p> Lorem ipsum dolor sit amet. </p>
	                </div>
	                <div class="gap"></div>
	                <div class="row">
	                    <div class="col-md-6">
	                        <h3>Publicaciones Destacadas</h3>
	                        <?php
								$i = 0;
								if(count($nuevas)>0):
									$nuevas = $nuevas[0][1];
							?>
							<ul class="list-unstyled lista-archivos nuevas-publicaciones">
								<?php foreach ($nuevas as $archivo):
										$id = $archivo->id_categoria;
								?>
								<li>
									<a href="<?php echo base_url().$archivo->path_server.$archivo->path_archivo; ?>" title="<?php echo $archivo->archivo; ?>"  class="new-link" target="_blank">
										<span class="rrhh">
											PBN:
										</span>
										<span class="title">
											<?php echo $archivo->archivo;?>
										</span>
										<?php
											$datetime1 = date_create($archivo->fecha);
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
									</a>
								</li>
							<?php
								if($i > 9) break;
								$i++;
							endforeach; ?>
							</ul>
							<?php if(count($nuevas) > 10): ?>
								<a href="<?php echo base_url() ?>Listado/archivo/<?php echo $id; ?>" class="ver-mas">
									VER TODOS <i class="fa fa-angle-right"></i>
								</a>
							<?php endif; ?>
						<?php endif; ?>
	                    </div>
	                    <div class="col-md-6">
							<h3>Avisos RRHH</h3>
							<?php
								$i = 0;
								if(count($rrhh)>0):
									$rrhh = $rrhh[0][1];
							?>
							<ul class="list-unstyled lista-archivos nuevas-publicaciones">
								<?php foreach ($rrhh as $archivo):
										$id = $archivo->id_categoria;
								?>
								<li>
									<a href="<?php echo base_url().$archivo->path_server.$archivo->path_archivo; ?>" title="<?php echo $archivo->archivo; ?>"  class="new-link" target="_blank">
										<span class="rrhh">RRHH: </span>
										<span class="title">
											<?php echo $archivo->archivo;?>
										</span>
										<?php
											$datetime1 = date_create($archivo->fecha);
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
									</a>
								</li>
							<?php
							if($i > 9) break;
							$i++;
							endforeach; ?>
							</ul>
							<?php if(count($rrhh) > 10): ?>
								<a href="<?php echo base_url() ?>Listado/archivo/<?php echo $id; ?>" class="ver-mas">
									VER TODOS <i class="fa fa-angle-right"></i>
								</a>
							<?php endif; ?>
							<?php endif; ?>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- FIN PUBLICACIONES -->

	<!-- MODAL DE ALERTA DE NUEVA NOTICIA -->
	<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header blue-ende" style="padding:15px;color:white">
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
					<h4 class="modal-title" id="myModalLabel">Actualmente en la Comunidad</h4>
				</div>
				<div class="modal-body">
					<?php foreach ($news as $new): ?>
						<div class="well">
							<strong><?php echo $new->categoria; ?></strong>:
							<a href="<?php echo base_url().$new->path_server.$new->path_archivo;?>">
								<i class="fa fa-newspaper-o"></i>
								<?php echo $new->archivo; ?>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		//$('#noticeModal').modal('show')
	</script>
	<!-- FIN MODAL NUEVA NOTICIA -->
	<?php $this->load->view('frontend/widget-footer'); ?>
	<?php $this->load->view('frontend/footer'); ?>
	<script src="<?php echo base_url();?>public/js/app.js"></script>
</body>
</html>