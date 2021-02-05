<script>
//<![CDATA[
var audio;var playlist;var tracks;var current;initaudio();function initaudio(){current=0;audio=$('audio');playlist=$('#playlist');tracks=playlist.find('li a');len=tracks.length-1;audio[0].volume=1;playlist.find('a').click(function(e){e.preventDefault();link=$(this);current=link.parent().index();runaudio(link,audio[0])});audio[0].addEventListener('ended',function(e){current++;if(current>len){current=0;link=playlist.find('a')[0]}else{link=playlist.find('a')[current]}runaudio($(link),audio[0])})}function runaudio(link,player){player.src=link.attr('href');par=link.parent();par.addClass('active').siblings().removeClass('active');audio[0].load();audio[0].play()}
//]]>
</script>


<?php
	$cont = 0;
	foreach($elementos as $elemento):
?>
	<?php if($cont == 0): $cont++;?>
	<div id='player'>
		<audio controls='' id='audio' preload='auto' tabindex='0' type='audio/mpeg'>
			<source src='<?php echo base_url().PATH_FILE_RRHH.$elemento->path_archivo; ?>' type='audio/mp3'/>
			Hola, tu navegador no está actualizado y no puede mostrar este contenido.
		</audio>
	</div>
	<ul id='playlist'>
	<?php endif; ?>
		<li>
			<a href='<?php echo base_url().PATH_FILE_RRHH.$elemento->path_archivo; ?>'>
				<?php echo $elemento->archivo; ?>
			</a>
		</li>
<?php endforeach; ?>
</ul>
<script>
    (function($){
        $(window).load(function(){
            $("#playlist").mCustomScrollbar();
        });
    })(jQuery);
</script>