<?php
	$bandera = "col-md-4 col-sm-6";
	if(count($cumpleanieros_dia) > 0)
		$bandera = "col-md-3 col-sm-6";
?>
<section id="bottom" class="emerald">
    <div class="container">
        <div class="row">
            <div class="<?php echo $bandera; ?>">
	            <h4>Utilidades</h4>
				<ul class="list-unstyled footer-links">
					<li>
						<a data-toggle="modal" data-target="#calendarModal" href="">
							<i class="fa fa-calendar"></i>
							Calendario de actividades
						</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Encuestas">
							<i class="fa fa-bar-chart"></i>
							Encuestas
						</a>
					</li>
					
				</ul>
            </div><!--/.col-md-3-->
            <div class="<?php echo $bandera; ?>">
                <h4>Sistemas</h4>
				<ul class="list-unstyled footer-links">
				<?php foreach ($sistemas as $sistema) { ?>
					<li>
						<a href="<?php echo $sistema->link ?>" title="<?php echo $sistema->sistema;?>" target="_blank">
							<i class="fa fa-laptop"></i>&nbsp;<?php echo $sistema->sistema;?>
						</a>
					</li>
				<?php } ?>
				</ul>
				<form role="form" action="<?php echo base_url('Listado/buscar'); ?>" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="Busqueda..." name="busqueda">
                        <span class="input-group-btn">
                        	<input type="submit" class="btn blue-cms btn-color-white" value="Buscar">
                        </span>
                    </div>
                </form>
            </div><!--/.col-md-3-->

            <div class="<?php echo $bandera; ?>">
				<h4>Cumpleañeros del Mes</h4>
				<ul class="list-unstyled footer-links" id="mensual" style="height:200px;">
					<?php
						foreach ($cumpleanieros_mes as $cm):
							$nacimiento = explode('-',$cm->cumpleanio);
							setlocale(LC_TIME, 'spanish');
							$mes=ucfirst(strftime("%B",mktime(0, 0, 0, $nacimiento[1], 1, 2000)));
							$cumpleanios = $nacimiento[2].' de '.$mes;
					?>
					<li>
						<a href="<?php echo base_url() ?>funcionario/detalle/<?php echo $cm->id_funcionario;?>" data-toggle="modal" data-target="#myModal<?php echo $cm->id_funcionario;?>" title="<?php echo $cumpleanios; ?>" style="font-size:12px">
							<strong><i class="fa fa-birthday-cake"></i> <?php echo $cumpleanios ?></strong>
							<?php echo $cm->nombres.' '.$cm->apellido_pat.' '.substr($cm->apellido_mat,0,1).'.'; ?>
						</a>
					</li>
					<!-- INICIO MODAL FUNCIONARIO <?php echo $cm->id_funcionario;?>-->
					<div class="modal fade" id="myModal<?php echo $cm->id_funcionario;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							</div>
						</div>
					</div>
					<!-- FIN MODAL -->
					<?php endforeach;	?>
				</ul>
            </div> <!--/.col-md-3-->
			<?php if(count($cumpleanieros_dia) > 0): ?>
            <div class="<?php echo $bandera; ?>">
				<h4>Cumpleañeros de Hoy</h4>
				<div id="diario" style="height:200px;">
				<?php foreach ($cumpleanieros_dia as $cd): ?>
					<div class="media">
                        <div class="pull-left">
                    		<a href="<?php echo base_url() ?>funcionario/detalleCumpleaniero/<?php echo $cd->id_funcionario;?>" data-toggle="modal" data-target="#myModal<?php echo $cd->id_funcionario;?>">
                    			<?php if( $cd->path_foto != "primera/hombrend.jpg" && $cd->path_foto != "") : ?>
									<img src="<?php echo base_url().PATH_FOTO_FUNCIONARIO.$cd->path_foto; ?>" alt="<?php echo $cd->nombres.' '.$cd->apellido_pat.' '.$cd->apellido_mat; ?>" title="Hoy es el cumplea&ntilde;os de <?php echo $cd->nombres.' '.$cd->apellido_pat.' '.$cd->apellido_mat; ?>" width="54">
								<?php else: ?>
									<img src="<?php echo base_url().PATH_FOTO_FUNCIONARIO.'user_default.png'; ?>" class="img-responsive" alt="<?php echo $cd->nombres.' '.$cd->apellido_pat.' '.$cd->apellido_mat; ?>" width="54">
								<?php endif; ?>
                            </a>
                        </div>
                        <div class="media-body" style="line-height:0.9">
                            <p class="media-heading">
                            	<a href="<?php echo base_url() ?>funcionario/detalleCumpleaniero/<?php echo $cd->id_funcionario;?>" data-toggle="modal" data-target="#myModal<?php echo $cd->id_funcionario;?>">
                            			<?php echo $cd->nombres.' '.$cd->apellido_pat.' '.$cd->apellido_mat; ?>
                            	</a>
							</p>
                            <small class="muted">
                            	<?php echo $cd->unidad_organizacional; ?>
                            </small>
                        </div>
                    </div>
					<!-- INICIO MODAL FUNCIONARIO <?php echo $cd->id_funcionario;?>-->
					<div class="modal fade" id="myModal<?php echo $cd->id_funcionario;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							</div>
						</div>
					</div>
					<!-- FIN MODAL -->
				<?php endforeach; ?>
				</div>
           </div><!--/.col-md-3-->
			<?php endif; ?>
        </div>
    </div>
</section>


<!-- INICIO MODAL CALENDARIO -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<div id="calendarM"></div>
				<div class="modal-footer">
			        <a href="<?php echo base_url(); ?>Listado/eventos" style="font-weight:bold">Calendario completo <i class="fa fa-angle-right"></i></a>
			        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				</div>
				<script>
					$('#calendarModal').on('shown.bs.modal', function () {
					   $("#calendarM").fullCalendar('render');
					});
				    $(document).ready(function() {
				        $('#calendarM').fullCalendar({
				            events: '<?php echo base_url()?>Calendario/getJSONEventos',
				            lang: 'es',
				            defaultDate: '<?php echo date("Y-m-d");?>',//'2015-02-12',
				        });
				    });
				</script>
			</div>
		</div>
	</div>
</div>
<!-- FIN MODAL CALENDARIO -->
<footer id="footer" class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php echo COMPANY_COPY;?>
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <!-- <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li> -->
                        <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
