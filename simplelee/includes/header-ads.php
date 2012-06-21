<?php 
$options = Basically_get_theme_options();
$header_ads = isset($options['header-ads'])? $options['header-ads']: '';
if ($header_ads != ""){?>
	<div id="header-right">		
		<div class="ads-1">
			<?php echo stripslashes($header_ads); ?>
		</div>
	</div>
<?php } ?>