<?php 
$options = Basically_get_theme_options();
$ads_single_top = isset($options['single-ads-top'])? $options['single-ads-top']: ''; ?>
<?php if ($ads_single_top != ""){?>
	<div class="ads-2">
		<?php echo stripslashes($ads_single_top); ?>
	</div>
<?php } ?>