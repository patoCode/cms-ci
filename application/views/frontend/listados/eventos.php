<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
				<h1><i class="fa fa-calendar"></i> Eventos</h1>
				<p>Eventos programados en la comunidad</p>
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
	<div class="container" style="margin-top:50px;">
		<div class="col-md-12" style="padding-bottom:50px;">
			<div id="calendar"></div>
			<script>
			    $(document).ready(function() {
			        $('#calendar').fullCalendar({
			            events: '<?php echo base_url()?>Calendario/getJSONEventos',
			            lang: 'es',
			            header: {
			                left: 'prev,next today',
			                center: 'title',
			                right: 'month,agendaWeek,agendaDay'
			            },
			            defaultDate: '<?php echo date("Y-m-d");?>',//'2015-02-12',
			            editable: true,
			            eventLimit: true,
			            eventClick:  function(event, jsEvent, view) {
				            $('#modalTitle').html(event.title);
				            $('#modalBody').html(event.description);
				            $('#fullCalModal').modal();
				        }
			        });
			        $("#calendar").fullCalendar('render');
			    });
			</script>
		</div>
	</div>
</div>

<!-- MODAL DE DESCRIPCION -->
<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#aab2bd">
                <button type="button" class="close" data-dismiss="modal">
                	<span aria-hidden="true">×</span>
                </button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
        </div>
    </div>
</div>
<!-- FIN MODAL DE DESCRIPCION -->