<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
	<title><?php echo COMPANY_INTRANET?></title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>public/imgs/favicon.png" />
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/font-awesome-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/main.css">



	<?php if(isset($output)): ?>
        <!-- ARCHIVOS CSS -->
        <?php foreach($output->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <!-- ARCHIVOS JS -->
        <?php foreach($output->js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>

    <?php endif; ?>
</head>
<body>

    <!-- MENU ADMINISTRACION -->
    <?php $this->load->view('admin/menu'); ?>
    <!-- FIN MENU ADMINISTRACION -->
    <div class="container">
    
    <?php if(!isset($output)): ?>
        
            <div class="col-sm-12">
                Bienvenido Admin
            </div>
        
    <?php else: ?>
        
            <div class="col-md-12">
                <h3>
                    <?php echo $title_page; ?>
                </h3>
                <?php if(isset($album_back)): ?>
                    <p>
                        <?php //echo $album_back; ?>
                        <?php echo $album_save; ?>
                    </p>
                <?php endif; ?>
                <div style='height:20px;'></div>
                <div>
                    <?php echo $output->output; ?>
                </div>
                <!-- CONTENEDOR DE RESULTADOS -->
                <?php if (isset($resultados)): ?>
                    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/graph/fusioncharts.js"></script>
                    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/graph/themes/fusioncharts.theme.fint.js"></script>
                    <pre id="chartContainer">
                        <script type="text/javascript">
                            FusionCharts.ready(function(){
                                var revenueChart= new FusionCharts({
                                   "type": "pie3d",
                                    "renderAt": "chartContainer",
                                    "width": "1024",
                                    "height": "280",
                                    "dataFormat": "json",
                                    "rotateValues":"0",
                                    "dataSource": {<?php echo $resultados;?>}
                                });
                                revenueChart.render();
                            });
                        </script>
                    </pre>
                <?php endif; ?>
                <!-- FIN CONTENEDOR DE RESULTADOS -->
            </div>
        
    <?php endif; ?>
    <div class="col-md-12">
        <p style="margin:10px 0px;font-size:12px">
            <i class="fa fa-copyright"></i> <?php echo COMPANY_COPY;?>
        </p>
    </div>
    
        
        
        <script src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
    </div>
</body>
</html>

