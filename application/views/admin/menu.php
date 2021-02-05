<div class="navbar navbar-default navbar-fixed-top" >
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url() ?>Administrar/archivo">
            <img src="<?php echo base_url() ?>public/imgs/base-logo.png" alt="<?php echo COMPANY_NAME;?>" width="58">
		</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav" style="margin-top:0;">
			<li>
				<a href="<?php echo base_url() ?>home" target="_blank" style="color:white;">
					<i class="fa fa-laptop"></i>Comunidad
				</a>
			</li>
			<li>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-dashboard"></i>
					Administración
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
				<?php foreach($menu as $elemento): ?>
					<li>
						<a href="<?php echo base_url().$elemento->acceso ?>">
							<i class="<?php echo $elemento->icono_class ?>"></i>
							<?php echo $elemento->privilegio; ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</li>

			<li>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user"></i>
					<?php echo $this->session->userdata('usuario'); ?><span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?php echo COMPANY_MAIL?>" target="_blank"> <i class="fa fa-envelope-o"></i> Correo</a></li>
					<li><a href="<?php echo base_url() ?>Login/logOut"><i class="fa fa-power-off"></i> Salir</a></li>
			    </ul>
			</li>
		</ul>
	</div>
	</div>
</div>