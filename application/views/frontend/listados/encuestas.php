<script type="text/javascript" src="<?php echo base_url(); ?>public/js/graph/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/graph/themes/fusioncharts.theme.fint.js"></script>
<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
				<h1><i class="fa fa-bar-chart"></i> Encuestas</h1>
				<p>Encuestas</p>
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
            <?php if(count($elementos)>0):?>
            <!-- INICIO TABS DE ENCUESTAS -->
            <?php for ($i=0; $i < count($elementos); $i++):?>
                <?php
                $cont = 0;
                for($j=0; $j< count((array)$elementos[$i][0]);$j++):
                ?>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_<?php echo $i;?>">
                            <h4 class="panel-title">
                                <a <?php if($i > 0): ?>class="collapsed"<?php endif; ?> role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $i;?>" aria-expanded="<?php if($i == 0): ?> true <?php else: ?> false <?php endif; ?>" aria-controls="collapse_<?php echo $i;?>">
                                   <i class="fa fa-bar-chart"></i> <?php echo $elementos[$i][0]->titulo.': '.$elementos[$i][0]->descripcion ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_<?php echo $i;?>" class="panel-collapse collapse in <?php if($i == 0) echo "in"; ?>" role="tabpanel" aria-labelledby="heading_<?php echo $i;?>">
                            <div class="panel-body">
                                <?php if(!in_array($elementos[$i][0]->id_encuesta, $participaciones)): ?>
                                    <?php if(count($elementos[$i][1])>0): ?>
                                        <form id="form_<?php echo $i; ?>" action="<?php echo base_url(); ?>Encuestas/votar">
                                            <?php for ($h=0; $h < count($elementos[$i][1]); $h++):?>
                                                <input type="hidden" name="id_encuesta" value="<?php echo $elementos[$i][0]->id_encuesta;?>">
                                                <input type="radio" name="opcion[]" required="true" value="<?php echo $elementos[$i][1][$h]->id_encuesta_opcion ?>" autocomplete="off">
                                                <?php echo $elementos[$i][1][$h]->titulo ?><br>
                                            <?php endfor;?>
                                            <input type="submit" value="Votar" id="botonEnviar_<?php echo $i;?>">
                                        </form>
                                        <div id="result"></div>
                                        <script>
                                            $("#form_<?php echo $i; ?>").submit(function(event) {
                                                event.preventDefault();
                                                var $form   = $(this),
                                                encuesta    = '',
                                                opc         = '',
                                                encuesta    = $form.find( "input[name='id_encuesta']" ).val(),
                                                //opc         = $form.find( "input[name='opcion[]']" ).val(),
                                                opc         = $( "input:checked" ).val();
                                                url         = $form.attr( "action" );
                                                var posting = $.post( url, { id_encuesta:encuesta,opcion:opc } );
                                                posting.done(function( data ) {
                                                    if(data == 1)
                                                    {
                                                        location.reload();
                                                    }
                                                    else
                                                    {
                                                        alert("Su voto no fue contabilizado por favor intente mas tarde.");
                                                    }
                                                });
                                            });
                                        </script>
                                    <?php else: ?>
                                        No existen opciones para participar de esta encuesta.
                                    <?php endif; ?>
                                <?php else: ?>
                                    <script type="text/javascript">
                                        FusionCharts.ready(function(){
                                            var revenueChart_<?php echo $i;?> = new FusionCharts({
                                               "type": "pie3d",
                                                "renderAt": "chartContainer_<?php echo $i?>",
                                                "width": "1024",
                                                "height": "280",
                                                "dataFormat": "json",
                                                "rotateValues":"0",
                                                "dataSource": {<?php echo $resultados[$i][1];?>}
                                            });
                                            revenueChart_<?php echo $i;?>.render();
                                        });
                                    </script>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="cont-graph" style="height:350px;">
                                        <div id="chartContainer_<?php echo $i;?>"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $cont++;
                endfor; ?>
            <?php endfor;?>
            <!-- FIN TABS DE ENCUESTAS -->
             <?php else: ?>
                <h5 style="margin-top:20px">
                    No se encontraron elementos para mostrar,
                    <a href="<?php echo base_url()?>home">
                        <i class="fa fa-home"></i>
                        volver inicio
                    </a>
                </h5>
            <?php endif; ?>
        </div>
    </div>
</div>
