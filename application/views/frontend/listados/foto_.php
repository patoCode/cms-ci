<?php //if(count($elementos) > 0): ?>
    <script src="<?php echo base_url();?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jssor.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
                { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 1140), 450));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
        });
    </script>
    <h3 style="margin-bottom:30px;"><i class="fa fa-camera-retro"></i> Álbum Fotográfico</h3>
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;
        height: 456px; background: #191919; overflow: hidden;">
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?php echo base_url();?>public/imgs/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 356px; overflow: hidden;">
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/01.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-01.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/02.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-02.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/03.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-03.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/04.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-04.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/05.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-05.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/06.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-06.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/07.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-07.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/08.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-08.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/09.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-09.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/10.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-10.jpg" />
            </div>

            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/11.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-11.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url();?>public/imgs/fotos/12.jpg" />
                <img u="thumb" src="<?php echo base_url();?>public/imgs/fotos/thumb-12.jpg" />
            </div>
        </div>
        <style>
            .jssora05l, .jssora05r {
                display: block;
                position: absolute;
                /* size of arrow element */
                width: 40px;
                height: 40px;
                cursor: pointer;
                background: url(<?php echo base_url();?>public/imgs/fotos/a17.png) no-repeat;
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
                background: url(<?php echo base_url();?>public/imgs/fotos/t01.png) -800px -800px no-repeat;
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
<?php //else: ?>
   <!--  <h5 style="margin-top:20px">
        No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
    </h5> -->
<?php //endif; ?>