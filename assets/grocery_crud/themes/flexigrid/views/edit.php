<?php

	$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/flexigrid/js/flexigrid-edit.js');

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class="" data-unique-hash="<?php echo $unique_hash; ?>">
	<div id='main-table-box' class="card">
		<div class="card-header">
				<?php echo $this->l('form_edit'); ?> <?php echo $subject?>
		</div>
		<?php echo form_open( $update_url, 'method="post" id="crudForm"  enctype="multipart/form-data"'); ?>
		<div class='card-body'>
			<?php
				foreach($fields as $field)
				{
			?>
				<div class='form-group' id="<?php echo $field->field_name; ?>_field_box">
					<div class='row' id="<?php echo $field->field_name; ?>_display_as_box">
						<label class="col-md-2 col-form-label" for="<?php echo $field->field_name; ?>">
						<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?> :
						</label>
						<div class='col-md-9' id="<?php echo $field->field_name; ?>_input_box">
							<?php echo $input_fields[$field->field_name]->input?>
						</div>
					</div>
				</div>
			<?php }?>
			<?php if(!empty($hidden_fields)){?>
			<!-- Start of hidden inputs -->
				<?php
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			<?php }?>
			<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
			<div id='report-error' class='report-div error p-3 mb-2 bg-danger text-white'></div>
			<div id='report-success' class='report-div success p-3 mb-2 bg-success text-white'></div>
		</div>
		<div class="card-footer clearfix">
			<div class="float-right">
				<input  id="form-button-save" type='submit' value='<?php echo $this->l('form_update_changes'); ?>' class="btn btn-large btn-success"/>
			<?php if(!$this->unset_back_to_list) { ?>
				<input type='button' value='<?php echo $this->l('form_update_and_go_back'); ?>' id="save-and-go-back-button" class="btn btn-large btn-info"/>
				<input type='button' value='<?php echo $this->l('form_cancel'); ?>' class="btn btn-large btn-danger" id="cancel-button" />
			<?php } ?>

				<!-- <div class='alert alert-primary' id='FormLoading'><?php echo $this->l('form_update_loading'); ?></div> -->

		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_edit_form = "<?php echo $this->l('alert_edit_form')?>";
	var message_update_error = "<?php echo $this->l('update_error')?>";
</script>