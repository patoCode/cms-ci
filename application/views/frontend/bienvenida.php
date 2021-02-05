<section id="main-slider" class="no-margin">
    <div class="carousel slide wet-asphalt">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(<?php echo base_url(); ?>public/imgs/home/1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content centered">
                                <h2 class="animation animated-item-1"><?php echo COMPANY_INTRANET?></h2>
                                <p class="animation animated-item-2">Bienvenido <?php echo $this->session->userdata('nombres').' '.$this->session->userdata('apellido_pat').' '.$this->session->userdata('apellido_mat'); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
            <div class="item" style="background-image: url(<?php echo base_url(); ?>public/imgs/home/3.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content center centered">
                                <h2 class="boxed animation animated-item-1">Pensamiento del Día</h2>
                                <p class="boxed animation animated-item-2">
                                    <?php
                                    foreach ($mensaje as $msj) {
                                        echo $msj->mensaje.'<br>'.$msj->autor;
                                    }
                                    ?>
                                </p>
                                <br>
                                <!-- <a class="btn btn-md animation animated-item-3" href="#">Learn More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.item-->
            <div class="item" style="background-image: url(<?php echo base_url(); ?>public/imgs/home/2.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="carousel-content centered">
                                <h2 class="animation animated-item-1">
                                    <?php echo date("d/m/Y"); ?>
                                </h2>
                                <p class="animation animated-item-2" id="reloj"></p>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="centered">
                                <div class="embed-container">
                                <!-- <iframe src="//player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="icon-angle-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="icon-angle-right"></i>
    </a>
</section><!--/#main-slider-->