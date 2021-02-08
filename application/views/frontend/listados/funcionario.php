<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1><i class="fa fa-users"></i> Funcionarios</h1>
                <p>Funcionarios de ENDE CORPORACIÓN</p>
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
			<div ng-app="comunidadApp">
				<div class="funcionario-container" ng-controller="FuncionarioListController">
					<div class="col-md-12" style="background-color:smoke;padding:20px 0;">
						<input type="search" id="search" ng-model="query" placeholder="Buscar Funcionario..." class="form-control" style="width:100%;padding:25px">
					</div>
					<div class="col-sm-4" ng-repeat="funcionario in funcionarios | filter:query | orderBy:orderProp">
						<div class="contenedor-funcionario center" >
			               	<a href="<?php echo base_url() ?>funcionario/detalle/{{funcionario.id_funcionario}}" data-toggle="modal" data-target="#myModal{{funcionario.id_funcionario}}">
			               		<div class="perfil-picture shadow" style="background-image: url('https://images.pexels.com/photos/2014422/pexels-photo-2014422.jpeg')"></div>
			               	</a>
			                <h5>
			                	<a href="<?php echo base_url() ?>funcionario/detalle/{{funcionario.id_funcionario}}" data-toggle="modal" data-target="#myModal{{funcionario.id_funcionario}}">
			                		<strong>{{funcionario.nombre_completo}}<br></strong>
			                		<small class="designation muted">{{funcionario.cargo}}</small>
			                	</a>
			                </h5>
			                <p>
								<a class="btn blue-cms" href="#" data-toggle="tooltip" title="{{funcionario.interno}}" data-original-title="{{funcionario.interno}}" data-placement="bottom">
									<i class="icon-phone"></i>
								</a>
								<a class="btn blue-cms" href="mailto:{{funcionario.email_ende}}" data-toggle="tooltip" title="{{funcionario.email_ende}}" data-original-title="{{funcionario.email_ende}}" data-placement="bottom">
									<i class="icon-envelope"></i>
								</a>
			                </p>
							<!--
							<a class="btn btn-social btn-google-plus" href="#"><i class="icon-google-plus"></i></a>
							<a class="btn btn-social btn-twitter" href="#"><i class="icon-twitter"></i></a>
							<a class="btn btn-social btn-linkedin" href="#"><i class="icon-linkedin"></i></a>
							-->
			            </div>
						<!-- INICIO MODAL FUNCIONARIO {{funcionario.id_funcionario}}-->
						<div class="modal fade" id="myModal{{funcionario.id_funcionario}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								</div>
							</div>
						</div>
						<!-- FIN MODAL -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

