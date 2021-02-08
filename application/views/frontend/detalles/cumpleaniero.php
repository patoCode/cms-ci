<div class="modal-func" style="min-height:300px;padding-bottom:20px;">
	<div class="modal-content">
	<div class="modal-header yellow-cms">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
			<span aria-hidden="true">&times;</span>
		</button>
		<?php foreach ($funcionario as $funcionario): ?>
		<h3 class="text-center" style="color:white;"> 
			<?php echo $funcionario->nombres.' '.$funcionario->apellido_pat.' '.$funcionario->apellido_mat; ?>
		</h3>
	</div>
	<div class="modal-body">
		<div class="row">
		<div class="col-md-5">
		<?php if($funcionario->path_foto != 'primera/-1' && $funcionario->path_foto != "" && $funcionario->path_foto != NULL && $funcionario->path_foto != "primera/hombrend.jpg"): ?>
				<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_FOTO_FUNCIONARIO.$funcionario->path_foto;?>)"></div>

			<?php else: ?>
				<div class="perfil-picture shadow" style="background-image: url(<?php echo base_url().PATH_FOTO_FUNCIONARIO;?>user_default.png)"></div>
			<?php endif; ?>
		</div>
		<div class="col-md-7s">
			<p>
				<b>Cumplea&ntilde;os:</b>
					<?php
						$hoy = date("Y-m-d");
						if($funcionario->cumpleanio == $hoy):
							$cumpleanios = 'Hoy';
						else:
							$nacimiento = explode('-',$funcionario->cumpleanio);
							setlocale(LC_TIME, 'spanish');
								$mes=ucfirst(strftime("%B",mktime(0, 0, 0, $nacimiento[1], 1, 2000)));
								$cumpleanios = $nacimiento[2].' de '.$mes;
						endif;
						echo $cumpleanios;
					?>
					<br>
				<b>Correo:</b> <?php echo $funcionario->email_ende ?><br>
				<b>Unidad:</b> <?php echo $funcionario->unidad_organizacional ?><br>
				<b>Cargo:</b> <?php echo $funcionario->cargo ?><br>
				<b>Lugar de Trabajo:</b> <?php echo $funcionario->lugar_trabajo ?><br>
				<b>Interno:</b> <?php echo $funcionario->interno ?><br>
				<b>Celular:</b> <?php echo $funcionario->celular ?><br>
			</p>
		</div>
		<?php endforeach; ?>
		<div class="col-md-12 text-center" style="margin-top:20px;">
			<a href="#" class="button-happy">
				<i class="fa fa-fw fa-birthday-cake"></i> Enviar Felicitación
			</a>
		</div>
		</div>
	</div>		
		
		
	</div>
</div>
<script>
	$('.button-happy').click(function(){
		$.ajax({
					method: "POST",
					url: "<?php echo base_url() ?>Mail/felicitacion",
					data: {
						'cumpleanero': '<?php echo $funcionario->nombres;//.' '.$funcionario->apellido_pat.' '.$funcionario->apellido_mat; ?>',
						'amigo': '<?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellido_pat'); ?>',
						'mail_cumpleanero': '<?php echo $funcionario->email_ende; ?>',
						'mail_amigo':'<?php echo $this->session->userdata('email_ende'); ?>'
					}
				})
				.done(function( msg ) {
					if(msg == 1){
						$.alert.open({
							title: 'Mensaje Enviado',
							content: 'Felicitación enviada correctamente.',
							icon: false,
							cancel:false,
							callback:function(){$('#myModal<?php echo $funcionario->id_funcionario; ?>').modal('hide');}
						});
					}
					else{
						alert("Ocurrió un error al enviar su felicitación, intentalo más tarde.");
					}
				});
	});
</script>