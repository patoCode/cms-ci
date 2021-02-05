<script type="text/javascript" src="<?php echo base_url() ?>public/reproductor/script/berniecode-animator.js"></script>
<script src="<?php echo base_url() ?>public/reproductor/script/soundmanager2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/reproductor/script/360player.js"></script>
<script>
soundManager.setup({
    url: '<?php echo base_url() ?>public/reproductor/swf'
});
threeSixtyPlayer.config = {
    playNext: false,
    autoPlay: false,
    allowMultiple: false,
    loadRingColor: '#ccc',
    playRingColor: '#000',
    backgroundRingColor: '#eee',
    circleDiameter: 36,
    circleRadius: 18,
    animDuration: 500,
    animTransition: Animator.tx.bouncy,
    showHMSTime: true,

    useWaveformData: true,
    waveformDataColor: '#0099ff',
    waveformDataDownsample: 4,
    waveformDataOutside: true,
    waveformDataConstrain: false,
    waveformDataLineRatio: 0.66,

    useEQData: true,
    eqDataColor: '#339933',
    eqDataDownsample: 14,
    eqDataOutside: true,
    eqDataLineRatio: 0.929,

    usePeakData: true,
    peakDataColor: '#ff33ff',
    peakDataOutside: true,
    peakDataLineRatio: 0.5,

    useAmplifier: true
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/reproductor/css/360player.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/reproductor/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/reproductor/css/360player-visualization.css" />

<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1><i class="fa fa-music"></i> Sala de música</h1>
                <p>Música publicada en la comunidad</p>
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
    		<?php foreach($elementos as $elemento): ?>
    			<?php if(substr($elemento->path_archivo,-3) == 'mp3'):?>

    				<div class="col-md-1 pista-container shadow">
            <i class="fa fa-music ipod-icon" style="color:#162A75"></i>
    					<div class="ui360">
    						<a href="<?php echo base_url().PATH_FILE_RRHH.$elemento->path_archivo; ?>" style="font-size:75%">
    						</a>
    					</div>
    					<p><?php echo $elemento->archivo; ?></p>
    				</div>
    			<?php endif; ?>
    		<?php endforeach; ?>
    	<?php else: ?>
    		<h5 style="margin-top:20px">
    			No se encontraron elementos para mostrar, <a href="<?php echo base_url()?>home"><i class="fa fa-home"></i>volver inicio</a>
    		</h5>
    	<?php endif; ?>
    </div>
   </div>
</div>