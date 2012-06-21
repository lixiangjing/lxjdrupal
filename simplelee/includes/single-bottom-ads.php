<?php 
$options = Basically_get_theme_options();
$ads_single_bottom = isset($options['single-ads-bottom'])? $options['single-ads-bottom']: ''; ?>
<?php if ($ads_single_bottom != ""){?>
	<div class="ads-3">
		<?php echo stripslashes($ads_single_bottom); ?>
	</div>
<?php } ?>