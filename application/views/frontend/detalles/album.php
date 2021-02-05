<?php $this->load->view('frontend/head'); ?>
<body>
    <?php $this->load->view('frontend/main-menu'); ?>

        <script type="text/javascript" src="<?php echo base_url();?>public/js/jssor.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jssor.slider.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/gallery-control.js"></script>

        <!-- TITULO DE SECCION -->
        <section id="title" class="emerald">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <h1><i class="fa fa-camera"></i>&nbsp;<?php echo $album->album; ?></h1>
                        <p><?php echo $album->descripcion; ?></p>
                    </div>
                     <div class="col-sm-3">
                        <ul class="breadcrumb pull-right">
                            <li><a href="<?php echo base_url() ?>Listado/albumes">Álbumes</a></li>
                            <li class="active"><?php echo substr($album->album,0,20); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- FIN TITULO DE SECCION -->

        <div class="row">
            <div class="container" style="margin-top:50px;min-height:485px;">
                <div class="col-md-12">
                    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;
                        height: 580px; background: #f5f5f5; overflow: hidden;">
                        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                                background-color: #f5f5f5; top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                            <div style="position: absolute; display: block; background: url(<?php echo base_url();?>public/imgs/loading.gif) no-repeat center center;
                                top: 0px; left: 0px;width: 100%;height:100%;">
                            </div>
                        </div>
                        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 480px; overflow: hidden;">
                            <?php foreach($elementos as $foto): ?>
                                <div>
                                    <?php if($foto->id_album > 0): ?>
                                        <img u="image" src="<?php echo base_url().PATH_ALBUMES.$foto->path_archivo;?>"/>
                                        <img u="thumb" src="<?php echo base_url().PATH_ALBUMES.$foto->path_archivo;?>"/>
                                    <?php else: ?>
                                        <img u="image" src="<?php echo base_url().PATH_FILE_RRHH.$foto->path_archivo;?>"/>
                                        <img u="thumb" src="<?php echo base_url().PATH_FILE_RRHH.$foto->path_archivo;?>"/>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                        <style>
                            .jssora05l, .jssora05r {
                                display: block;
                                position: absolute;
                                /* size of arrow element */
                                width: 40px;
                                height: 40px;
                                cursor: pointer;
                                overflow: hidden;
                            }
                            .jssora05l { background-position: -10px -40px; }
                            .jssora05r { background-position: -70px -40px; }
                            .jssora05l:hover { background-position: -130px -40px; }
                            .jssora05r:hover { background-position: -190px -40px; }
                            .jssora05l.jssora05ldn { background-position: -250px -40px; }
                            .jssora05r.jssora05rdn { background-position: -310px -40px; }
                        </style>
                        <span u="arrowleft" class="jssora05l" style="top: 158px; left: 8px;">
                        </span>
                        <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px">
                        </span>
                        <style>
                            .jssort01 {
                                position: absolute;
                                width: 800px;
                                height: 100px;
                            }
                            .jssort01 .p {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 72px;
                                height: 72px;
                            }
                            .jssort01 .t {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                border: none;
                            }
                            .jssort01 .w {
                                position: absolute;
                                top: 0px;
                                left: 0px;
                                width: 100%;
                                height: 100%;
                            }
                            .jssort01 .c {
                                position: absolute;
                                top: 0px;
                                left: 0px;
                                width: 68px;
                                height: 68px;
                                border: #000 2px solid;
                                box-sizing: content-box;

                                _background: none;
                            }
                            .jssort01 .pav .c {
                                top: 2px;
                                _top: 0px;
                                left: 2px;
                                _left: 0px;
                                width: 68px;
                                height: 68px;
                                border: #000 0px solid;
                                _border: #fff 2px solid;
                                background-position: 50% 50%;
                            }
                            .jssort01 .p:hover .c {
                                top: 0px;
                                left: 0px;
                                width: 70px;
                                height: 70px;
                                border: #fff 1px solid;
                                background-position: 50% 50%;
                            }
                            .jssort01 .p.pdn .c {
                                background-position: 50% 50%;
                                width: 68px;
                                height: 68px;
                                border: #000 2px solid;
                            }
                            * html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
                                width /**/: 72px;
                                height /**/: 72px;
                            }
                        </style>

                        <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
                            <div u="slides" style="cursor: default;">
                                <div u="prototype" class="p">
                                    <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                                    <div class=c></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load->view('frontend/widget-footer'); ?>
    <?php $this->load->view('frontend/footer'); ?>
</body>
</html>