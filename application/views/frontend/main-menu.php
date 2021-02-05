<header class="navbar navbar-inverse navbar-fixed-top dark-blue-ende" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('home');?>"><img src="<?php echo base_url() ?>public/imgs/base-logo.png" width="75"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
		<li>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img src="<?php echo base_url().PATH_FOTO_FUNCIONARIO.$this->session->userdata('foto_usuario');?>" alt="" width="20" class="img-circle">
				<?php echo $this->session->userdata('usuario'); ?> <span class="caret"></span>
		    </a>
		    <ul class="dropdown-menu">
		    	<li>
					<a href="<?php echo base_url() ?>funcionario/detalle/<?php echo $this->session->userdata('id_usuario'); ?>" data-toggle="modal" data-target="#myModal<?php echo $this->session->userdata('usuario'); ?>">
						<?php echo $this->session->userdata('nombres').' '.$this->session->userdata('apellido_pat').' '.$this->session->userdata('apellido_mat'); ?>
					</a>
		    	</li>
				<li><a href="<?php echo COMPANY_MAIL;?>" target="_blank"> <i class="fa fa-envelope-o"></i> Correo</a></li>
				<li><a href="<?php echo base_url() ?>Login/logOut"><i class="fa fa-power-off"></i> Salir</a></li>
		    </ul>
		</li>
		<?php if(count($menu) > 0):	?>
		<li>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-dashboard"></i> Administración
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<?php foreach($menu as $elemento): ?>
				<li>
					<a href="<?php echo base_url().$elemento->acceso; ?>">
						<i class="<?php echo $elemento->icono_class ?>"></i>
						<?php echo $elemento->privilegio; ?>
					</a>
				</li>
				<?php endforeach; ?>
		    </ul>
		</li>
		<?php endif;?>
		<li><a href="<?php echo base_url() ?>home"><i class="fa fa-home"></i> Inicio</a></li>
		<li><a href="<?php echo base_url() ?>Listado/funcionario"><i class="fa fa-users"></i> Nosotros</a></li>
		<li>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-share-alt"></i> Información Compartida <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo base_url() ?>Listado/albumes"><i class="fa-fw fa fa-camera"></i> Album Fotográfico</a></li>
				<li><a href="<?php echo base_url() ?>Listado/musica"><i class="fa-fw fa fa-music"></i> Sala de Música</a></li>
				<li><a href="<?php echo base_url() ?>Listado/video"><i class="fa-fw fa fa-video-camera"></i> Videoteca</a></li>
		    </ul>
		</li>
		<li><a href="<?php echo base_url() ?>Listado/statics"><i class="fa fa-database"></i> Portal Administrativo</a></li>
	</ul>

        </div>
    </div>
</header><!--/header-->