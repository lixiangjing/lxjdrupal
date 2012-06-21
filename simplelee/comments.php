<?php
/**
 * @package WordPress
 * @subpackage Basically
 * The template for displaying Comments.
 */
?>
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'basically'); ?></p>
	<?php
		return;
	endif;
?>
<!-- You can start editing here. -->

<div class="comments-box clearfix">

</div><!--end #comment-box--> 