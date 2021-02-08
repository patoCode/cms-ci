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