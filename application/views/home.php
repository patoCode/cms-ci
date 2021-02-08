<?php $this->load->view('frontend/head'); ?>
<body onload="actualizaReloj()" >
	<?php $this->load->view('frontend/main-menu'); ?>
	<?php $this->load->view('frontend/bienvenida'); ?>
	<!-- INICIO CATEGORIAS -->
	<section id="services" class="emerald">
        <div class="container">
            <div class="row">
				<?php 
				
				for($i=0;$i<count($categorias);$i++): ?>  
                <div class="col-md-4 col-sm-6" style="margin-bottom: 30px;">
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
                            <a href="<?php echo base_url(); ?>Listado/archivo/<?php echo $categorias[$i][0]->id_categoria; ?>" 
							    class="ver-mas ver-todos">
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
	<?php //$this->load->view('frontend/sections', $nuevas, $rrhh);?>
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