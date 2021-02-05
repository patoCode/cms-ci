<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
				<h1><i class="fa fa-camera-retro"></i> Álbumes</h1>
				<p>Albumes de la comunidad</p>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
</section>
<div class="row">
	<div class="container" style="margin-top:50px;min-height:485px;">
		<div class="col-md-12">
			<?php if(count($elementos)>0):?>
					<?php foreach($elementos as $elemento): ?>
						<div class="col-sm-4">
							<div class="contenedor-funcionario center" >
						       	<a href="<?php echo base_url() ?>Album/detalle/<?php echo $elemento->id_album; ?>">
						       		<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_ALBUMES_PREVIEW.$elemento->path_imagen;?>);"></div>
						       	</a>
						        <h5>
						        	<a href="<?php echo base_url() ?>Album/detalle/<?php echo $elemento->id_album; ?>">
						        		<strong><?php echo $elemento->album; ?><br></strong>
						        		<small class="designation muted">
						        			<?php echo $elemento->descripcion; ?>
						        		</small>
						        	</a>
						        </h5>
						    </div>
						</div>
					<?php endforeach; ?>


			<?php else: ?>
				<h5 style="margin-top:20px">
					No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
				</h5>
			<?php endif; ?>
				<div class="col-sm-4">
					<div class="contenedor-funcionario center" >
							<a href="<?php echo base_url();?>Administrar/album" title="Crear Nuevo Álbum">
								<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_IMGS;?>more_gallery.png);"></div>
							</a>
				        <h5>
				        	<a href="<?php echo base_url();?>Administrar/album" title="Crear Nuevo Álbum">
				        		<strong>CREA UN NUEVO ÁLBUM<br></strong>
				        		<small class="designation muted">
				        			Publica tus imágenes en la comunidad...
				        		</small>
				        	</a>
				        </h5>
				    </div>
				</div>

		</div>

	</div>
</div>

